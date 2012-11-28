<?php

namespace Ruon\Di\ServiceLocator;

/**
 *
 * Базовая реализация Service Locator.
 *
 * @author goorus, morph
 *
 */
class ServiceLocatorStandart extends ServiceLocatorAbstract
{

	/**
	 * Отложенные состояния
	 *
	 * @var array of array
	 */
	protected $buffer = array();

	/**
	 * Экземпляры для объектов и классов
	 *
	 * @var array of object
	 */
	protected $contextInstances = array();

	/**
	 * Экземпляры без контекста
	 *
	 * @var array of array of object
	 */
	protected $publicInstances = array();

	/**
	 * Источник новых сервисов
	 *
	 * @var \Ruon\Di\ServiceSource\ServiceSourceAbstract
	 */
	protected $serviceSource = null;

	/**
	 *
	 * @param string $class
	 * @param string $context
	 * @return object
	 */
	protected function getClassInstance($class, $context)
	{
		$mark = $this->getClassMark($class, $context);
		return isset($this->contextInstances[$mark])
			? $this->contextInstances[$mark]
			: $this->getPublicInstance($class, $context);
	}

	/**
	 * Идентификатор экземпляра класса для класса
	 *
	 * @param string $class Класс
	 * @param string $context Контекст
	 * @return string
	 */
	protected function getClassMark($class, $context)
	{
		return 'C' . $context . '-' . $class;
	}

	/**
	 * Возвращает экземпляр класса
	 *
	 * @param string $class Класс, экземпляр которого будет возвращен
	 * @param string|object $context Контекст
	 * @return object Экземпляр класса $class
	 */
	public function get($class, $context)
	{
		return is_object($context)
			? $this->getObjectInstance($class, $context)
			: $this->getClassInstance($class, $context);
	}

	/**
	 * Вовзращает экземпляр для объекта
	 *
	 * @param string $class Класс
	 * @param object $context Контекст
	 * @return object Экземпляр класса $class
	 */
	protected function getObjectInstance($class, $context)
	{
		$mark = $this->getObjectMark($class, $context);
		return isset($this->contextInstances[$mark])
			? $this->contextInstances[$mark]
			: $this->getClassInstance($class, get_class($context));
	}

	/**
	 * Идентификатор экземпляра класса для объекта
	 *
	 * @param string $class
	 * @param object $context
	 * @return string
	 */
	protected function getObjectMark($class, $context)
	{
		return 'O' . spl_object_hash($context) . '-' . $class;
	}

	/**
	 * Возвращает объект без учета контекста
	 *
	 * @param string $class
     * @param mixed $context Контекст
	 * @return object
	 */
	protected function getPublicInstance($class, $context = null)
	{
		return isset($this->publicInstances[$class])
			? $this->publicInstances[$class]
			: $this->serviceSource->get($class, $context);
	}

	/**
	 * Уничтожает текущее подпространство, возвращает состояние
	 * на момент вызова метода push()
	 *
	 * @return $this|ServiceLocatorStandart
	 */
	public function pop()
	{
		list(
			$this->contextInstances,
			$this->publicInstances
		) = array_pop($this->buffer);
		return $this;
	}

	/**
	 * Создает подпространство для подмены реализаций
	 *
	 * @return $this|ServiceLocatorStandart
	 */
	public function push()
	{
		$this->buffer[] = array(
			$this->contextInstances,
			$this->publicInstances
		);
		return $this;
	}

	/**
	 * Устанавливает соответствие экземпляра класса контексту
	 *
	 * @param string $class
	 * @param string|object $context
	 * @param object $instance
	 * @return $this|ServiceLocatorStandart
	 */
	public function set($class, $context, $instance)
	{
		if (is_object($context)) {
			$mark = $this->getObjectMark($class, $context);
			$this->contextInstances[$mark] = $instance;
		} elseif ($context) {
			$mark = $this->getClassMark($class, $context);
			$this->contextInstances[$mark] = $instance;
		} else {
			$this->publicInstances[$class] = $instance;
		}

		return $this;
	}

    /**
     *
     * @param \Ruon\Di\ContainerInterface $source
     * @return $this|ServiceLocatorStandart
     */
    public function setServiceSource($source)
    {
        $this->serviceSource = $source;
        return $this;
    }

}