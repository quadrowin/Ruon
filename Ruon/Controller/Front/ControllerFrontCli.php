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
     *
     * @service \Ruon\Render\RenderTaskBuilderStandart
     * @var \Ruon\Render\RenderTaskBuilderAbstract
     */
    protected $renderTaskBuilder;


    /**
     * @service
     * @var \Ruon\Di\ServiceSource\ServiceSourceStandart
     */
    protected $serviceSource;

    public function execute()
    {
        $controllerTask = $this->newControllerTask();
        $controllerTask->setOutput(new \Ruon\Data\DataRepositoryArray);

        $subInput = $this->newSubInput();
        $subInput->appendProvider($this->argv);

        $this->controllerTask
            ->setController('Ruon\\Controller\\ControllerAbout')
            ->setInput($subInput)
            ->execute();

        $this->renderTaskBuilder
            ->setDefaultRender('Ruon\\Render\\RenderCli')
            ->build($this->controllerTask)
            ->execute();
    }

    /**
     * Создание задачи контроллера
     * @return \Ruon\Controller\ControllerTask
     */
    protected function newControllerTask()
    {
        return $this->serviceSource->get(
            'Ruon\\Controller\\ControllerTask',
            $this
        );
    }

    /**
     * Вход вызываемого контроллера
     * @return \Ruon\Data\DataRepositoryAbstract
     */
    protected function newSubInput()
    {
        return $this->serviceSource->get('Ruon\\Data\\DataTransport', $this);
    }

}
