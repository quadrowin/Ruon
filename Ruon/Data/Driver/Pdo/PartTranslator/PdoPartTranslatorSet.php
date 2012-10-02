<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг SET части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorSet extends PdoPartTranslatorAbstract
{

    const SQL_SET = 'SET';

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

        $sets = array();

        foreach ($parts as $setQuery) {
            /** @var $setQuery \Ruon\Query\QuerySet */
            var_dump($setQuery->getValues());
            foreach ($setQuery->getValues() as $field => $value) {
                if (
                    strpos($field, '?') !== false ||
                    strpos($field, '=') !== false
                ) {
                    $sets[] = str_replace('?', $this->quote($value), $field);
                } else {
                    $sets[] = $this->escape($field) . '=' . $this->quote($value);
                }
            }
        }

        $translated->appendSql(' ', self::SQL_SET, ' ', implode(', ', $sets));
    }

}
