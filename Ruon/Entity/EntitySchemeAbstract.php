<?php

namespace Ruon\Entity;

/**
 *
 * Абстрактная схема моделей
 *
 * @author morph, goorus
 *
 */
abstract class EntitySchemeAbstract
{


    /**
     * Свойство с первичным ключом
     *
     * @var string
     */
    const ENTITY_PRIMARY = 'primary';

    /**
     * Возвращает значения свойства поля модели по моделе и имени поля
     *
     * @param \Ruon\Entity\Entity $entity Сущность
     * @param string $fieldName Поле
     * @param string $propertyName Название необходимого свойства
     * @return string
     */
    abstract public function getFieldProperty(
        $entity,
        $fieldName,
        $propertyName
    );

    /**
     * Возвращает первичный ключ
     *
     * @param \Ruon\Entity\Entity $entity
     * @return mixed
     */
    abstract public function getEntityPrimary($entity);

    /**
     * Возвращает значения свойства модели по имени поля
     *
     * @param \Ruon\Entity\Entity $entity
     * @param string $propertyName
     * @return string
     */
    abstract public function getEntityProperty($entity, $propertyName);

}