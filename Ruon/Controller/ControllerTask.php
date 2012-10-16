<?php

namespace Ruon\Controller;

/**
 *
 * Задание контроллера
 *
 * @author Goorus
 *
 */
class ControllerTask
{
    /**
     * Метод
     *
     * @var string
     */
    const METHOD_EXECUTE = 'execute';

    /**
     * Название контроллера
     *
     * @var string
     */
    protected $controller;

    /**
     * @service
     * @var \Ruon\DependencyInjection\ServiceManager
     */
    protected $controllerManager;

    /**
     * Вход
     *
     * @var \Ruon\Data\DataRepositoryAbstract
     */
    protected $input;

    /**
     *
     * @var string
     */
    protected $method = self::METHOD_EXECUTE;

    /**
     * Выход
     *
     * @var \Ruon\Data\DataRepositoryAbstract
     */
    protected $output;

    /**
     * Рендер
     *
     * @var string
     */
    protected $render;

    /**
     * Метод рендера
     *
     * @var string
     */
    protected $renderMethod;

    /**
     * Исполнение задания
     */
    public function execute()
    {
        /* @var $controller ControllerAbstract */
        $controller = $this->controllerManager->get($this->controller, $this);

        if (method_exists($controller, 'setTask')) {
            $controller->setTask($this);
        }

        $reflection = new \ReflectionMethod($controller, $this->method);
        $params = $reflection->getParameters();

        foreach ($params as &$value) {
            /* @var $value \ReflectionParameter */
            $name = $value->getName();
            $v = $this->input->get($name);
            $value = ($v === null && $value->isDefaultValueAvailable())
                ? $value->getDefaultValue()
                : $v;
        }

        $result = $reflection->invokeArgs($controller, $params);

        if (is_array($result)) {
            $this->output->mset($result);
        }
    }

    /**
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     *
     * @return \Ruon\Data\DataRepositoryAbstract
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     *
     * @return \Ruon\Data\DataRepositoryAbstract
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     *
     * @return string
     */
    public function getRender()
    {
        return $this->render;
    }

    /**
     *
     * @return string
     */
    public function getRenderMethod()
    {
        return $this->renderMethod;
    }

    /**
     *
     * @param string $controller
     * @return $this|ControllerTask
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     *
     * @param \Ruon\Data\DataRepositoryAbstract $input
     * @return $this|ControllerTask
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     *
     * @param string $method
     * @return $this|ControllerTask
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     *
     * @param \Ruon\Data\DataRepositoryAbstract $output
     * @return $this|ControllerTask
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     *
     * @param string $render
     * @return $this|ControllerTask
     */
    public function setRender($render)
    {
        $this->render = $render;

        return $this;
    }

    /**
     *
     * @param string $renderMethod
     * @return $this|ControllerTask
     */
    public function setRenderMethod($renderMethod)
    {
        $this->renderMethod = $renderMethod;

        return $this;
    }

}
