<?php

namespace Ruon\Di\ServiceSource;

/**
 *
 * Создание сервисов по описанию в конфигах
 *
 * @author goorus, morph
 *
 */
class ServiceSourceStandart extends ServiceSourceAbstract
{

	/**
	 * @var string
	 */
	const ARGUMENTS = 'arguments';

	/**
	 * @var string
	 */
	const INIT = 'init';

	/**
	 * @var string
	 */
	const METHOD = 'method';

	/**
	 * @var string
	 */
	const NAME = 'name';

	/**
	 * @var string
	 */
	const PARENT = 'parent';

	/**
	 * @var string
	 */
	const PROPERTY = 'property';

	/**
	 * @var string
	 */
	const SERVICE = 'service';

	/**
	 * @var string
	 */
	const TYPE = 'type';

	/**
	 * @var string
	 */
	const VALUE = 'value';

	/**
	 * Возвращает сервис, описанный в конфигах
	 *
	 * @param string $class Название сервиса
	 * @param array $context Аргументы конструктора (ассоциативный массив)
	 * @return object Сервис
	 */
	public function get($class, $context)
	{
		$config = $this->getServiceConfig($class);

		$realClass = isset($config['class']) ? $config['class'] : $class;

		if (!$context) {
			$context = array();
		}

		$constructArgs = isset($config[self::ARGUMENTS])
			? array_merge($config[self::ARGUMENTS], $context)
			: $context;

		$classReflection = new \ReflectionClass($realClass);
		$constructor = $classReflection->getConstructor();

		$params = $constructor
			? $constructor->getParameters()
			: null;

		if ($params) {
			$params = $this->getArguments($class, $params, $constructArgs);
			$instance = $classReflection->newInstanceArgs($params);
		} else {
			$instance = $classReflection->newInstance();
		}

		if ($this->injector) {
			$this->injector->inject($instance);
		}

		$init = isset($config['init']) ? $config['init'] : array();

		foreach ($init as $step) {
			$name = $step[self::NAME];
			$type = $step[self::TYPE];
			if ($type == self::PROPERTY) {
				$value = $step[self::VALUE];
				$instance->$name = $value;
			} elseif ($type == self::METHOD) {
				$arguments = $step[self::ARGUMENTS];
				$reflectionMethod = new \ReflectionMethod($instance, $name);
				$params = $this->getArguments(
					$class,
					$reflectionMethod->getParameters(),
					$arguments
				);
				call_user_func_array(
					array($instance, $name),
					$params
				);
			}
		}

		return $instance;
	}

	/**
	 * Инициализирует аргументы для класса
	 *
	 * @param string $class Класс
	 * @param array of \ReflectionParameter $params Параметры
	 * @param array $preset Пресет
	 * @return array of mixed Значения параметров
	 */
	public function getArguments($class, array $params, array $preset)
	{
		foreach ($params as &$param) {
			$name = $param->getName();

			if (isset($preset[$name])) {
				// Для этого аргумента передано значение
				$param = $preset[$name];
				continue;
			}

			$paramClass = $param->getClass();
			if ($paramClass) {
				$paramClass = $paramClass->getName();
			}

			if ($paramClass && $this->serviceLocator) {
				// Класс получаем через менеджер сервисов
				$param = $this->serviceLocator->get($paramClass, $class);
			} elseif ($param->isDefaultValueAvailable()) {
				$param = $param->getDefaultValue();
			} else {
				$param = null;
			}
		}

		return $params;
	}

	/**
	 * Возвращает конфиг для сервиса
	 *
	 * @param string $class
	 * @return array
	 */
	public function getServiceConfig($class)
	{
        if (!$this->configProvider) {
            return array();
        }

		$config = $this->configProvider->get($class);
		$service = $config->get(self::SERVICE);

		$parent = isset($service[self::PARENT])
			? $service[self::PARENT]
			: null;

		while ($parent) {
			$parentConfig = $this->configProvider->get($parent);
			$parentService = $parentConfig->get(self::SERVICE);

			if ($parentService && isset($parentService[self::INIT])) {
				$currentInit = isset($service[self::INIT])
					? $service[self::INIT]
					: array();
				$service[self::INIT] = array_merge(
					$parentService[self::INIT],
					$currentInit
				);
			}

			$parent = isset($parentService[self::PARENT])
				? $parentService[self::PARENT]
				: null;
		}

		return is_array($service) ? $service : array();
	}

}
