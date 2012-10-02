<?php

namespace Ruon\Query;

/**
 * Часть запроса Insert
 *
 * @author goorus, morph
 */
class QueryInsert extends QueryPart
{

    /**
     * Возвращает название модели
     *
     * @return string
     */
    public function getModel()
    {
        return reset($this->data);
    }

}
