<?php

namespace Ruon\Controller;

/**
 * Главная страница
 *
 * @author Goorus, Morph
 */
class ControllerIndex extends ControllerAbstract
{

    public function execute()
    {
        echo 'Hello, Universe!';
        $this->task->setRender('Ruon\\Render\\RenderNope');
    }

}
