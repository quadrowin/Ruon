<?php

namespace Ruon\Core;

/**
 *
 * Приложение
 *
 * @author Goorus
 *
 */
class Application
{

    /**
     * @inject
     * @var \Ruon\Core\Data\DataRepositoryArgv
     */
    protected $argv;

    /**
     * @inject
     * @var \Ruon\Core\Controller\ControllerExecutor
     */
    protected $controllerExecutor;

    /**
     * @inject
     * @var \Ruon\Core\Data\DataRepositoryArray
     */
    protected $controllerOutput;

    /**
     * @inject
     * @var \Ruon\Core\Controller\ControllerTask
     */
    protected $controllerTask;

    /**
     * @inject \Ruon\Core\Data\DataTransport
     * @var \Ruon\Core\Data\DataRepositoryAbstract
     */
    protected $input;

    /**
     * @inject
     * @var \Ruon\Core\Render\RenderExecutor
     */
    protected $renderExecutor;

    /**
     * @inject
     * @var \Ruon\Core\Render\RenderTask
     */
    protected $renderTask;

    public function run()
    {
        $this->controllerTask->setOutput($this->controllerOutput);

        $this->input->appendProvider($this->argv);

        $this->renderTask
            ->setRender('Ruon\\Core\\Render\\RenderCli')
            ->setInput($this->controllerOutput);

        $this->controllerTask
            ->setController('Ruon\\Core\\Controller\\ControllerAbout')
            ->setInput($this->input)
            ->setRenderTask($this->renderTask);

        $this->controllerExecutor->execute($this->controllerTask);
        $this->renderExecutor->execute($this->renderTask);
    }

}
