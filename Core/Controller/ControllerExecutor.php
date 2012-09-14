<?php

namespace Ruon\Core\Controller;

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
     * @inject
     * @var \Ruon\Core\DependencyInjection\ServiceManager
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

        $controller->setTask($task);
        $method = $task->getMethod();

        $reflection = new \ReflectionMethod($controller, $method);
        $params = $reflection->getParameters();
        foreach ($params as $name => &$value) {
            /* @var $value \ReflectionParameter */
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
