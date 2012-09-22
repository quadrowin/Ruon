<?php

namespace Ruon\Data\Driver;

/**
 * Description of QueryTranslatorAbstract
 *
 * @author goorus, morph
 */
abstract class QueryTranslatorAbstract
{

    /**
     * Преобразует запрос к необходимому для выполнения драйвером формату.
     *
     * @param \Ruon\Query\Query
     */
    abstract public function translate($query);

}
