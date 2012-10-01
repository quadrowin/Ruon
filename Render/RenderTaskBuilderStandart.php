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

        $renderTask = new RenderTask;
        $renderTask
            ->setInput($data)
            ->setRender($render)
            ->setMethod($renderMethod)
            ->setTemplate($data->get('template'));

        return $renderTask;
    }

}