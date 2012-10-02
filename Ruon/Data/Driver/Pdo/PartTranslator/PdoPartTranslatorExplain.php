<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг EXPLAIN части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorExplain extends PdoPartTranslatorAbstract
{

    const SQL_EXPLAIN = 'EXPLAIN';

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        if (!$this->getMyPart($query)) {
            return ;
        }

        $translated->appendSql(self::SQL_EXPLAIN, ' ');
    }

}
