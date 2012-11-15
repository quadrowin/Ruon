<?php

namespace Ruon\Router;

/**
 * Маршрут
 *
 * @author Goorus, Morph
 */
class Route
{

    /**
     *
     * @var string
     */
    protected $controller;

    /**
     *
     * @var string
     */
    protected $url;

    public function getController()
    {
        return $this->controller;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

}
