<?php

namespace Ruon\Core\Entity;

/**
 *
 * Репозитарий сущностей
 *
 * @author Goorus, Morph
 *
 */
class EntityRepository
{

    /**
     *
     * @var \Ruon\Core\Data\DataRepositoryAbstract
     */
    protected $repository;

    /**
     *
     * @param Entity $entity
     * @return string
     */
    public function getEntityKey($entity)
    {
        return get_class($entity) . '-' . $entity;
    }

    public function insert($entity)
    {
        $this->repository->set(
            $this->getEntityKey($entity),
            $entity->getFields
        );
    }

    public function update($entity)
    {
        $this->insert($entity);
    }


}
