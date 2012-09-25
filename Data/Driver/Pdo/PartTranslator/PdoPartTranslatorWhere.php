<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг WHERE части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorWhere extends PdoPartTranslatorAbstract
{

    const SQL_AND = 'AND';

    const SQL_IN = 'IN';

    const SQL_LIKE = 'LIKE';

    const SQL_RLIKE = 'RLIKE';

    const SQL_WHERE = 'WHERE';

    const WHERE_VALUE_CHAR = '?';

    /**
     * Экранирование условий запроса
     *
     * @param string $condition
     * @param mixed $value [optional]
     * @return string
     */
    protected function quoteCondition($condition)
    {
        if (func_num_args() == 1) {
            return $condition;
        }

        $value = func_get_arg(1);

        if (strpos($condition, self::WHERE_VALUE_CHAR) === false) {
            if (is_array($value)) {
                $value = ' IN (' . $this->renderInArray($value) . ')';
            } else {
                $value = '=' . $this->quote($value);
            }

            if (
                strpos($condition, '(') === false &&
                strpos($condition, ' ') === false &&
                strpos($condition, '.') === false &&
                strpos($condition, '`') === false
            ) {
                return $this->escape($condition) . $value;
            }

            return $condition . $value;
        } else {
            $charPos = 0;

            if (is_array($value)) {
                foreach ($value as $key => $val) {
                    if (!is_numeric($key)) {
                        $condition = str_replace(
                            ':' . $key,
                            is_array($val)
                                ? $this->renderInArray($val)
                                : $this->quote($val),
                            $condition
                        );
                    }
                }
            }

            $value = (array) $value;
            $i = 0;

            while ($charPos !== false) {
                $charPos = strpos(
                    $condition,
                    self::WHERE_VALUE_CHAR,
                    $charPos
                );

                if ($charPos === false) {
                    break;
                }

                if (!array_key_exists($i, $value)) {
                    break;
                }

                $val = $value[$i];
                $val = is_array($val)
                    ? $this->renderInArray($val)
                    : $this->quote($val);
                $left = substr($condition, 0, $charPos);
                $right = substr($condition, $charPos + 1);
                $condition = $left . $val . $right;
                $charPos += strlen($val);
                $i++;
            }

            return $condition;
        }
    }

    /**
     * Рендерит mysql терм если он массив
     *
     * @param array $value
     * @return string
     */
    protected function renderInArray(array $value)
    {
        if (empty($value)) {
            return 'NULL';
        }

        $result = implode(',', array_map(array($this, 'quote'), $value));

        return $result;
    }

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query $query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery $translated
     */
    public function translate($query, $translated)
    {
        $wheres = $this->getMyPart($query);

        if (!$wheres) {
            return '';
        }

        $translated->appendSql(' WHERE ');

        foreach ($wheres as $i => $where) {
            /* @var $where \Ruon\Query\QueryWhere */
            if ($i > 0) {
                $translated->appendSql(' AND ');
            }

            $condition = $where->getCondition();

            if ($where->hasValue()) {
                $value = $where->getValue();
                if ($value instanceof Query\Query) {
                    $value = '(' .
                        $this->renderSubquery($value) .
                    ')';
                }

                $translated->appendSql(
                    $this->quoteCondition($condition, $value)
                );
            } else {
                if ($condition instanceof Query) {
                    $translated->appendSql(
                        '(' . $this->renderSubquery($condition) . ')'
                    );
                } else {
                    $translated->appendSql(
                         $this->quoteCondition($condition)
                    );
                }
            }
        }
    }

}
