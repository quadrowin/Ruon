<?php

namespace Ruon\Render;

/**
 *
 * Абстрактный билдер задания для рендера
 *
 * @author goorus
 *
 */
abstract class RenderTaskBuilderAbstract
{

    /**
     * Рендер
     *
     * @var string
     */
    protected $defaultRender = 'Ruon\\Render\\RenderPhp';

    /**
     * Метод рендера
     *
     * @var string
     */
    protected $defaultRenderMethod = RenderTask::METHOD_DISPLAY;

    /**
     *
     * @param \Ruon\Controller\ControllerTask $controllerTask
     * @return RenderTask
     */
    abstract public function build($controllerTask);

}