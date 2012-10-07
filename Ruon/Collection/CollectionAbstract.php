<?php

namespace Ruon\Collection;

/**
 *
 * Абстрактный класс коллекции
 *
 * @author Goorus, Morph
 *
 */
abstract class CollectionAbstract implements \IteratorAggregate
{

    /**
     * Класс итератора по умолчанию
     *
     * @var string
     */
    protected $defaultIterator = 'Ruon\\Collection\\Iterator\\CollectionIteratorInitializes';

    /**
     *
     * @var string
     */
    protected $entityName;

    /**
     * Очистка содержимого коллекции
     *
     * @return $this|CollectionInterface
     */
    abstract public function clear();

    /**
     * Вызывает $callback для каждого элемента коллекции
     *
     * @param function $callback
     */
    abstract public function each($callback);

    /**
     * Возвращает первый элемент коллекции
     *
     * @return mixed
     */
    abstract public function first();

    /**
     *
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @return \Iterator
     */
    public function getIterator($class = null)
    {
        if (!$class) {
            $class = $this->defaultIterator;
        }
        /* @var $iterator Iterator\CollectionIteratorAbstract */
        $iterator = new $class;
        return $iterator->setCollection($this);
    }

    /**
     * Возвращает все элементы коллекции
     *
     * @return array
     */
    abstract public function &getItems();

    /**
     * Проверяет коллекцию на пустоту
     *
     * @return boolean
     */
    abstract public function isEmpty();

    /**
     *
     * @param string $name
     * @return $this|CollectionAbstract
     */
    public function setEntityName($name)
    {
        $this->entityName = $name;
        return $this;
    }

}
