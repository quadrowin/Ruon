<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг SELECT части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorSelect extends PdoPartTranslatorAbstract
{

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $selects = $this->getMyPart($query);

        $columns = array();
        foreach ($selects as $qSelect) {
            /** @var $qSelect Query\QuerySelect */
            foreach ($qSelect->getData() as $alias => $sparts) {
                if (is_array($sparts)) {
                    if (count($sparts) > 1) {
                        if (empty($sparts[0])) {
                            $source = '';
                        } else {
                            $source =
                                $this->escape($sparts[0]) .
                                self::SQL_DOT;
                        }

                        if (
                            strpos($sparts[1], self::SQL_WILDCARD) !== false ||
                            strpos($sparts[1], '(') === false ||
                            strpos($sparts[1], ' ') === false ||
                            strpos($sparts[1], '.') === false ||
                            strpos($sparts[1], '`') === false
                        ) {
                            $source .= $sparts[1];
                        } else {
                            $source .= $this->escape($sparts[1]);
                        }
                    }
                    elseif (strpos($sparts[0], self::SQL_WILDCARD) !== false)
                    {
                        $source = $sparts[0];
                    } else {
                        $source = $this->escape($sparts[0]);
                    }
                } elseif (
                    strpos($sparts, self::SQL_WILDCARD) === false &&
                    strpos($sparts, '(') === false &&
                    strpos($sparts, ' ') === false &&
                    strpos($sparts, '`') === false &&
                    strpos($sparts, '.') === false
                ) {
                    $source = $this->escape($sparts);
                } elseif (strpos($sparts, self::SQL_WILDCARD) !== false) {
                    $source = explode('.', $sparts);
                    $source[0] = $this->escape($source[0]);
                    $source = implode('.', $source);
                } else {
                    $source = $sparts;
                }

                if (is_numeric($alias)) {
                    $columns[] = $source;
                } elseif (
                    strpos($alias, self::SQL_WILDCARD) !== false ||
                    strpos($alias, '(') !== false ||
                    strpos($alias, ' ') !== false ||
                    strpos($alias, '.') !== false
                ) {
                    $columns[] = $source;
                } else {
                    $columns[] = $source . ' AS ' . $this->escape($alias);
                }
            }
        }

        $translated->appendSql(' ', implode(self::SQL_COMMA, $columns));
    }

}
