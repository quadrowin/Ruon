<?php

namespace Ruon\Core\Config;

/**
 *
 * Страндартный загрузчик конфигураций
 *
 * @author morph, goorus
 *
 */
class ConfigLoaderStandart extends ConfigLoaderAbstract
{
	/**
	 * Пути конфигурации
	 *
	 * @var array
	 */
	protected $paths;

	/**
	 * Получить пути до конфигурации
	 *
	 * @return array
	 */
	public function getPaths()
	{
		return $this->paths;
	}

	/**
	 * @see ConfigLoaderAbstract::load
	 */
	public function load($className)
	{
		$lastDelim = strrpos($className, '\\');
		$namespace = substr($className, 0, $lastDelim);
		$className = substr($className, $lastDelim + 1);
		$exists = false;
		$parts = explode('\\', $namespace);
		$count = sizeof($parts);
		for ($i = $count; $i > 0; $i--) {
			$sliceParts = array_slice($parts, 0, $i);
			$namespace = implode('\\', $sliceParts);

			if (isset($this->paths[$namespace])) {
				$exists = true;
				break;
			}
		}
		if (!$exists) {
			return false;
		}

		$dirParts = (array) trim($this->paths[$namespace], '/');
		if ($i <= $count - 1) {
			$dirParts = array_merge(
				$dirParts,
				array_slice($parts, $i, $count - $i + 1)
			);
		}
		$dirParts = array_merge($dirParts, explode('_', $className));
		$path = implode('/', $dirParts);
		$filename = $path . '.php';
		if (!file_exists($filename)) {
			return false;
		}
		$data = include($filename) ?: array();
		return $data;
	}

	/**
	 * Меняет путь до конфигурации
	 *
	 * @param string $namespace
	 * @param string $path
	 */
	public function setPath($namespace, $path)
	{
		$this->paths[$namespace] = $path;
	}

	/**
	 * Заменяет пути до конфигурации
	 *
	 * @param array $paths
	 */
	public function setPaths($paths)
	{
		$this->paths = $paths;
	}
}