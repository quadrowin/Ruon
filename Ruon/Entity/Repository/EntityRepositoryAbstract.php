<?php

namespace Ruon\Entity\Repository;

/**
 *
 * Интерфейс репозитария моделей
 *
 * @author Goorus, Morph
 *
 */
abstract class EntityRepositoryAbstract
{

    /**
     * Фабрика сущностей
     *
     * @service
     * @var EntityFactory
     */
    protected $entityFactory;

    /**
     *
     * @service
     * @var \Ruon\Entity\EntitySchemeAbstract
     */
    protected $entityScheme;

    /**
     *
     * @param string $entity
     * @param integer $id
     * @return Entity
     */
    public function getEntity($entity, $id)
    {
        return $this->entityFactory->create(
            $entity,
            $this->getEntityData($entity, $id)
        );
    }

    /**
     * Возвращает данные модели
     *
     * @param string $entity
     * @param mixed $id
     * @return array
     */
    abstract public function getEntityData($entity, $id);

    /**
     *
     * @param Entity $entity
     * @return string
     */
    public function getEntityName($entity)
    {
        return get_class($entity);
    }

    /**
     *
     * @param Entity $entity
     * @param \Ruon\Query\Query $query
     * @return mixed
     */
    public function save($entity, $query)
    {
        return $this->saveData(
            $this->getEntityName($entity),
            $entity->getFields(),
            $query
        );
    }

    /**
     * @param string $entity
     * @param array $data,
     * @param \Ruon\Query\Query $query
     * @return mixed
     */
    abstract public function saveData($entity, $data, $query);

}

