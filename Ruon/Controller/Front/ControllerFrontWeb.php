<?php

namespace Ruon\Controller\Front;

/**
 *
 * Фронт контроллер Web-приложения
 *
 * @author goorus, morph
 *
 */
class ControllerFrontWeb extends \Ruon\Controller\ControllerAbstract
{

    /**
     *
     * @service
     * @var \Ruon\DependencyInjection\ServiceManager
     */
    protected $controllerManager;

    /**
     * @service \Ruon\DependencyInjection\ServiceManager
     * @var \Ruon\DependencyInjection\ContainerInterface
     */
    protected $serviceManager;

    /**
     *
     * @service \Ruon\Render\RenderTaskBuilderStandart
     * @var \Ruon\Render\RenderTaskBuilderAbstract
     */
    protected $renderTaskBuilder;

    /**
     *
     * @service \Ruon\Router\RouterAuto
     * @var \Ruon\Router\RouterAbstract
     */
    protected $router;

    public function execute()
    {
        $input = new \Ruon\Data\DataTransport;

        $input->appendProvider(
            new \Ruon\Data\DataRepositoryGet,
            new \Ruon\Data\DataRepositoryPost
        );

        $data = new \Ruon\Data\DataRepositoryArray;

        $route = $this->router->route($_SERVER['REQUEST_URI']);

        $controllerClass = $route->getController();

        /* @var $controllerTask Ruon\Controller\ControllerTask */
        $controllerTask = $this->serviceManager->get(
            'Ruon\\Controller\\ControllerTask',
            $this
        );

        $controllerTask
            ->setController($controllerClass)
            ->setInput($input)
            ->setOutput($data)
            ->execute();

        $this->renderTaskBuilder
            ->build($controllerTask)
            ->execute();
    }

}
