<?php

namespace Ruon\Annotation;

/**
 * Строка с набором аннотаций класса, метода или поля
 *
 * @author morph, goorus
 */
class AnnotationRow
{
	/**
	 * Набор аннотаций
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Конструктор
	 *
	 * @param array $data Набор аннотаций
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}

	/**
	 * Получить аннотацию
	 *
	 * @param string $name
	 * @return Ruon\Annotation\Annotation
	 */
	public function get($name)
	{
		return isset($this->data[$name]) ? $this->data[$name] : null;
	}

	/**
	 * Изменить аннотацию
	 *
	 * @param string $name
	 * @param Ruon\Annotation\Annotation $annotation
	 */
	public function set($name, $annotation)
	{
		$this->data[$name] = $annotation;
	}
}