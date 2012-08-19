<?php

namespace Ruon\Core\Config;

/**
 *
 * Абстрактный класс конфигурации
 *
 * @author morph, goorus
 *
 */
abstract class ConfigAbstract
{
	/**
	 * Конфигурация
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Получить ключ конфигурации по пути. Путь может иметь вид:
	 * server.database.host.0
	 *
	 * @param string $path Путь вида part1.part2.part3
	 * @return mixed
	 */
	public function get($path)
	{
		if (is_null($this->data)) {
			$this->load();
			$this->data = (array) $this->data;
		}
		$parts = explode('.', $path);
		$data = $this->data;
		foreach ($parts as $part) {
			if (!isset($data[$part])) {
				return null;
			}
			$data = $data[$part];
		}
		return $data;
	}

	/**
	 * Получить всю конфигурацию
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Загружаем конфигурацию
	 */
	abstract public function load();

	/**
	 * Совместить текущую конфигурацию с переданной в агрументе
	 *
	 * @param string|ConfigAbstract $data
	 */
	public function merge($data)
	{
		$data = is_object($data) ? $data->getData() : $data;
		$this->data = array_merge(
			(array) $data, $this->data
		);
	}

	/**
	 * Изменить текущую конфигурацию
	 *
	 * @param array $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

}