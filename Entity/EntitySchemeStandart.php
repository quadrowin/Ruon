<?php

namespace Ruon\Entity;

/**
 *
 * Стандартный обработчик схемы моделей
 *
 * @author morph, goorus
 *
 */
class EntitySchemeStandart extends EntitySchemeAbstract
{

	/**
	 * Репозитарий загруженных схем моделей
	 *
     * @service
	 * @var \Ruon\Annotation\AnnotationManagerAbstract
	 */
	protected $annotations;

    /**
     *
     * @return \Ruon\Annotation\AnnotationManagerAbstract
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

	/**
	 * @inheritdoc
	 */
	public function getFieldProperty($entity, $fieldName, $propertyName)
	{
        return $this->annotations->getAnnotation($entity->getEntityName())
            ->getProperty($fieldName)
            ->get($propertyName);
	}

    /**
     * @inheritdoc
     */
    public function getEntityProperty($entity, $properyName)
    {
        return $this->annotations->getAnnotation($entity->getEntityName())
            ->get($properyName);
    }

    /**
     * Возвращает первичный ключ
     *
     * @param \Ruon\Entity\Entity $entity
     * @return mixed
     */
    public function getEntityPrimary($entity)
    {
        return $this->annotations->getAnnotation($entity->getEntityName())
            ->get(self::ENTITY_KEY);
    }

    /**
     * Изменяет репозиторий схемы моделей
     *
     * @param \Ruon\Annotation\AnnotationManagerAbstract $annotations
     * @return $this;
     */
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;

        return $this;
    }

}