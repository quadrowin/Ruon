<?php

namespace Ruon\Core\Loader;

/**
 * Абстрактный автозагрузчик
 *
 * @author morph, goorus
 *
 */
abstract class LoaderAutoloadAbstract
{
	/**
	 * Регистрирует текущий автозагрузчик
	 *
	 * @return boolean возвращает true если удалость зарегистрировать
	 * автозагрузчик, false - в противном случае
	 */
	public function register()
	{
		return true;
	}

	/**
	 * Убирает регистрацию автозагрузчика
	 *
	 * @return boolean возвращает true если удалось убрать регистрацию
	 * автозагрузчика, false - в противном случае
	 */
	public function unregister()
	{
		return true;
	}
}