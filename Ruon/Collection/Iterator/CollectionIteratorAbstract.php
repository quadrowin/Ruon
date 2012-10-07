<?php

namespace Ruon\Collection\Iterator;

/**
 *
 *
 *
 * @author Goorus
 *
 */
abstract class CollectionIteratorAbstract implements \Iterator
{

    /**
     *
     * @var \ArrayIterator
     */
    protected $arrayIterator;

    /**
     *
     * @var \Ruon\Collection\CollectionAbstract
     */
    protected $collection;

    /**
     * Возвращает текущий элемент
     *
     * @return \Ruon\Entity\Entity
     */
    abstract public function current();

    /**
     *
     * @return \Ruon\Collection\CollectionAbstract
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @return \ArrayIterator
     */
    public function getArrayIterator()
    {
        return $this->arrayIterator;
    }

    /**
     * @return mixed
     */
    public function key()
    {
        $this->arrayIterator->key();
    }

    /**
     * @return \Ruon\Entity\Entity
     */
    abstract public function next();

    /**
     * Сбрасывает итератор и возвращает первый элемент коллекции
     *
     * @return \Ruon\Entity\Entity
     */
    abstract public function rewind();

    /**
     *
     * @param \Ruon\Collection\CollectionAbstract $collection
     * @return $this|CollectionIteratorAbstract
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        $items = &$this->collection->getItems();
        $this->arrayIterator = new \ArrayIterator($items);
        return $this;
    }

    /**
     * @return boolean
     */
    public function valid($key)
    {
        return $this->arrayIterator->valid($key);
    }

}
