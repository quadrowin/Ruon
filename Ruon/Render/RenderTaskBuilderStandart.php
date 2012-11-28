<?php

namespace Ruon\Render;

/**
 *
 * Стандартный билдер задания для рендера
 *
 * @author goorus
 *
 */
class RenderTaskBuilderStandart extends RenderTaskBuilderAbstract
{

    /**
     * @service \Ruon\Di\ServiceSource\ServiceSourceStandart
     * @var \Ruon\Di\ContainerInterface
     */
    protected $serviceSource;

    /**
     *
     * @param \Ruon\Controller\ControllerTask $controllerTask
     * @return RenderTask
     */
    public function build($controllerTask)
    {
        $data = $controllerTask->getOutput();

        $render = $controllerTask->getRender() ?: $this->defaultRender;
        $renderMethod = $controllerTask->getRenderMethod()
            ?: $this->defaultRenderMethod;

        /* @var $renderTask RenderTask */
        $renderTask = $this->serviceSource->get(
            'Ruon\\Render\\RenderTask',
            $this
        );
        $renderTask
            ->setInput($data)
            ->setRender($render)
            ->setMethod($renderMethod)
            ->setTemplate($data->get('template'));

        return $renderTask;
    }

}