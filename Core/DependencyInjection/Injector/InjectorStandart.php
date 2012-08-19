<?php

namespace Ruon\Core\DependencyInjection\Injector;

/**
 *
 * Внедряющий зависимость
 *
 * @author goorus, morph
 *
 */
class InjectorStandart extends InjectorAbstract
{

	/**
	 * Инициализирует зависимости в объекте
	 *
	 * @param object $object
	 */
	public function inject($object)
	{
		$class = get_class($object);
		$classReflection = new \ReflectionClass($class);
		$properties = $classReflection->getProperties();

		foreach ($properties as $property) {
			$serviceName = $this->getInjetionService($property);
			if ($serviceName) {
				$service = $this->source->get($serviceName, $object);
				if ($service) {
					$property->setAccessible(true);
					$property->setValue($object, $service);
				}
			}
		}
	}

}
