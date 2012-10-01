<?php

namespace Ruon\Data\Source\Statement;

/**
 *
 * Запрос к базе данных
 *
 * @author morph, goorus
 *
 */
class DataSourceStatement
{
	/**
	 * Драйвер
	 *
	 * @var \Ruon\Data\Driver\DataDriverAbstract
	 */
	protected $driver;

	/**
	 * Выполняет запрос и возвращает набор данных
	 *
	 * @param \Ruon\Query\Query $query
     * @return mixed
	 */
	public function execute($query)
	{
		$query = $this->prepare($query);
		return $this->driver->executeQuery($query);
	}

    /**
     *
     * @param mixed $result
     */
    public function extract($result)
    {
        return $this->driver->extractResult($result);
    }

	/**
	 * Получить текущий драйвер
	 *
	 * @return \Ruon\Data\Driver\DataDriverAbstract
	 */
	public function getDriver()
	{
		return $this->driver;
	}

	/**
	 * Подготовить запрос к выполнению
	 *
	 * @param \Ruon\Query\Query $query
	 * @return string
	 */
	public function prepare($query)
	{
		$driverName = $this->driver->getName();
		$translator = $this->translatorManager->byName($driverName);
		$query = $translator->translate($query);
		return $query;
	}

	/**
	 * Изменить текущий драйвер
	 *
	 * @param \Ruon\Data\Driver\DataDriverAbstract $driver
	 */
	public function setDriver($driver)
	{
		$this->driver = $driver;
	}
}