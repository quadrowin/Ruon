<?php

namespace Ruon\Core\Data;

/**
 *
 * Интерфейс провайдера данных
 *
 * @author goorus, morph
 *
 */
class DataRepositoryArray extends DataRepositoryAbstract
{

	/**
	 * Данные репозитария
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * Очищает содержимое буффера
	 */
	public function flush()
	{
		$this->data = array();
	}

	/**
	 * Подменяет содержимое репозитария
	 *
	 * @param array $data
	 */
	public function flushSet(array $data)
	{
		$this->data = $data;
	}

	/**
	 * Получить данные по ключу
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		return isset($this->data[$key]) ? $this->data[$key] : null;
	}

	/**
	 * Возвращает все данные хранилища
	 *
	 * @return array
	 */
	public function getAll()
	{
		return $this->data;
	}

	/**
	 * Устанавливает несколько значений
	 *
	 * @param array $data Массив пар (ключ => значение)
	 */
	public function mset(array $data)
	{
		$this->data = $data + $this->data;
	}

	/**
	 * Добавить в репозиторий данные по ключу
	 *
	 * @param string $key Ключ
	 * @param mixed $data Данные
	 */
	public function set($key, $data)
	{
		$this->data[$key] = $data;
	}

}
