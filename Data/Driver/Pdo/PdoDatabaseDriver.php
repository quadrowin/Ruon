<?php

namespace Ruon\Data\Driver\Pdo;

/**
 *
 * Источник данных PDO
 *
 * @author goorus, morph
 *
 */
class PdoDatabaseDriver extends \Ruon\Data\Driver\DataDriverAbstract
{

    /**
     * Переводчик
     *
     * @service
     * @var PdoQueryTranslator
     */
    protected $translator;

    /**
     *
     * @param PdoTranslatedQuery $query
     */
    public function executeTranslated($query)
    {

    }

}
