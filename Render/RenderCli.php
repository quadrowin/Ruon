<?php

namespace Ruon\Render;

/**
 *
 * Рендер в консоль
 *
 * @author Goorus, Morph
 *
 */
class RenderCli extends RenderAbstract
{

    /**
     *
     * @return string
     */
    public function fetch()
    {
        return var_export($this->vars);
    }

}
