<?php

namespace Ruon\Entity;

/**
 *
 * Менеджер сущностей
 *
 * @author Goorus, Morph
 *
 */
class EntityManager
{

    /**
     *
     * @service
     * @var \Ruon\Entity\EntityScheme
     */
    protected $entityScheme;

    /**
     * @service
     * @var \Ruon\Data\DataRepositoryAbstract
     */
    protected $repository;

    /**
     *
     * @var \Ruon\Data\Source\DataSource
     */
    protected $source;

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
     * Создание новой записи для сущности
     *
     * @param Entity $entity
     * @return mixed
     */
    public function insert($entity)
    {
        $this->repository->set($entity->id(), $entity->getFields());
    }

    /**
     * Обновление существующей записи для сущности
     *
     * @param Entity $entity
     * @return mixed
     */
    public function update($entity)
    {
        $this->repository->set($entity->id(), $entity->getFields());
    }

}
