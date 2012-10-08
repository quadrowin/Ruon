<?php

namespace Ruon\Query;

/**
 *
 * Часть запроса Where
 *
 * @author goorus, morph
 *
 */
class QueryWhere extends QueryPart
{

    /**
     * @var mixed
     */
    protected $left;

    /**
     * @var mixed
     */
    protected $operator;

    /**
     * @var mixed
     */
    protected $right;

    /**
     *
     * @param mixed $left
     * @param mixed $operation
     * @param mixed $right
     */
    public function __construct($left, $operator = null, $right = null)
    {
        $this->left = $left;
        $this->operator = $operator;
        $This->right = $right;
    }

    /**
     * Левая часть выражения
     *
     * @return string
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Оператор
     *
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Правая часть выражения
     *
     * @return mixed
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     *
     * @return boolean
     */
    public function __toString()
    {
        return "{$this->left} {$this->operator} {$this->right}";
    }

}
