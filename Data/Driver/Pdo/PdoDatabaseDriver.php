<?php

namespace Ruon\Data\Driver\Pdo;

/**
 *
 * Источник данных PDO
 *
 * @author goorus, morph
 *
 */
class PdoDatabaseDriver extends \Ruon\Data\Driver\DataDriverAbstract
{

    /**
     *
     * @var string
     */
    protected $address = 'localhost';

    /**
     *
     * @var \PDO
     */
    protected $handle;

    /**
     *
     * @var string
     */
    protected $password = '';

    /**
     * Переводчик
     *
     * @service
     * @var PdoQueryTranslator
     */
    protected $translator;

    /**
     *
     * @var string
     */
    protected $username = 'root';

    /**
     *
     * @param PdoTranslatedQuery $query
     * @return \PDO
     */
    public function executeTranslated($query)
    {
        $stm = $this->getHandle()->prepare($query->getSql());
        $stm->execute($query->getValues());

        return $stm;
    }

    /**
     *
     * @param \PDO $result
     */
    public function extractResult($result)
    {
        $items = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $row;
        }

        return $items;
    }

    /**
     *
     * @return \PDO
     */
    public function getHandle()
    {
        if (!$this->handle) {
            $this->handle = new \PDO(
                $this->address,
                $this->username,
                $this->password
            );
        }

        return $this->handle;
    }

}
