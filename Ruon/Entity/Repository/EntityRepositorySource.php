<?php

namespace Ruon\Entity\Repository;

/**
 *
 * Репозитарий сущностей в БД
 *
 * @author Goorus, Morph
 *
 */
class EntityRepositorySource extends EntityRepositoryAbstract
{

    /**
     * @service
     * @var \Ruon\Data\Source\DataSource
     */
    protected $dataSource;

    /**
     * Возвращает данные модели
     *
     * @param string $entity
     * @param mixed $id
     * @return array|null
     */
    public function getEntityData($entity, $id)
    {
        $statement = $this->dataSource->createStatement();

        $exec = new \Ruon\Query\Query;
        $exec
            ->add(new \Ruon\Query\QuerySelect);

        if (is_array($id)) {
            foreach ($id as $key => $value) {
                $exec->add(new \Ruon\Query\QueryWhere("`$key` = ?", $value));
            }
        } else {
            $key = $this->entityScheme->getEntityPrimary($entity);
            $exec->add(new \Ruon\Query\QueryWhere("`$key` = ?", $id));
        }

        $result = $statement->execute($exec);

        $items = $result->rows();

        return $items ? reset($items) : null;
    }

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
