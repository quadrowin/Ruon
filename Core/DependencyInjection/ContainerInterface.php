<?php

namespace Ruon\Core\DependencyInjection;

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
