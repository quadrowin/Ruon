<?php

namespace Ruon\Router;

/**
 *
 * Стандартный роутер
 *
 * @author goorus, morph
 *
 */
class RouterAuto extends RouterAbstract
{

    /**
     *
     * @service \Ruon\Loader\LoaderStandart
     * @var \Ruon\Loader\LoaderAbstract
     */
    protected $loader;

    /**
     * @param string $url
     * @return Route
     */
    public function route($url)
    {
        $uri = $url ? : $this->emptyUrl;

        if (false !== ($p = strpos($uri, '?'))) {
            $uri = substr($uri, 0, $p);
        }

        $chunks = array_filter(explode('/', $uri), 'strlen');

        if (!$chunks) {
            return $this->route($this->notFoundUrl);
        }

        $suburl = '';
        $controller = '';
        $possibles = array();
        foreach ($chunks as $chunk) {
            $suburl .= '/' . $chunk;
            $normalized = ucfirst(strtolower($chunk));
            $possibles[$suburl] = $controller . '\\Controller' . $normalized;
            $controller .= '\\' . $normalized;
        }

        $paths = $this->loader->getPaths();
        $winner = null;
        for ($path = end($paths); $path; $path = prev($paths)) {
            $ns = key($paths);

            $path = rtrim($path, '\\/') . '/Controller';
            if (!is_dir($path)) {
                continue;
            }
            foreach ($possibles as $suburl => $controller) {
                $class = $ns . '\\Controller' . $controller;
                if (class_exists($class)) {
                    $winner = array($suburl, $class);
                }
            }
            if ($winner) {
                $route = new Route;
                return $route
                    ->setUrl($winner[0])
                    ->setController($winner[1]);
            }
        }

        if ($url === $this->notFoundUrl) {
            // Не сещуствует маршут для 404 страниц
            return null;
        }

        return $this->route($this->notFoundUrl);
    }

}