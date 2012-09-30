<?php

namespace Ruon\Entity;

/**
 *
 * Репозитарий сущностей
 *
 * @author Goorus, Morph
 *
 */
class EntityRepositorySimple extends EntityRepository
{

    /**
     * @service
     * @var \Ruon\Data\DataRepositoryAbstract
     */
    protected $repository;

    /**
     * @param string $entity
     * @param array $data,
     * @param \Ruon\Query\Query $query
     * @return mixed
     */
    public function saveData($entity, $data, $query)
    {
        $idField = $this->entityScheme->getIdField($entity);
        $key = json_encode(array($entity, $data[$idField]));

        return $this->repository->setEx($key, $data, $query);
    }

}
