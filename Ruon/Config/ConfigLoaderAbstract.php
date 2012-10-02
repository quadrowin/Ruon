<?php

namespace Ruon\Config;

/**
 *
 * Абстрактный загрузчик конфигурации
 *
 * @author morph, goorus
 *
 */
abstract class ConfigLoaderAbstract
{

	/**
	 * Загружает конфигурацию
	 *
	 * @param string $className
	 * @return array
	 */
	abstract public function load($className);
}