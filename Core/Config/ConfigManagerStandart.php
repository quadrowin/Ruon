<?php

namespace Ruon\Core\Config;

/**
 *
 * Страндартный обработчик менеджера конфигураций
 *
 * @author morph, goorus
 */
class ConfigManagerStandart extends ConfigManagerAbstract
{
	/**
	 * Классы конфигурации для различных классов
	 *
	 * @access protected
	 * @var array
	 */
	protected $configClasses;

	/**
	 * Имя класса конфигурации по умолчанию
	 *
	 * @access protected
	 * @var string
	 */
	protected $defaultConfigClass = 'Ruon\\Core\\Config\\ConfigArray';

	/**
	 * Репозиторий для хранения конфигов
	 *
	 * @access protected
	 * @var Ruon\Core\Config\ConfigRepositoryAbstract
	 */
	protected $repository;

	/**
	 * Загрузчик конфигурации
	 *
	 * @access protected
	 * @var Ruon\Core\Config\ConfigLoaderAbstract
	 */
	protected $loader;

	/**
	 * Создает пустой класс конфигураций
	 *
	 * @param string $className Название класса конфигураций
	 * @param array $data Данные
	 * @return Ruon\Core\Config\ConfigAbstract
	 */
	public function create($className, $data)
	{
		$config = new $className;
		$config->setData($data);
		return $config;
	}

	/**
	 * @inheritdoc
	 */
	public function get($className, $classConfig = array())
	{
		if (!$this->repository->exists($className)) {
			$configClass = $this->getConfigClassFor($className);
			$data = $this->loader->load($className) ?: array();
			$config = $this->create($configClass, $data);
			$config->merge($classConfig);
			$this->repository->set($className, $config);
		} else {
			$config = $this->repository->get($className);
		}
		return $config;
	}

	/**
	 * Получить название класса конфигурации для определенного класса
	 *
	 * @param string $className
	 * @return string
	 */
	public function getConfigClassFor($className)
	{
		if (isset($this->configClasses[$className])) {
			return $this->configClasses[$className];
		}
		$configClass = $this->defaultConfigClass;
		$parents = class_parents($className);
		if ($parents) {
			foreach ($parents as $parent) {
				if (isset($this->configClasses[$parent])) {
					$configClass = $this->configClasses[$parent];
					break;
				}
			}
		}
		$this->configClasses[$className] = $configClass;
		return $configClass;
	}

	/**
	 * Получить классы конфигурации для различных классов
	 *
	 * @return array
	 */
	public function getConfigClasses()
	{
		return $this->configClasses;
	}

	/**
	 * Получить название класса конфигурации по умолчанию
	 *
	 * @return string
	 */
	public function getDefaultConfigClass()
	{
		return $this->defaultConfigClass;
	}

	/**
	 * Получить хранилище конфигураций
	 *
	 * @return Ruon\Core\Config\ConfigRepositoryAbstract
	 */
	public function getRepository()
	{
		return $this->repository;
	}

	/**
	 * Получить загрузчика конфигураций
	 *
	 * @return Ruon\Core\Config\ConfigLoaderAbstract
	 */
	public function getLoader()
	{
		return $this->loader;
	}

	/**
	 * Установить класс конфигурации для определенно класса
	 *
	 * @param string $className Название класса
	 * @param string $configClass Название класса конфигурации
	 */
	public function setConfigClassFor($className, $configClass)
	{
		$this->configClasses[$className] = $configClass;
	}

	/**
	 * Установить классы конфигурации для различных классов
	 *
	 * @param array $configClasses
	 */
	public function setConfigClasses($configClasses)
	{
		$this->configClasses = $configClasses;
	}

	/**
	 * Изменить название класса конфигурации по умолчанию
	 *
	 * @param string $defaultConfigClass
	 */
	public function setDefaultConfigClass($defaultConfigClass)
	{
		$this->defaultConfigClass = $defaultConfigClass;
	}

	/**
	 * Изменить хранилище конфигураций
	 *
	 * @param Ruon\Core\Config\ConfigRepositoryAbstract $repository
	 */
	public function setRepository($repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Изменить загрузчика конфигураций
	 *
	 * @param Ruon\Core\Config\ConfigLoaderAbstract $loader
	 */
	public function setLoader($loader)
	{
		$this->loader = $loader;
	}
}