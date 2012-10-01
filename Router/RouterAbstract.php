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
     * @param string $url
     * @return mixed
     */
    abstract public function route($url);

}