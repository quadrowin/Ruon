<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг UPDATE части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorUpdate extends PdoPartTranslatorAbstract
{

    const SQL_UPDATE = 'UPDATE';

    /**
     * @service
     * @var \Ruon\Entity\EntityScheme
     */
    protected $modelScheme;

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $parts = $this->getMyPart($query);

        if (!$parts) {
            return;
        }

        $model = $parts[0]->getModel();
        $table = $this->modelScheme->getModelProperty($model, 'Table');

        $translated->appendSql(
            ' ',
            $this->escape($table)
        );
    }

}
