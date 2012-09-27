<?php

namespace Ruon\Entity;

/**
 *
 * Интерфейс репозитария моделей
 *
 * @author Goorus, Morph
 *
 */
abstract class EntityRepository
{

    /**
     *
     * @service
     * @var \Ruon\Entity\EntityScheme
     */
    protected $entityScheme;

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
     * Возвращает первичный ключ модели
     *
     * @param Entity $entity
     * @return mixed
     */
    public function getId($entity)
    {
        $field = $this->entityScheme->getIdField($entity);

        if (count($field) > 1) {
            return $entity->getTheFields($field);
        }

        if (is_array($field)) {
            $field = reset($field);
        }

        return $entity->$field;
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

