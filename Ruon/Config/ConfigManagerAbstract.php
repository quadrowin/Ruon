<?php

namespace Ruon\Config;

/**
 *
 * Абстрактный обработчик менеджера конфигураций
 *
 * @author morph, goorus
 *
 */
abstract class ConfigManagerAbstract
{

	/**
	 * Получить конфигурацию для класса по имени класса
	 *
	 * @param string $className Название класса
	 * @param \Ruon\Config\ConfigAbstract|array $classConfig Заданная
	 * в классе конфигурация
	 * @return \Ruon\Config\ConfigAbstract
	 */
	abstract public function get($className, $classConfig);

}