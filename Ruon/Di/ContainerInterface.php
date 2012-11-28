<?php

namespace Ruon\Di;

/**
 *
 * @author goorus, morph
 */
interface ContainerInterface
{

	/**
	 *
	 * @param string $class
	 * @param mixed $context
	 * @return object
	 */
	public function get($class, $context);

}
