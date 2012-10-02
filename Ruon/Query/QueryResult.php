<?php

namespace Ruon\Query;

/**
 *
 * Результат запроса
 *
 * @author Goorus, Morph
 *
 */
abstract class QueryResult
{

    /**
     * Возвращает все строки результата запроса
     *
     * @return array
     */
    public function rows()
    {
        $result = array();
        while ($row = $this->next()) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Возвращает следующую строку результата запроса
     *
     * @return mixed
     */
    abstract public function next();

    /**
     * Проверяет, успешно ли завершен запрос
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return true;
    }

}
