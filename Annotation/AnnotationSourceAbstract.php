<?php

namespace Ruon\Annotation;

/**
 * Абстрактный источник аннотаций
 *
 * @author morph, goorus
 */
abstract class AnnotationSourceAbstract
{
	/**
	 * Получить набор аннотаций класса
	 *
	 * @param \StdClass $class
	 * @return \Ruon\Annotation\AnnotationSet
	 */
	final public function get($class)
	{
		$classAnnotation = $this->getClass($class);
		if ($classAnnotation) {
			foreach ($classAnnotation as $key => $value) {
				$classAnnotation[$key] = new Annotation($key, $value);
			}
			$classAnnotation = new AnnotationRow($classAnnotation);
		}
		$methodAnnotations = $this->getMethods($class);
		$propertyAnnotations = $this->getProperties($class);
		if ($methodAnnotations) {
			foreach ($methodAnnotations as $key => $value) {
				$row = array();
				foreach ($value as $aKey => $aValue) {
					$row[$aKey] = new Annotation($aKey, $aValue);
				}
				$methodAnnotations[$key] = new AnnotationRow($row);
			}
		}
		if ($propertyAnnotations) {
			foreach ($propertyAnnotations as $key => $value) {
				$row = array();
				foreach ($value as $aKey => $aValue) {
					$row[$aKey] = new Annotation($aKey, $aValue);
				}
				$propertyAnnotations[$key] = new AnnotationRow($row);
			}
		}
		$annotationSet = new AnnotationSet(
			$classAnnotation, $methodAnnotations, $propertyAnnotations
		);
		return $annotationSet;
	}

	/**
	 * Распарсить аннотацию класса
	 *
	 * @param \StdClass $class
	 * @return array
	 */
	abstract protected function getClass($class);

	/**
	 * Распарсить аннотации методов класса
	 *
	 * @param \StdClass $class
	 * @return array
	 */
	abstract protected function getMethods($class);

	/**
	 * Распарсить аннотации полей класса
	 *
	 * @param \StdClass $class
	 * @return array
	 */
	abstract protected function getProperties($class);
}