<?php

namespace Ruon\Core\Loader;

/**
 *
 * Абстрактный обработчик загрузки классов. Необходим для того, чтобы
 * загрузчик мог делегировать на него сам процесс загрузки класса.
 *
 * @author morph, goorus
 *
 */
abstract class LoaderAbstract
{

	/**
	 * Расширение подключаемых файлов
	 *
	 * @var string
	 */
	const PHP_EXTESION = '.php';

	/**
	 * Пути для загрузки файлов
	 *
	 * @var array
	 */
	protected $paths = array();

	/**
	 * Возвращает все пути обработчика загрузки
	 *
	 * @return array
	 */
	public function getPaths()
	{
		return $this->paths;
	}

	/**
	 * Загружает класс по имени класса
	 *
	 * @param string $className Имя класса
	 * @return boolean true - если класс загружен, false - в противном случае
	 */
	abstract public function load($className);

	/**
	 * Заменяет прикрепленную к неймспейску директорию новой директорией. Если
	 * к неймспейсу ранее не была прикреплена директория, то к нему прикрепится
	 * данная директория. Если в качестве агрумента $path указан null, то
	 * прикрепленная директория будет убрана из данного неймспейса
	 *
	 * @param string $namespace Неймспейс
	 * @param string $path Директория или null, если нужно убрать прикрепленную
	 * директорию
	 * @return $this|LoaderAbstract
	 */
	public function setPath($namespace, $path)
	{
		$this->paths[$namespace] = $path;
		return $this;
	}

	/**
	 * Изменяет все пути закрузки обработчика
	 *
	 * @param array $paths Массив путей загрузчика вида: namespace => path
	 * @return $this|LoaderAbstract
	 */
	public function setPaths(array $paths)
	{
		$this->paths = $paths;
		return $this;
	}

}
