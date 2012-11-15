<?php

namespace Ruon\Router;

/**
 *
 * Абстрактный роутер
 *
 * @author goorus, morph
 *
 */
abstract class RouterAbstract
{

    /**
     * Правило для пустого маршрута
     *
     * @var string
     */
    protected $emptyUrl = '/index/';

    /**
     * Правило для ненайденного маршрута
     *
     * @var string
     */
    protected $notFoundUrl = '/index/';

    /**
     * @param string $url
     * @return Route
     */
    abstract public function route($url);

}