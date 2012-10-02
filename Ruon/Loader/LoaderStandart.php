<?php

namespace Ruon\Loader;

/**
 * 
 * Стандартный обработчик загрузки классов
 *
 * @author morph, goorus
 *
 */
class LoaderStandart extends LoaderAbstract
{
	/**
	 * Загруженные классы
	 *
	 * @var array
	 */
	protected $loadedClasses;

	/**
	 * Получить загруженные классы
	 *
	 * @return array
	 */
	public function getLoadedClasses()
	{
		return $this->loadedClasses;
	}

	/**
	 * @inheritdoc
	 */
	public function load($className)
	{
		if (isset($this->loadedClasses[$className])) {
			return $this->loadedClasses[$className];
		}

		$p = strrpos($className, '\\');
		$namespace = substr($className, 0, $p);

		while (!isset($this->paths[$namespace])) {
			$p = strrpos($namespace, '\\');
			if (!$p) {
				return false;
			}
			$namespace = substr($namespace, 0, $p);
		}

		$file = rtrim($this->paths[$namespace], '/') . '/' .
			str_replace('_', '/', substr($className, $p + 1)) .
			self::PHP_EXTESION;

		if (strpos($file, '\\') !== false) {
			$file = str_replace('\\', '/', $file);
		}

		if (!file_exists($file)) {
			return false;
		}

		include $file;

		$this->loadedClasses[$className] = class_exists($className);

		return $this->loadedClasses[$className];
	}

	/**
	 * Получить загруженные классы
	 *
	 * @param array $loadedClasses
     * @return $this|LoaderStandart
	 */
	public function setLoadedClasses($loadedClasses)
	{
		$this->loadedClasses = $loadedClasses;
        return $this;
	}

}