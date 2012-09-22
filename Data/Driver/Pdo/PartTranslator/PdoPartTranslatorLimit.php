<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг LIMIT части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorLimit extends PdoPartTranslatorAbstract
{

    const SQL_LIMIT = 'LIMIT';

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $queryLimit = $this->getMyPart($query);

        if (!$queryLimit) {
            return ;
        }

        $queryLimit = end($queryLimit);
        /* @var $queryLimit \Ruon\Query\QueryLimit */

        if ($queryLimit->hasOffset()) {
            $translated->appendSql(
                ' LIMIT ',
                (int) $queryLimit->getOffset(),
                self::SQL_COMMA,
                (int) $queryLimit->getCount()
            );
        } else {
            $translated->appendSql(
                ' LIMIT ',
                (int) $queryLimit->getCount()
            );
        }
    }

}
