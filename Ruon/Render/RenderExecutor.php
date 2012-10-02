<?php

namespace Ruon\Render;

/**
 *
 * Исполнитель заданий рендера
 *
 * @author Goorus, Morph
 *
 */
class RenderExecutor
{

    /**
     * @service
     * @var \Ruon\DependencyInjection\ServiceManager
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
