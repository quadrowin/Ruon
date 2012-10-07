<?php

namespace Ruon\Entity;

/**
 *
 * Менеджер сущностей
 *
 * @author Goorus, Morph
 *
 */
class EntityManager extends Repository\EntityRepositoryArray
{

    /**
     *
     * @var \Ruon\Entity\EntityRepositorySource
     */
    protected $source;

    /**
     *
     * @param string $entity
     * @param array $data
     * @return Entity
     */
    public function getEntityInstance($entity, $data)
    {

    }

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
