<?php

namespace Ruon\Core\Controller\Front;

/**
 *
 * Фронт контроллер консоли
 *
 * @author goorus, morph
 *
 */
class ControllerFrontCli extends \Ruon\Core\Controller\ControllerAbstract
{

   /**
     * @service
     * @var \Ruon\Core\Data\DataRepositoryArgv
     */
    protected $argv;

    /**
     * @service
     * @var \Ruon\Core\Controller\ControllerExecutor
     */
    protected $controllerExecutor;

    /**
     * @instance
     * @var \Ruon\Core\Data\DataRepositoryArray
     */
    protected $controllerOutput;

    /**
     * @instance
     * @var \Ruon\Core\Controller\ControllerTask
     */
    protected $controllerTask;

    /**
     * @service
     * @var \Ruon\Core\Render\RenderExecutor
     */
    protected $renderExecutor;

    /**
     * @instance
     * @var \Ruon\Core\Render\RenderTask
     */
    protected $renderTask;

    /**
     * Вход вызываемого контроллера
     *
     * @instance \Ruon\Core\Data\DataTransport
     * @var \Ruon\Core\Data\DataRepositoryAbstract
     */
    protected $subInput;

    public function execute()
    {
        $this->controllerTask->setOutput($this->controllerOutput);

        $this->subInput->appendProvider($this->argv);

        $this->renderTask
            ->setRender('Ruon\\Core\\Render\\RenderCli')
            ->setInput($this->controllerOutput);

        $this->controllerTask
            ->setController('Ruon\\Core\\Controller\\ControllerAbout')
            ->setInput($this->subInput)
            ->setRenderTask($this->renderTask);

        $this->controllerExecutor->execute($this->controllerTask);
        $this->renderExecutor->execute($this->renderTask);
    }

}
