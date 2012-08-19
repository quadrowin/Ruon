<?php

namespace Ruon\Core\DependencyInjection\ServiceLocator;

/**
 *
 * Базовая реализация Service Locator.
 *
 * @author goorus, morph
 *
 */
class ServiceLocatorAbstract
{

	/**
	 * Возвращает экземпляр класса
	 *
	 * @param string $class Класс, экземпляр которого будет возвращен
	 * @param string|object $context Контекст
	 * @return object Экземпляр класса $class
	 */
	public function get($class, $context) {}

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
	public function set($class, $context, $instance) {}

}