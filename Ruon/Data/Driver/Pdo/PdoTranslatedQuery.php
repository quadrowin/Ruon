<?php

namespace Ruon\Data\Driver\Pdo;

/**
 *
 * Подготовленный к исполнению запрос
 *
 * @author goorus, morph
 *
 */
class PdoTranslatedQuery extends \Ruon\Data\Driver\TranslatedQueryAbstract
{

    /**
     * SQL
     *
     * @var string
     */
    protected $sql;

    /**
     * Индекс последнего параметра
     *
     * @var integer
     */
    protected $valueIndex = 0;

    /**
     * Параметры запроса
     *
     * @var array
     */
    protected $values = array();

    /**
     * Добавляет параметр к запросу
     *
     * @param mixed $value
     */
    public function addValue($value)
    {
        $this->values[$this->valueIndex] = $value;
        ++$this->valueIndex;
    }

    /**
     * Дополняет запрос
     *
     * @param string $_ часть запроса
     * @return $this
     */
    public function appendSql()
    {
        $this->sql .= implode('', func_get_args());

        return $this;
    }

    /**
     * Возвращает SQL
     *
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * Возвращает все параметры запросаs
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Устанавливает SQL
     *
     * @param string $sql
     * @return $this
     */
    public function setSql($sql)
    {
        $this->sql = $sql;

        return $this;
    }

    /**
     * Устанавливает параметры запросы
     *
     * @param array $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;
        
        return $this;
    }

}
