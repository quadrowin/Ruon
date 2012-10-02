<?php

namespace Ruon\ActiveRecord;

/**
 *
 * Description of ActiveRecord
 *
 * @author goorus, morph
 *
 */
class ActiveRecord implements \Ruon\Collection\CollectionInterface
{



    /**
     * Очистка содержимого коллекции
     *
     * @return $this|ActiveRecord
     */
    public function clear()
    {

    }

    /**
     * Вызывает $callback для каждого элемента коллекции
     *
     * @param function $callback
     */
    public function each($callback)
    {

    }

    /**
     * Возвращает первый элемент коллекции
     *
     * @return mixed
     */
    public function first()
    {

    }

    /**
     * Проверяет коллекцию на пустоту
     *
     * @return boolean
     */
    public function isEmpty()
    {

    }

    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

}
