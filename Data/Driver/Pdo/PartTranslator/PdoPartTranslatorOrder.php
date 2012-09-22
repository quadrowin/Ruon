<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг ORDER части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorOrder extends PdoPartTranslatorAbstract
{

    const SQL_ASC = 'ASC';

    const SQL_DESC = 'DESC';

    const SQL_ORDER_BY = 'ORDER BY';

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $orders = $this->getMyPart($query);

        if (!$orders) {
            return ;
        }

        $columns = array();
        foreach ($orders as $order) {
            $field = explode(self::SQL_DOT, $order[0]);
            $field = array_map(array($this, 'escape'), $field);
            $field = implode(self::SQL_DOT, $field);

            if ($order[1] == self::SQL_DESC) {
                $columns[] = $field . ' ' . self::SQL_DESC;
            } else {
                $columns[] = $field;
            }
        }

        $translated->appendSql(
            ' ORDER BY ',
            implode(self::SQL_COMMA, $columns)
        );
    }

}
