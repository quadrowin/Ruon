<?php

namespace Ruon\Core\Loader;

/**
 *
 * Стандартный автозагрузчик классов. Для загрузки использует экземпляр класса
 * Loader
 *
 * @author morph, goorus
 *
 */
class LoaderAutoloadStandart extends LoaderAutoloadAbstract
{

	/**
	 * Загрузчик
	 *
	 * @var LoaderAbstract
	 */
	protected $loader;

	/**
	 * Получить текущий загрузчик
	 *
	 * @return LoaderAbstract
	 */
	public function getLoader()
	{
		return $this->loader;
	}

	/**
	 * @inheritdoc
	 * @see LoaderAutoloadAbstract::register
	 */
	public function register()
	{
		spl_autoload_register(array($this->loader, 'load'));
		return true;
	}

	/**
	 * Изменить текущего загрузчика
	 *
	 * @param LoaderAbstract $loader Загрузчик
	 * @return $this|LoaderAutoloadStandart
	 */
	public function setLoader($loader)
	{
		$this->loader = $loader;
		return $this;
	}

	/**
	 * @inheritdoc
	 * @see LoaderAutoloadAbstract::unregister
	 */
	public function unregister()
	{
		spl_autoload_unregister(array($this->loader, 'load'));
		return true;
	}
}