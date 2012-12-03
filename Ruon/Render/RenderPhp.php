<?php

namespace Ruon\Render;

/**
 *
 * Рендер php
 *
 * @author Goorus, Morph
 *
 */
class RenderPhp extends RenderAbstract
{

    /**
     *
     * @return string
     */
    public function fetch($template)
    {
        ob_clean();
        extract($this->vars);
        require $template;

        return ob_get_clean();
    }

}
