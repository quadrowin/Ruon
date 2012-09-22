<?php

namespace Ruon\Controller\Front;

/**
 *
 * Фронт контроллер консоли
 *
 * @author goorus, morph
 *
 */
class ControllerFrontCli extends \Ruon\Controller\ControllerAbstract
{

   /**
     * @service
     * @var \Ruon\Data\DataRepositoryArgv
     */
    protected $argv;

    /**
     * @service
     * @var \Ruon\Controller\ControllerExecutor
     */
    protected $controllerExecutor;

    /**
     * @instance
     * @var \Ruon\Data\DataRepositoryArray
     */
    protected $controllerOutput;

    /**
     * @instance
     * @var \Ruon\Controller\ControllerTask
     */
    protected $controllerTask;

    /**
     * @service
     * @var \Ruon\Render\RenderExecutor
     */
    protected $renderExecutor;

    /**
     * @instance
     * @var \Ruon\Render\RenderTask
     */
    protected $renderTask;

    /**
     * Вход вызываемого контроллера
     *
     * @instance \Ruon\Data\DataTransport
     * @var \Ruon\Data\DataRepositoryAbstract
     */
    protected $subInput;

    public function execute()
    {
        $this->controllerTask->setOutput($this->controllerOutput);

        $this->subInput->appendProvider($this->argv);

        $this->renderTask
            ->setRender('Ruon\\Render\\RenderCli')
            ->setInput($this->controllerOutput);

        $this->controllerTask
            ->setController('Ruon\\Controller\\ControllerAbout')
            ->setInput($this->subInput)
            ->setRenderTask($this->renderTask);

        $this->controllerExecutor->execute($this->controllerTask);
        $this->renderExecutor->execute($this->renderTask);
    }

}
