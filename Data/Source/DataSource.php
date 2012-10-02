<?php

namespace Ruon\Data\Source;

/**
 *
 * Источник данных
 *
 * @author morph, goorus
 *
 */
class DataSource
{
	/**
	 * Декущий драйвер
	 *
	 * @var \Ruon\Data\Driver\DataDriverAbstract
	 */
	protected $driver;

	/**
	 * Брокер запросов
	 *
	 * @var \Ruon\Data\Source\Statement\DataSourceStamentBroker
	 */
	protected $statementBroker;

	/**
	 * Создать новый запрос
	 *
	 * @return \Ruon\Data\Source\Statement\DataSourceStatement
	 */
	public function createStatement()
	{
		return $this->statementBroker->create($this->driver);
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
	 * Получить текущий брокер запросов
	 *
	 * @return \Ruon\Data\Source\Statement\DataSourceStamentBroker
	 */
	public function getStatementBroker()
	{
		return $this->statementBroker;
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

	/**
	 * Изменить текущий брокер запросов
	 *
	 * @param \Ruon\Data\Source\Statement\DataSourceStamentBroker $statementBroker
	 */
	public function setStatementBroker($statementBroker)
	{
		$this->statementBroker = $statementBroker;
	}

}