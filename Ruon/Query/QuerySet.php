<?php

namespace Ruon\Query;

/**
 *
 * Часть запроса Set
 *
 * @author goorus, morph
 *
 */
class QuerySet extends QueryValues
{

    /**
     *
     * @param string $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        parent::__construct(array($field => $value));
    }

}
