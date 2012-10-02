<?php

namespace Ruon\Data;

/**
 *
 * GET параметры
 *
 * @author goorus, morph
 *
 */
class DataRepositoryGet extends DataRepositoryArray
{

    public function __construct()
    {
        $this->data = $_GET;
    }

}
