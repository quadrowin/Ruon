<?php

namespace Ruon\Core\Config;

/**
 *
 * Абстрактное хранилище для конфигураций
 *
 * @author morph, goorus
 *
 */
abstract class ConfigRepositoryAbstract
    extends \Ruon\Core\Data\DataRepositoryArray
{
	/**
	 * Проверить загружена ли конфигурация
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function exists($key)
	{
		return isset($this->data[$key]);
	}

}