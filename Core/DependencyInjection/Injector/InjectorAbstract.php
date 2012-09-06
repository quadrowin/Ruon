<?php

namespace Ruon\Core\DependencyInjection\Injector;

/**
 *
 * Внедряющий зависимость
 *
 * @author goorus, morph
 *
 */
abstract class InjectorAbstract
{

    /**
     * Источник сервисов
     *
     * @var \Ruon\Core\DependencyInjection\ContainerInterface
     */
    protected $source;

    /**
     * Возвращает название инъектируемого сервиса для свойства
     *
     * @param \ReflectionProperty $property
     * @return string
     */
    public function getInjetionService(\ReflectionProperty $property)
    {
        $docComment = $property->getDocComment();
        $m = null;
        $match = preg_match(
            '#@inject\s+([a-zA-Z_0-9\\\\]*)[\s\r\n]#',
            $docComment,
            $m
        );
        if (!$match) {
            return null;
        }

        $serviceName = trim($m[1]);
        if (!$serviceName) {
            $match = preg_match(
                '#@var\s+([a-zA-Z_0-9\\\\]*)[\s\r\n]#',
                $docComment,
                $m
            );
            if (!$match) {
                return null;
            }

            $serviceName = trim($m[1]);
        }

        return $serviceName;
    }

    /**
     * Возвращает источник
     *
     * @return \Ruon\Core\DependencyInjection\ContainerInterface
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Инициализирует зависимости в объекте
     *
     * @param object $object
     */
    abstract public function inject($object);

    /**
     * Устанавливает источник сервисов для внедрения
     *
     * @param \Ruon\Core\DependencyInjection\ContainerInterface $source
     * @return $this|InjectorAbstract
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

}
