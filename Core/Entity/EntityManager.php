<?php

namespace Ruon\Core\Entity;

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
     * @service
     * @var \Ruon\Core\Data\DataRepositoryAbstract
     */
    protected $dataRepository;

    /**
     *
     * @service
     * @var \Ruon\Core\Entity\Scheme\EntitySchemeAbstract
     */
    protected $entityScheme;

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
        $this->dataRepository->set($entity->id(), $entity->getFields());
    }

    /**
     * Обновление существующей записи для сущности
     *
     * @param Entity $entity
     * @return mixed
     */
    public function update($entity)
    {
        $this->dataRepository->set($entity->id(), $entity->getFields());
    }

}
