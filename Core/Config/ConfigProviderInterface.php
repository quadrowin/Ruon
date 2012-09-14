<?php

namespace Ruon\Core\Config;

/**
 *
 * @author goorus, morph
 *
 */
interface ConfigProviderInterface
{

	/**
	 *
	 *
	 * @param string $className
	 * @param array $classConfig
	 * @return mixed
	 */
	public function get($className, $classConfig = array());

}
