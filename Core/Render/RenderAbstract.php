<?php

namespace Ruon\Core\Render;

/**
 *
 * Абстрактный рендер
 *
 * @author Goorus
 *
 */
class RenderAbstract
{

    /**
     *
     * @var array
     */
    protected $vars = array();

    /**
     * Вывод
     *
     * @param string $template
     */
    public function display($template)
    {
        echo $this->fetch($template);
    }

    /**
     *
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     *
     * @param array $vars
     * @return $this|RenderAbstract
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;

        return $this;
    }

}
