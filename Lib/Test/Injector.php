<?php

namespace Ruon\Lib\Test;

/**
 * 
 * Позволяет устанавливать и получать недоступные свойства.
 *
 * @author goorus, morph
 * 
 */
class Injector
{

	/**
	 * Возвращает значение свойства объекта
	 *
	 * @param object $object
	 * @param string $property
	 */
	public function get($object, $property)
	{
		$ref = new \ReflectionProperty($object, $property);
		$ref->setAccessible(true);
		return $ref->getValue($object);
	}

	/**
	 * Устанавливает значение свойства
	 *
	 * @param object $object
	 * @param string $property
	 * @param mixed $value
	 * @return $this
	 */
	public function set($object, $property, $value)
	{
		$ref = new \ReflectionProperty($object, $property);
		$ref->setAccessible(true);
		$ref->setValue($object, $value);
		return $this;
	}

}
