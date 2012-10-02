<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг CALC_FOUND_ROWS части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorCalcFoundRows extends PdoPartTranslatorAbstract
{

    const SQL_CALC_FOUND_ROWS = 'SQL_CALC_FOUND_ROWS';

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        if (!$this->getMyPart($query)) {
            return ;
        }

        $translated->appendSql(' ', self::SQL_CALC_FOUND_ROWS);
    }

}
