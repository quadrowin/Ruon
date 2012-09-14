<?php

namespace Ruon\Core\Render;

/**
 *
 * Задание рендера
 *
 * @author Goorus
 *
 */
class RenderTask
{

    const METHOD_FETCH = 'fetch';
    const METHOD_DISPLAY = 'display';

    /**
     * Данные
     *
     * @var \Ruon\Core\Data\DataTransport
     */
    protected $input;

    /**
     *
     * @var string
     */
    protected $method = self::METHOD_FETCH;

    /**
     * Результат работы рендера
     *
     * @var mixed
     */
    protected $output;

    /**
     * Рендер
     *
     * @var string
     */
    protected $render;

    /**
     * Шаблон
     *
     * @var string
     */
    protected $template;

    /**
     *
     * @return \Ruon\Core\Data\DataRepositoryAbstract
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
     * @return mixed
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
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     *
     * @param \Ruon\Core\Data\DataRepositoryAbstract $input
     * @return $this|RenderTask
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     *
     * @param string $method
     * @return $this|RenderTask
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     *
     * @param mixed $output
     * @return $this|RenderTask
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     *
     * @param string $render
     * @return $this|RenderTask
     */
    public function setRender($render)
    {
        $this->render = $render;

        return $this;
    }

    /**
     *
     *
     * @param string $template
     * @return $this|RenderTask
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

}
