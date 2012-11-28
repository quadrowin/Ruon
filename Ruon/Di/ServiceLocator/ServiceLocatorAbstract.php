<?php

namespace Ruon\Di\ServiceLocator;

/**
 *
 * Базовая реализация Service Locator.
 *
 * @author goorus, morph
 *
 */
abstract class ServiceLocatorAbstract
{

	/**
	 * Возвращает экземпляр класса
	 *
	 * @param string $class Класс, экземпляр которого будет возвращен
	 * @param string|object $context Контекст
	 * @return object Экземпляр класса $class
	 */
	abstract public function get($class, $context);

	/**
	 * Уничтожает текущее подпространство, возвращает состояние
	 * на момент вызова метода push()
	 *
	 * @return $this Этот объект
	 */
	public function pop() {}

	/**
	 * Создает подпространство для подмены реализаций
	 *
	 * @return $this Этот объект
	 */
	public function push() {}

	/**
	 * Устанавливает соответствие экземпляра класса контексту
	 *
	 * @param string $class
	 * @param string|object $context
	 * @param object $instance
	 */
	abstract public function set($class, $context, $instance);

}