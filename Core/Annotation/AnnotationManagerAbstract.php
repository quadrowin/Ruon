<?php

namespace Ruon\Core\Annotation;

/**
 * Абстрактный менеджер аннотаций
 *
 * @author morph, goorus
 */
abstract class AnnotationManagerAbstract
{
	/**
	 * Хранилище полученных аннотаций
	 *
	 * @var Ruon\Core\Data\DataRepositoryAbstract
	 */
	protected $repository;

	/**
	 * Источник аннотаций
	 *
	 * @var Ruon\Core\Annotation\AnnotationSourceAbstract
	 */
	protected $source;

	/**
	 * Получить набор аннотациий класса по экземпляру класса
	 *
	 * @param \StdClass $class
	 * @param string $annotationName
	 * @return Ruon\Core\Annotation\AnnotationSet
	 */
	public function getAnnotation($class)
	{
		$className = get_class($class);
		$annotationSet = $this->repository->get($className);
		if ($annotationSet === null) {
			$annotationSet = $this->source->get($class);
			$this->repository->set($className, $annotationSet);
		}
		return $annotationSet;
	}

	/**
	 * Получить текущее хранилище данных
	 *
	 * @return Ruon\Core\Data\DataRepositoryAbstract
	 */
	public function getRepository()
	{
		return $this->repository;
	}

	/**
	 * Получить текущий источник аннотаций
	 *
	 * @return Ruon\Core\Annotation\AnnotationSourceAbstract
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * Изменить текущее хранилище данных
	 *
	 * @param Ruon\Core\Data\DataRepositoryAbstract $repository
	 */
	public function setRepository($repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Изменить текущий источник аннотаций
	 *
	 * @param Ruon\Core\Annotation\AnnotationSourceAbstract $source
	 */
	public function setSource($source)
	{
		$this->source = $source;
	}
}