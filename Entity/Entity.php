<?php

namespace Ruon\Entity;

/**
 *
 * Базовая модель
 *
 * @author Goorus, Morph
 *
 */
class Entity
{

    /**
     * Менеджер сущностей
     *
     * @service
     * @var EntitySchemeAbstract
     */
    protected $entityScheme;

    /**
     * Поля модели
     *
     * @var array of mixed
     */
    protected $fields = array();

    /**
     * Список обновленных полей
     *
     * @var array of string
     */
    protected $updatedFields = array();

    /**
     * Возвращает моле модели
     *
     * @param null $field
     * @return mixed
     */
    public function __get($field)
    {
        return isset($this->fields[$field])
            ? $this->fields[$field]
            : null;
    }

    /**
     * Устанавливает значение поля модели
     *
     * @param string $field
     * @param mixed $value
     */
    public function __set($field, $value)
    {
        $this->updatedFields[$field] = $field;
        $this->fields[$field] = $value;
    }

    /**
     * Возвращает менеджер сущностей
     *
     * @return EntitySchemeAbstract
     */
    public function getEntityScheme()
    {
        return $this->entityScheme;
    }

    /**
     * Возвращает все поля сущности
     *
     * @return array of mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Возвращает указанные поля сущности
     *
     * @param array $fields
     * @return array
     */
    public function getTheFields(array $fields)
    {
        $fields = array_fill_keys($fields, null);

        return array_intersect_key($this->fields, $fields);
    }

    /**
     * Возвращает список измененных полей сущности
     *
     * @return array of string
     */
    public function getUpdatedFields()
    {
        return $this->updatedFields;
    }

    /**
     * Возвращает первичный ключ сущности
     *
     * @return mixed
     */
    public function id()
    {
        $primary = $this->entityScheme->getEntityPrimary($this);

        return is_array($primary)
            ? $this->getTheFields($primary)
            : $this->$primary;
    }

    /**
     * Обновление полей модели
     *
     * @param array $fields
     * @return $this|Entity
     */
    public function mergeFields(array $fields)
    {
        $this->fields = array_merge($this->fields, $fields);
        $updated = array_keys($fields);
        $this->updatedFields = array_merge(
            $this->updatedFields,
            array_combine($updated, $updated)
        );

        return $this;
    }

    /**
     * Заменяет все поля сущности
     *
     * @param array $fields
     * @return $this|Entity
     */
    public function replaceFields(array $fields)
    {
        $this->fields = $fields;
        $replaced = array_keys($fields);
        $this->updatedFields = array_combine($replaced, $replaced);

        return $this;
    }

    /**
     * Устанавливает схему сущностей
     *
     * @param EntitySchemeAbstract $entityScheme
     * @return $this|Entity
     */
    public function setEntityScheme($entityScheme)
    {
        $this->entityScheme = $entityScheme;

        return $this;
    }

    /**
     * Устанавливает какие поля являются измененными.
     *
     * @return array of string
     */
    public function setUpdatedFields($fields)
    {
        $this->updatedFields = $fields;
        return $this;
    }

}
