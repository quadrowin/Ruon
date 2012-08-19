<?php

namespace Ruon\Core\Config;

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
	 * @param Ruon\Core\Config\ConfigAbstract|array $classConfig Заданная
	 * в классе конфигурация
	 * @return Ruon\Core\Config\ConfigAbstract
	 */
	abstract public function get($className, $classConfig);

}