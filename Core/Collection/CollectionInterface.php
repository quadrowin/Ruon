<?php

namespace Ruon\Core\Collection;

/**
 *
 * Интерфейс коллекции
 *
 * @author Goorus, Morph
 *
 */
interface CollectionInterface
{

    /**
     * Очистка содержимого коллекции
     *
     * @return $this|CollectionInterface
     */
    public function clear();

    /**
     * Вызывает $callback для каждого элемента коллекции
     *
     * @param function $callback
     */
    public function each($callback);

    /**
     * Возвращает первый элемент коллекции
     *
     * @return mixed
     */
    public function first();

    /**
     * Проверяет коллекцию на пустоту
     *
     * @return boolean
     */
    public function isEmpty();

}
