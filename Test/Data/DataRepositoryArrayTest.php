<?php

namespace Ruon\Data;

/**
 * Test class for DataRepositoryArray.
 * Generated by PHPUnit on 2012-05-06 at 00:02:25.
 */
class DataRepositoryArrayTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var DataRepositoryArray
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new DataRepositoryArray;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * Данные для теста testGetSet
	 *
	 * @return array
	 */
	public function providerGetSet()
	{
		return array(
			'withText'	=> array(
				array(
					'key1'						=> 'value1',
					'key11'						=> null,
					'key2.key22'				=> 'value22',
					'key2.key23'				=> null,
					'key3.key31'				=> array('value31', 'value32'),
					'key3.key31.0'				=> 'value31',
					'key3.key31.2'				=> null,
					'key4.key41.0'				=> array('value41'),
					'key4.key41.0.0'			=> 'value41',
					'key4.key41.0.1'			=> null,
					'key4.key41.1.key42'		=> array('key43' => 'value43'),
					'key4.key41.1.key42.key43'	=> 'value43',
					'key4.key41.2'				=> null
				)
			),
			'empty'		=> array(
				array(

				)
			)
		);
	}

	/**
	 * Данные для теста testGetSetData
	 *
	 * @return array
	 */
	public function providerGetSetData()
	{
		return array(
			'withText' => array(
				array('some' => 'key')
			),
			'emptyArray' => array(
				array()
			),
			'12' => array(
				array(1 => 'a')
			)
		);
	}
	/**
	 * @covers Ruon\Data\DataRepositoryArray::flushSet
	 * @covers Ruon\Data\DataRepositoryArray::getAll
	 * @dataProvider providerGetSetData
	 * @param array $case Тестовые данные
	 */
	public function testFlushSet($case)
	{
		$this->object->flushSet($case);
		$this->assertEquals($case, $this->object->getAll());
	}

	/**
	 * @covers Ruon\Data\DataRepositoryArray::getAll
	 * @covers Ruon\Data\DataRepositoryArray::mset
	 * @dataProvider providerGetSetData
	 * @param array $case Тестовые данные
	 */
	public function testGetAll($case)
	{
		$this->object->flush();
		$this->assertEmpty($this->object->getAll());

		$this->object->mset($case);
		$this->assertEquals($case, $this->object->getAll());

		$add = array(
			'c' => 'cv',
			4 => 'v4'
		);
		$case['c'] = 'cv';
		$case[4] = 'v4';

		$this->object->mset($add);
		$this->assertEquals($case, $this->object->getAll());

		$this->object->flush();
		$this->assertEmpty($this->object->getAll());
	}
	/**
	 * @covers Ruon\Data\DataRepositoryArray::get
	 * @covers Ruon\Data\DataRepositoryArray::set
	 * @covers Ruon\Data\DataRepositoryArray::flush
	 * @dataProvider providerGetSet
	 * @param array $case Тестовые данные
	 */
	public function testGetSet($case)
	{
		$this->object->flush();
		foreach ($case as $key => $value) {
			$this->object->set($key, $value);
			$this->assertEquals($this->object->get($key), $value);
		}
		$this->object->flush();
	}

}
