<?php

namespace Ruon\Controller;

/**
 *
 * Абстрактный класс контроллера
 *
 * @author goorus, morph
 *
 */
class ControllerAbstract
{

	/**
	 * Выполняемое задание
	 *
	 * @var ControllerTask
	 */
	protected $task;

	/**
	 * Входные данные
	 *
	 * @var \Ruon\Data\DataRepositoryAbstract
	 */
	protected $input;

	/**
	 * Результирующие данные
	 *
	 * @var \Ruon\Data\DataRepositoryAbstract
	 */
	protected $output;

    /**
     *
     * @return ControllerTask
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     *
     * @param ControllerTask $task
     * @return $this|ControllerAbstract
     */
    public function setTask($task)
    {
        $this->task = $task;
        $this->input = $task->getInput();
        $this->output = $task->getOutput();

        return $this;
    }

}
