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
     * @var \Ruon\Controller\ControllerExecutor
     */
    protected $controllerExectuor;

    /**
     *
     * @service
     * @var \Ruon\DependencyInjection\ServiceManager
     */
    protected $controllerManager;

    /**
     *
     * @service \Ruon\Render\RenderTaskBuilderStandart
     * @var \Ruon\Render\RenderTaskBuilderAbstract
     */
    protected $renderTaskBuilder;

    /**
     *
     * @service
     * @var \Ruon\Render\RenderExecutor
     */
    protected $renderExecutor;

    public function execute()
    {
        $input = new \Ruon\Data\DataTransport;

        $input->appendProvider(
            new \Ruon\Data\DataRepositoryGet,
            new \Ruon\Data\DataRepositoryPost
        );

        $data = new \Ruon\Data\DataRepositoryArray;

        $controllerClass = $input->get('controller');

        $controllerTask = new \Ruon\Controller\ControllerTask;
        $controllerTask
            ->setController($controllerClass)
            ->setInput($input)
            ->setOutput($data);

        $this->controllerExectuor->execute($controllerTask);

        $renderTask = $this->renderTaskBuilder->build($controllerTask);

        $this->renderExecutor->execute($renderTask);
    }

}
