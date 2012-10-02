<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг DISTINCT части запроса.
 *
 * @author goorus, morph
 * 
 */
class PdoPartTranslatorDistinct extends PdoPartTranslatorAbstract
{

    const SQL_DISTINCT = 'DISTINCT';

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

        $translated->appendSql(self::SQL_DISTINCT, ' ');
    }

}
