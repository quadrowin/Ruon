<?php

namespace Ruon\Core\Collection;

/**
 *
 * Коллекция, содержащая список элементов
 *
 * @author Goorus, Morph
 *
 */
class CollectionArray implements CollectionInterface
{

    /**
     * Элементы коллекции
     *
     * @var array of mixed
     */
    protected $items = array();

    /**
     * Очищает коллекцию
     *
     * @return $this|CollectionArray
     */
    public function clear()
    {
        $this->items = array();

        return $this;
    }

    /**
     * Вызывает $callback для каждого элемента коллекции
     *
     * @param callback $callback
     */
    public function each($callback)
    {
        foreach ($this->items as $item) {
            call_user_func($callback, $item);
        }
    }

    /**
     * Возвращает первый элемент коллекции
     *
     * @return mixed
     */
    public function first()
    {
        return reset($this->items);
    }

    /**
     * Возвращает элементы коллекции
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Возвращает первый элемент коллекции
     *
     * @return mixed
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * Устанавливает список элементов
     *
     * @param array $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

}
