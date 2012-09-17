<?php

namespace Ruon\Core\Data;

/**
 *
 * Транспорт данных
 *
 * @author goorus, morph
 *
 */
class DataTransport extends DataRepositoryAbstract
{

	/**
	 * Поставщики данных.
	 *
	 * @var array of DataRepositoryAbstract
	 */
	protected $providers = array();

	/**
	 * Добавляет провайдера последним в конец списка
	 *
	 * @param DataRepositoryAbstract $provider
     * @param DataRepositoryAbstract $_
	 * @return $this|DataTransport
	 */
	public function appendProvider()
	{
		$this->providers = array_merge($this->providers, func_get_args());

		return $this;
	}

	/**
	 * Очистка данных всех провайдеров или текущей транзации.
	 *
	 * @return $this|DataTransport
	 */
	public function flush()
	{
        foreach ($this->providers as $provider) {
            $provider->flush();
        }

		return $this;
	}

	/**
	 * Получение данных. Получает значение для переданного ключа (ключей).
	 * Для каждого ключа будет возвращено значение из провайдера, который
	 * вернет отличное от null.
	 *
	 * @param mixed $_ Ключ или список ключей
	 * @return mixed Значение или список значений
	 */
	public function get($key)
	{
		$keys = func_get_args();
		$results = array();

        foreach ($keys as $key) {
            $data = null;
            foreach ($this->providers as $provider) {
                $chunk = $provider->get($key);
                if ($chunk !== null) {
                    $data = $chunk;
                    break;
                }
            }
            $results[] = $data;
        }

		return count($results) == 1 ? $results[0] : $results;
	}

	/**
	 * Возвращает все значения из всех провайдеров.
	 * Если начата транзакция, будет возвращаен буффер транзакции.
	 *
	 * @return array Массив пар (ключ => значение)
	 */
	public function getAll()
	{
        $result = array();
		foreach ($this->providers as $provider) {
			$result = array_merge($result, $provider->getAll());
		}

		return $result;
	}

	/**
	 * Возвращает провайдера по индексу
	 *
	 * @param integer $index Индекс
	 * @return DataRepositoryAbstract Провайдер
	 */
	public function getProvider($index)
	{
		return $this->providers[$index];
	}

	/**
	 * Возвращает всех провайдеров
	 *
	 * @return array of DataRepositoryAbstract
	 */
	public function getProviders()
	{
		return $this->providers;
	}

	/**
	 * Устанавливает несколько значений
	 *
	 * @param array $data
	 * @return $this|DataTransport
	 */
	public function mset(array $data)
	{
        foreach ($this->providers as $provider) {
            $provider->mset($data);
        }

		return $this;
	}

	/**
	 * Добавляет провайдера последним в начало списка
	 *
	 * @param DataRepositoryAbstract $provider
	 * @return $this|DataTransport
	 */
	public function prependProvider($provider)
	{
		array_unshift($this->providers, $provider);

		return $this;
	}

	/**
	 * Очищает список провайдеров
	 *
	 * @return $this|DataTransport
	 */
	public function removeProviders()
	{
		$this->providers = array();

		return $this;
	}

	/**
	 * Устанавливает значение в провайдерах.
	 * Если есть активная транзакция, значение попадет в буффер.
	 *
	 * @param string $key
	 * @param mixed $data
	 * @return $this|DataTransport
	 */
	public function set($key, $data)
	{
        foreach ($this->providers as $provider) {
            $provider->set($key, $data);
        }

		return $this;
	}

}