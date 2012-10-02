<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг DELETE части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorDelete extends PdoPartTranslatorAbstract
{

    const SQL_DELETE = 'DELETE';

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
        $deletes = $this->getMyPart($query);

        if (!$deletes) {
            return ;
        }

        $tables = '';
        foreach ($deletes as $delete) {
            /** @var $delete \Ruon\Query\QueryDelete */
            $table = array();
            foreach ($delete->getData() as $key => $part) {
                $table[$key] = strpos($part, self::SQL_ESCAPE) !== false
                    ? $part
                    : $this->modelScheme->getModelProperty($part, 'Table');

                $table[$key] = $this->escape($table[$key]);
            }
            $tables = $table
                ? ' '. implode(', ', $table) . ' '
                : ' ';
        }

        $translated->appendSql(self::SQL_DELETE, $tables);
    }

}
