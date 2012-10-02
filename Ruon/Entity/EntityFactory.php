<?php

namespace Ruon\Entity;

/**
 *
 * Фабрика сущностей
 *
 * @author goorus
 *
 */
class EntityFactory
{

    /**
     *
     * @service
     * @var \Ruon\Entity\EntitySchemeAbstract
     */
    protected $entityScheme;

    /**
     * Создает экземпляр сущности
     *
     * @param string $entity
     * @param array $data
     * @return Entity
     */
    public function create($entity, $data)
    {
        $class = $this->entityScheme->getEntityClass($entity);
        /* @var $instance Entity*/
        $instance = new $class;
        return $instance->replaceFields($data)->setUpdatedFields(array());
    }

}