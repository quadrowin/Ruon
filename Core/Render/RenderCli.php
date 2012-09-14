<?php

namespace Ruon\Core\Render;

/**
 *
 * Рендер в консоль
 *
 * @author Goorus
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
