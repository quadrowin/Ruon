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
     * @service
     * @var \Ruon\Di\ServiceSource\ServiceSourceStandart
     */
    protected $serviceSource;

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
        $task = $this->serviceSource->get(
            'Ruon\\Controller\\ControllerTask',
            $this
        );

        $task
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
