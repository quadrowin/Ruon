<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг GROUP части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorGroup extends PdoPartTranslatorAbstract
{

    const SQL_GROUP_BY = 'GROUP BY';

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $groups = $this->getMyPart($query);

        if (!$groups) {
            return ;
        }

        $columns = array();
        foreach ($groups as $column) {
            if (
                strpos($column, '(') !== false ||
                strpos($column, '`') !== false
            ) {
                $columns[] = $column;
            } elseif (strpos($column, self::SQL_DOT) !== false) {
                $column = explode(self::SQL_DOT, $column);
                $column = array_map(array($this, 'escape'), $column);
                $columns[] = implode(self::SQL_DOT, $column);
            } else {
                $columns[] = $this->escape($column);
            }
        }

        $translated->appendSql(
            self::SQL_GROUP_BY, ' ',
            implode(self::SQL_COMMA, $columns)
        );
    }

}
