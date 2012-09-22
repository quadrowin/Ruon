<?php

namespace Ruon\Query;

/**
 *
 * Часть запроса Set
 *
 * @author goorus, morph
 *
 */
class QueryValues extends QueryPart
{

    /**
     * Массив пар (ключ => значение)
     *
     * @return array
     */
    public function getValues()
    {
        return reset($this->data);
    }

}
