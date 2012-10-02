<?php

namespace Ruon\Query;

/**
 *
 * Часть запроса Update
 *
 * @author goorus, morph
 *
 */
class QueryUpdate extends QueryPart
{

    /**
     *
     * @return string
     */
    public function getModel()
    {
        return reset($this->data);
    }

}
