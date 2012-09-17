<?php

namespace Ruon\Core;

/**
 *
 * Приложение для консоли
 *
 * @author goorus, morph
 *
 */
class Application
{

    /**
     * Фронт контроллер
     *
     * @var string
     */
    protected $frontController;

    /**
     * @service
     * @var \Ruon\Core\Controller\ControllerExecutor
     */
    protected $controllerExecutor;

    /**
     * @instance
     * @var \Ruon\Core\Controller\ControllerTask
     */
    protected $controllerTask;

    /**
     * Возвращает фронт контроллер
     *
     * @return string
     */
    public function getFrontController()
    {
        return $this->frontController;
    }

    /**
     * Запуск фронт контроллера
     */
    public function run()
    {
        $this->controllerTask
            ->setController($this->frontController);

        $this->controllerExecutor->execute($this->controllerTask);
    }

    /**
     * Устанавливает фронт контроллер
     *
     * @param string $class
     * @return $this|Application
     */
    public function setFrontController($class)
    {
        $this->frontController = $class;

        return $this;
    }

}
