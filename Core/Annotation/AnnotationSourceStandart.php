<?php

namespace Ruon\Core\Annotation;

/**
 * Стандартный источник аннотаций
 *
 * @author morph, goorus
 */
class AnnotationSourceStandart extends AnnotationSourceAbstract
{
	/**
	 * Рефлексия класса
	 *
	 * @var \ReflectionClass
	 */
	private $reflection;

	/**
	 * Разбирает строку на части
	 *
	 * @param string $string
	 * @return array
	 */
	protected function extract($string)
	{
		$parts = explode('@', $string);
		array_shift($parts);
		if (!$parts) {
			return;
		}
		foreach($parts as $i => $part) {
			$lines = explode("\n", $part);
			$parts[$i] = array();
			foreach ($lines as $line) {
				$line = trim($line, "*\t\r/ ");
				if (!$line) {
					continue;
				}
				$parts[$i][] = $line;
			}
			$parts[$i] = join('', $parts[$i]);
		}
		return array_values($parts);
	}

	/**
	 * @inheritdoc
	 * @see Ruon\Core\Annotation\AnnotationSourceAbstract::getClass
	 */
	public function getClass($class)
	{
		$reflection = $this->getReflection($class);
		$doc = $reflection->getDocComment();
		$data = $this->parse($doc);
		return $data;
	}

	/**
	 * @inheritdoc
	 * @see Ruon\Core\Annotation\AnnotationSourceAbstract::getMethods
	 */
	public function getMethods($class)
	{
		$reflection = $this->getReflection($class);
		$methods = $reflection->getMethods();
		$resultMethods = array();
		foreach ($methods as $method) {
			$data = $this->parse($method->getDocComment());
			$resultMethods[$method->name] = $data;
		}
		return $resultMethods;
	}

	/**
	 * @inheritdoc
	 * @see Ruon\Core\Annotation\AnnotationSourceAbstract::getProperties
	 */
	public function getProperties($class)
	{
		$reflection = $this->getReflection($class);
		$properties = $reflection->getProperties();
		$resultProperties = array();
		foreach ($properties as $property) {
			$data = $this->parse($property->getDocComment());
			$resultProperties[$property->name] = $data;
		}
		return $resultProperties;
	}

	/**
	 * Получить рефлексию класса
	 *
	 * @param \StdClass $class
	 * @return \ReflectionClass
	 */
	protected function getReflection($class)
	{
		if (!$this->reflection) {
			$this->reflection = new \ReflectionClass($class);
		}
		return $this->reflection;
	}

	/**
	 * Выполнить регулярное выражение
	 *
	 * @param string $string
	 * @return array
	 */
	protected function parse($string)
	{
		$result = array();
		$parts = $this->extract($string);
		if (!$parts) {
			return;
		}
		foreach ($parts as $param) {
			$b = strpos($param, '(');
			if ($b !== false) {
				$e = strrpos($param, ')');
				if ($e === false) {
					continue;
				}
				$value = trim(substr($param, $b + 1, $e - $b - 1));
				$param = trim(substr($param, 0, $b));
				if (!$param) {
					continue;
				}
				$r = $this->parsePart($param, $value);
				if ($r) {
					if (!isset($result[$param])) {
						$result[$param] = array();
					}
					$result[$param] = array_merge($result[$param], $r);
				}
			} elseif ($param) {
				$e = strrpos($param, ')');
				if ($e !== false) {
					continue;
				}
				$result[$param] = $param;
			}
		}
		return $result;
	}

	/**
	 * Разбирает часть запроса
	 *
	 * @param string $key
	 * @param string $value
	 * @return mixed
	 */
	protected function parsePart($key, $value)
	{
		$result = array();
		$matches = array();
		$regexp = '#"?([^",\= ]+)"?(?:\s+)?(?:\=(?:\s+)?'.
			'(\d+|"[^"]+"|{[^}]+(?:(}|(?:\s*)?)++)))?#';
		preg_match_all($regexp, $value, $matches);
		foreach ($matches[1] as $i => $key) {
			if ($matches[2][$i] === '') {
				$matches[2][$i] = $key;
			}
			$value = trim($matches[2][$i], '\'" ');
			$key = trim($key, '\'" ');
			if (strpos($value, '{') === 0 &&
				$value[strlen($value) - 1] == '}') {
				$value = substr($value, 1, -1);
				$result[$key] = $this->parsePart($key, $value);
			} else {
				$result[$key] = $value;
			}
		}
		return $result;
	}
}
