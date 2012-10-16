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

    public function execute()
    {
        $input = new \Ruon\Data\DataTransport;

        $input->appendProvider(
            new \Ruon\Data\DataRepositoryGet,
            new \Ruon\Data\DataRepositoryPost
        );

        $data = new \Ruon\Data\DataRepositoryArray;

        $controllerClass = $input->get('controller');

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
