<?php

namespace Ruon\Core\Data;

/**
 *
 * Абстрактное хранилище данных
 *
 * @author morph, goorus
 *
 */
abstract class DataRepositoryAbstract
{

	/**
	 * Очищает содержимое репозитария
	 */
	abstract public function flush();

	/**
	 * Очищает содержимое репозитария и устанавливает
	 * переданные значения
	 *
	 * @param array $data
	 */
	public function flushSet(array $data)
	{
		$this->flush();
		$this->mset($data);
	}

	/**
	 * Возвращает значение по ключу
	 *
	 * @param string $key Ключ
	 * @return mixed Значение
	 */
	abstract public function get($key);

	/**
	 * Возвращает всё содержимое провайдера
	 *
	 * @return array
	 */
	abstract public function getAll();

	/**
	 * Устанавливает несколько значений
	 *
	 * @param array $data Массив пар (ключ => значение)
	 */
	abstract public function mset(array $data);

	/**
	 * Устанавливает значение (или значения)
	 *
	 * @param string $key Ключ
	 * @param mixed $data Значение
	 */
	abstract public function set($key, $data);

}