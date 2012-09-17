<?php

namespace Ruon\Core\Render;

/**
 *
 * Исполнитель заданий рендера
 *
 * @author Goorus
 *
 */
class RenderExecutor
{

    /**
     * @service
     * @var \Ruon\Core\DependencyInjection\ServiceManager
     */
    protected $renderManager;

    /**
     *
     * @param RenderTask $task
     */
    public function execute($task)
    {
        /* @var $render RenderAbstract */
        $render = $this->renderManager->get($task->getRender(), $this);
        $render->setVars($task->getInput()->getAll());
        $method = $task->getMethod();
        $output = $render->$method($task->getTemplate());
        $task->setOutput($output);
    }

}
