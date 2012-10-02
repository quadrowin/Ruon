<?php

namespace Ruon\Data\Driver\Pdo;

/**
 *
 * Результат выполнения PDO запроса
 *
 * @author Goorus, Morph
 *
 */
class PdoQueryResult extends \Ruon\Query\QueryResult
{

    /**
     * Стиль возарщаемого результата
     *
     * @var integer
     */
    protected $fetchStyle = \PDO::FETCH_ASSOC;

    /**
     * Результат выполнения запроса
     *
     * @var \PDOStatement
     */
    protected $statement;

    /**
     * Результат выполнения запроса
     *
     * @var boolean
     */
    protected $result;

    /**
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->result;
    }

    /**
     * Возвращает следующую строку результата запроса
     *
     * @return mixed
     */
    public function next()
    {
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param boolean $result
     * @return $this|PdoQueryResult
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @param \PDOStatement $statement
     * @return $this|PdoQueryResult
     */
    public function setStatement($statement)
    {
       $this->statement = $statement;
       return $this;
    }

}
