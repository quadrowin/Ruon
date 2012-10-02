<?php

namespace Ruon\Annotation;

/**
 * Аннотация класса, метода или поля
 *
 * @author morph, goorus
 */
class Annotation
{
	/**
	 * Полученные данные аннотаций
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Имя аннотации
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Конструктор
	 *
	 * @param array $data Данные для аннотации
	 */
	public function __construct($name, $data)
	{
		$this->name = $name;
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$value = new self($key, $value);
			}
			$this->data[$key] = $value;
		}
	}

	/**
	 * Получить значение аннотации
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		return isset($this->data[$name]) ? $this->data[$name] : null;
	}

	/**
	 * Изменить значение аннотации
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return \Ruon\Annotation\Annotation\Annotation
	 */
	public function __set($name, $value)
	{
		$this->data[$name] = $value;
		return $this;
	}

	/**
	 * Получить имя аннотации
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}