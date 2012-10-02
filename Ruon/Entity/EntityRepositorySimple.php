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
     *
     * @param string $entity
     * @param mixed $id
     * @return string
     */
    protected function getKey($entity, $id)
    {
        return json_encode(array($entity, $id));
    }

    /**
     * Возвращает данные модели
     *
     * @param string $entity
     * @param mixed $id
     * @return array
     */
    public function getEntityData($entity, $id)
    {
        $key = $this->getKey($entity, $id);

        return $this->repository->get($key);
    }

    /**
     * @param string $entity
     * @param array $data,
     * @param \Ruon\Query\Query $query
     * @return mixed
     */
    public function saveData($entity, $data, $query)
    {
        $idField = $this->entityScheme->getIdField($entity);
        $key = $this->getKey($entity, $data[$idField]);

        return $this->repository->setEx($key, $data, $query);
    }

}
