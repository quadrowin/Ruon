<?php

namespace Ruon\Entity;

/**
 *
 * Менеджер сущностей
 *
 * @author Goorus, Morph
 *
 */
class EntityManager implements EntityRepository
{

    /**
     * @service
     * @var \Ruon\Entity\EntityRepositorySimple
     */
    protected $repository;

    /**
     *
     * @var \Ruon\Entity\EntityRepositorySource
     */
    protected $source;

    /**
     * Сохранение сущности
     *
     * @param Entity $entity
     * @return mixed
     */
    public function saveData($entity, $data, $query)
    {
        $result = $this->source->saveData($entity, $data, $query);
        $this->repository->saveData($entity, $data, $query);

        return $result;
    }

}
