<?php

namespace Ruon\Data;

/**
 *
 * POST параметры
 *
 * @author goorus, morph
 *
 */
class DataRepositoryPost extends DataRepositoryArray
{

    public function __construct()
    {
        $this->data = $_POST;
    }

}
