<?php

namespace Ruon;

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
     * @instance
     * @var \Ruon\Controller\ControllerTask
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
            ->setController($this->frontController)
            ->execute();
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
