<?php

namespace Ruon\Controller;

/**
 *
 * Исполнитель заданий контроллера
 *
 * @author Goorus
 *
 */
class ControllerExecutor
{

    /**
     * @service
     * @var \Ruon\DependencyInjection\ServiceManager
     */
    protected $controllerManager;

    /**
     *
     * @param ControllerTask $task
     */
    public function execute($task)
    {
        /* @var $controller ControllerAbstract */
        $controller = $this->controllerManager->get(
            $task->getController(),
            $this
        );

        if (method_exists($controller, 'setTask')) {
            $controller->setTask($task);
        }

        $method = $task->getMethod();

        $reflection = new \ReflectionMethod($controller, $method);
        $params = $reflection->getParameters();

        foreach ($params as &$value) {
            /* @var $value \ReflectionParameter */
            $name = $value->getName();
            $v = $task->getInput()->get($name);
            $value = ($v === null && $value->isDefaultValueAvailable())
                ? $value->getDefaultValue()
                : $v;
        }

        $result = $reflection->invokeArgs($controller, $params);

        if (is_array($result)) {
            $task->getOutput()->mset($result);
        }
    }

}
