<?php

namespace Ruon\DependencyInjection\Injector;

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
     * Возвращает значение параметра из аннотации
     *
     * @param string $doc
     * @param string $key
     * @return string|null
     */
    public function getAnnotationValue($doc, $key)
    {
        $m = null;
        $match = preg_match(
            '#@' . $key . '\s+([a-zA-Z_0-9\\\\]*)[\s\r\n]#',
            $doc,
            $m
        );

        if (!$match) {
            return null;
        }

        return trim($m[1], " \n\t\\");
    }

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
            /* @var $property \ReflectionProperty */
            $doc = $property->getDocComment();

            foreach ($this->sources as $source) {
                $class = $this->getAnnotationValue($doc, $source);
                if ($class === '') {
                    $class = $this->getAnnotationValue($doc, 'var');
                }

                if ($class) {
                    $sourceProp = $source . 'Source';
                    $instance = $this->{$sourceProp}->get($class, $object);
                    $property->setAccessible(true);
                    $property->setValue($object, $instance);
                    break;
                }
            }
		}
	}

}
