<?php

namespace Ruon\DependencyInjection\ServiceSource;

/**
 *
 * Создание сервисов по описанию в конфигах
 *
 * @author goorus, morph
 *
 */
abstract class ServiceSourceAbstract
{

	/**
	 * Менеджер конфигов
	 *
	 * @var \Ruon\Config\ConfigProviderInterface
	 */
	protected $configProvider;

	/**
	 * Менеджер существующих необходимых сервисов
	 *
	 * @var ContainerInterface
	 */
	protected $serviceManager;

	/**
	 * Инициализирует используемые в объекте зависимости
	 *
	 * @var \Ruon\DependencyInjection\Injector\InjectorAbstract
	 */
	protected $injector;

	/**
	 * Возвращает сервис, описанный в конфигах
	 *
	 * @param string $class Название сервиса
	 * @param array $context Аргументы конструктора (ассоциативный массив)
	 * @return object Сервис
	 */
	abstract public function get($class, $context);

	/**
	 * Возвращает текущий инжектор
	 *
	 * @return \Ruon\DependencyInjection\Injector\InjectorAbstract
	 */
	public function getInjector()
	{
		return $this->injector;
	}

	/**
	 * Возвращает конфиг для сервиса
	 *
	 * @param string $class
	 * @return array
	 */
	abstract public function getServiceConfig($class);

	/**
	 * Возвращает текущий менеджер конфигов
	 *
	 * @return \Ruon\Config\ConfigProviderInterface
	 */
	public function getConfigProvider()
	{
		return $this->configProvider;
	}

	/**
	 * Возвращает текущий менеджер сервисов
	 *
	 * @return ServiceManager
	 */
	public function getServiceManager()
	{
		return $this->serviceManager;
	}

	/**
	 * Устанавливает менеджер конфигов
	 *
	 * @param \Ruon\Config\ConfigProviderInterface $provider
	 * @return $this|ServiceSourceAbstract
	 */
	public function setConfigProvider($provider)
	{
		$this->configProvider = $provider;
		return $this;
	}

	/**
	 * Устанавливает инжектор зависимостей
	 *
	 * @param \Ruon\DependencyInjection\Injector\InjectorAbstract $injector
	 * @return $this|ServiceSourceAbstract
	 */
	public function setInjector($injector)
	{
		$this->injector = $injector;
		return $this;
	}

	/**
	 * Устанавливает менеджер сервисов
	 *
	 * @param ContainerInterface $manager
	 * @return $this|ServiceSourceAbstract
	 */
	public function setServiceManager($manager)
	{
		$this->serviceManager = $manager;
		return $this;
	}

}
