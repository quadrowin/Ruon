<?php

namespace Ruon\Query;

/**
 *
 * Запрос
 *
 * @author morph, goorus
 *
 */
class Query
{

    /**
     * Части запроса
     *
     * @var array of array of QueryPart
     */
    protected $parts = array();

    /**
     * Тип запроса
     *
     * @var string
     */
    protected $mainType;

    /**
     * Создает и возвращает новый запрос.
     * Аналогично "new Query()".
     * @return Query Новый запрос.
     */
    public static function instance()
    {
        return new self();
    }

    /**
     * Добавляет новую часть к запросу
     *
     * @param QueryPart $part
     * @param QueryPart $_
     * @return $this
     */
    public function add($part)
    {
        $type = $part->getType();
        $this->parts[$type][] = $part;
        if (!$this->mainType) {
            $this->mainType = $type;
        }

        for ($i = 1, $count = func_num_args(); $i < $count; ++$i) {
            $part = func_get_arg($i);
            $type = $part->getType();
            $this->parts[$type][] = $part;
        }

        return $this;
    }

    /**
     * Возвращает тип запроса
     *
     * @return string
     */
    public function getMainType()
    {
        return $this->mainType;
    }

    /**
     * Возвращает части запроса указанного типа
     *
     * @param string $type Тип части запроса
     * @return array
     */
    public function getPart($type)
    {
        return isset($this->parts[$type])
            ? $this->parts[$type]
            : array();
    }

    /**
     * Возвращает части запроса
     *
     * @return array
     */
    public function getParts()
    {
        return $this->parts;
    }

}