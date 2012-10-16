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
     *
     * @service \Ruon\Render\RenderTaskBuilderStandart
     * @var \Ruon\Render\RenderTaskBuilderAbstract
     */
    protected $renderTaskBuilder;

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

        $this->controllerTask
            ->setController('Ruon\\Controller\\ControllerAbout')
            ->setInput($this->subInput)
            ->execute();

        $this->renderTaskBuilder
            ->setDefaultRender('Ruon\\Render\\RenderCli')
            ->build($this->controllerTask)
            ->execute();
    }

}
