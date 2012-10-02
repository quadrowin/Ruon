<?php

namespace Ruon\Query;

/**
 *
 * Часть запроса From
 *
 * @author goorus, morph
 *
 */
class QueryFrom extends QueryPart
{

    /**
     * @return boolean
     */
    public function isSubquery()
    {
        return $this->data[0] instanceof Query;
    }
}
