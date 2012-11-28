<?php

namespace Ruon\Di\Injector;

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
     * Источники
     *
     * @var array of \Ruon\Di\ContainerInterface
     */
    protected $sources = array(
        'instance' => null,
        'service' => null
    );

    /**
     * Возвращает источник
     *
     * @param string $name
     * @return \Ruon\Di\ContainerInterface
     */
    public function getSource($name)
    {
        return $this->sources[$name];
    }

    /**
     * Возвращает список источников
     *
     * @return array of \Ruon\Di\ContainerInterface
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * Инициализирует зависимости в объекте
     *
     * @param object $object
     */
    abstract public function inject($object);

    /**
     * Устанавливает источник
     *
     * @param string $name
     * @param \Ruon\Di\ContainerInterface $source
     * @return $this|InjectorAbstract
     */
    public function setSource($name, $source)
    {
        $this->sources[$name] = $source;
        return $this;
    }

    /**
     * Устанавливает источники
     *
     * @param array of \Ruon\Di\ContainerInterface $sources
     * @return $this|InjectorAbstract
     */
    public function setSources($sources)
    {
        $this->sources = $sources;
        return $this;
    }

}
