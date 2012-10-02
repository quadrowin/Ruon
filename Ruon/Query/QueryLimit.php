<?php

namespace Ruon\Query;

/**
 *
 * Ограничения выборки
 *
 * @author goorus, morph
 *
 */
class QueryLimit extends QueryPart
{

    /**
     *
     * @param integer $offset [optional] Отступ выборки.
     * Если нет необходимости задать отступ, но необходимо ограничить
     * количество строк в результате, следует задать $offset=null.
     * @param integer $count [optional] Ограничение выборки на количество
     * записей
     */
    public function __construct($offset = null, $count = null)
    {
        parent::__construct($offset, $count);
    }

    /**
     * Возвращает ограничение выборки на количество записей
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->data[1];
    }

    /**
     * Возвращает отступ выборки
     *
     * @return integer
     */
    public function getOffset()
    {
        return $this->data[0];
    }

    /**
     * Возвращает true, если задан отступ.
     *
     * @return boolean
     */
    public function hasOffset()
    {
        return isset($this->data[0]);
    }

    /**
     *
     * @param integer $count
     * @return $this
     */
    public function setCount($count)
    {
        $this->data[1] = $count;
        return $this;
    }

    /**
     *
     * @param integer $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->data[0] = $offset;
        return $this;
    }

}
