<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг FROM части запроса.
 *
 * @author goorus, morph
 * 
 */
class PdoPartTranslatorFrom extends PdoPartTranslatorAbstract
{

    const SQL_FROM = 'FROM';

    const SQL_INNER_JOIN = 'INNER JOIN';

    const SQL_LEFT_JOIN = 'LEFT JOIN';

    const SQL_ON = 'ON';

    const SQL_RIGHT_JOIN = 'RIGHT JOIN';

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
        $i = 0;
        $from = $this->getMyPart($query);

        if (!$from) {
            return ;
        }

        $translated->appendSql(' ', self::SQL_FROM);

        if (count($from) > 1) {
            foreach ($from as $a => $v) {
                if ($v[Query::JOIN] == Query::FROM) {
                    unset($from[$a]);
                    $from = array_merge(array($a => $v), $from);
                    break;
                }
            }
        }

        $froms = $from;

        foreach ($froms as $alias => $from) {
            if ($from->isSubquery()) {
                $table = '(' .
                    $this->renderSubquery($from->getDataAt(0), $translated) .
                ')';
            } else {
                $alias = $from->getDataAt(0);

                $table = strpos($alias, self::SQL_ESCAPE) !== false
                    ? $alias
                    : $this->modelScheme->getModelProperty($alias, 'Table');

                if ($table) {
                    $table = $this->escape($table);
                }
            }

            if ($alias) {
                $alias = $this->escape($alias);
            }

            if (!$from->getDataAt(1)) {
                $translated->appendSql(
                    $i ? self::SQL_COMMA : ' ',
                    $table,
                    $alias ? ' AS ' . $alias : ''
                );
            } else {
                if (is_array($from[Query::WHERE])) {
                    $where =
                        $this->escape($from[Query::WHERE][0]) .
                        self::SQL_DOT .
                        $this->escape($from[Query::WHERE][1]) .
                        '=' .
                        $this->escape($from[Query::WHERE][2]) .
                        self::SQL_DOT .
                        $this->escape($from[Query::WHERE][3]);
                } else {
                    $where = $from[Query::WHERE];
                }
                $translated->appendSql(' ',
                    $from[Query::JOIN], ' ',
                    $table, ' AS ', $alias, ' ',
                    self::SQL_ON,
                    '(', $from[Query::WHERE], ')'
                );
            }
            ++$i;
        }
    }

}
