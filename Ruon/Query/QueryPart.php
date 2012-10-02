<?php

namespace Ruon\Query;

/**
 *
 * Часть запроса
 *
 * @author goorus, morph
 *
 */
abstract class QueryPart
{

    /**
     * Значение
     *
     * @var array
     */
    protected $data;

    /**
     *
     * @param mixed $_
     */
    public function __construct()
    {
        $this->data = func_get_args();
    }

    /**
     * Возвращает значение
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Возвращает значение по индексу
     *
     * @return mixed
     */
    public function getDataAt($index)
    {
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * Возвращает тип части запроса
     *
     * @return string
     */
    public static function getType()
    {
        return substr(get_called_class(), strlen('Ruon\\Query\\Query'));
    }

}
