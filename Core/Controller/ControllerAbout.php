<?php

namespace Ruon\Core\Controller;

/**
 *
 * ControllerAbout
 *
 * @author Goorus
 *
 */
class ControllerAbout extends ControllerAbstract
{

    public function execute()
    {
        return array('Hello' => 'Universe');
    }

}
