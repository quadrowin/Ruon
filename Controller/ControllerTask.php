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
     * Задание рендера
     *
     * @var \Ruon\Render\RenderTask
     */
    protected $renderTask;

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
     * @param \Ruon\Render\RenderTask $renderTask
     * @return $this|ControllerTask
     */
    public function setRenderTask($renderTask)
    {
        $this->renderTask = $renderTask;

        return $this;
    }

}