<?php

namespace Ruon\DependencyInjection;

/**
 *
 * Менеджер сервисов
 *
 * @author goorus, morph
 *
 */
class ServiceManager
{

	/**
	 *
	 * @var ServiceLocator\ServiceLocatorAbstract
	 */
	protected $serviceLocator;

	/**
	 *
	 * @var ServiceSource\ServiceSourceAbstract
	 */
	protected $serviceSource;

	/**
	 * Возвращает сервис по названию
	 *
	 * @param string $service
	 * @param string $context
	 * @return mixed
	 */
	public function get($service, $context)
	{
		return $this->serviceLocator->get($service, $context)
			?: $this->serviceSource->get($service, $context);
	}

	/**
	 * Возвращает текущий локатор
	 *
	 * @return ServiceLocator\ServiceLocatorAbstract
	 */
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}

	/**
	 * Возвращает текущий источник сервисов
	 *
	 * @return ServiceSource\ServiceSourceAbstract
	 */
	public function getServiceSource()
	{
		return $this->serviceSource;
	}

	/**
	 * Подменяет локатор
	 *
	 * @param ServiceLocator\ServiceLocatorAbstract $locator
	 */
	public function setServiceLocator($locator)
	{
		$this->serviceLocator = $locator;

		return $this;
	}

	/**
	 * Подменяет источник сервисов
	 *
	 * @param ServiceSource\ServiceSourceAbstract $source
	 */
	public function setServiceSource($source)
	{
		$this->serviceSource = $source;

		return $this;
	}

}
