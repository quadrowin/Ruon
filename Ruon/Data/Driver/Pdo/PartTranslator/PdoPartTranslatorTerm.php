<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг определяющей тип запроса части.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorTerm extends PdoPartTranslatorAbstract
{

    /**
     * @inheritdoc
     * @param \Ruon\Query\Query $query
     * @return array
     */
    public function getMyPart($query)
    {
        return $query->getPart($query->getMainType());
    }

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $term = $query->getMainType();
        $translated->appendSql(strtoupper($term));
    }

}
