<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг VALUES части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorValues extends PdoPartTranslatorAbstract
{

    const SQL_VALUES = 'VALUES';

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

        $fields = $values = array();

        foreach ($parts as $querySet) {
            /** @var $querySet \Ruon\Query\QuerySet */
            foreach ($querySet->getValues() as $field => $value) {
                $fields[] = $this->escape($field);
                $values[] = $this->quote($value);
            }
        }

        $fields = implode(', ', $fields);
        $values = implode(', ', $values);

        $translated->appendSql(' (', $fields, ') VALUES (', $values, ')');
    }

}
