<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг HAVING части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorHaving extends PdoPartTranslatorAbstract
{

    const SQL_HAVING = 'HAVING';

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $having = $this->getMyPart($query);

        if (!$having) {
            return ;
        }

        $translated->appendSql(self::SQL_HAVING, ' ', $having);
    }

}
