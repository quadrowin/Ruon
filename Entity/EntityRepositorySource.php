<?php

namespace Ruon\Entity;

/**
 *
 * Репозитарий сущностей в БД
 *
 * @author Goorus, Morph
 *
 */
class EntityRepositorySource extends EntityRepository
{

    /**
     * @service
     * @var \Ruon\Data\DataSource
     */
    protected $dataSource;

    /**
     * @param string $entity
     * @param array $data,
     * @param \Ruon\Query\Query $query
     * @return mixed
     */
    public function saveData($entity, $data, $query)
    {
        $statement = $this->dataSource->createStatement();

        $exec = new \Ruon\Query\Query;
        $exec
            ->add(new \Ruon\Query\QueryInsert($entity))
            ->add(new \Ruon\Query\QueryValues($data))
            ->import($query);


        return $statement->execute($exec);
    }

}
