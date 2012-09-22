<?php

namespace Ruon\Query;

/**
 *
 * Часть запроса Where
 *
 * @author goorus, morph
 *
 */
class QueryWhere extends QueryPart
{

    /**
     * Возвращает условие
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->data[0];
    }

    /**
     * Значение для условия
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->data[1];
    }

    /**
     *
     * @return boolean
     */
    public function hasValue()
    {
        return array_key_exists(1, $this->data);
    }

}
