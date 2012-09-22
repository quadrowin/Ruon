<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг INDEX части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorIndex extends PdoPartTranslatorAbstract
{

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $indexes = $this->getMyPart($query);

        if (!$indexes) {
            return ;
        }

        $translated->appendSql(
            $indexes[1],
            '(', implode(',', (array) $indexes[0]), ')'
        );
    }

}
