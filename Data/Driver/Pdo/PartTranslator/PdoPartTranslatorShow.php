<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг SHOW части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorShow extends PdoPartTranslatorAbstract
{

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $sql = $this->getMyPart($query);

        $translated->appendSql($sql);
    }

}
