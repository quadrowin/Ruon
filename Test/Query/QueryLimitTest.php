<?php

namespace Ruon\Query;

/**
 * Test class for QueryLimit.
 * Generated by PHPUnit on 2012-06-04 at 18:19:42.
 */
class QueryLimitTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var QueryLimit
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{

	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	/**
	 * @covers Ruon\Query\QueryLimit::__construct
	 * @covers Ruon\Query\QueryLimit::getCount
	 * @covers Ruon\Query\QueryLimit::setCount
	 */
	public function testGetCount()
	{
		$this->object = new QueryLimit(0, 10);
		$this->assertEquals(10, $this->object->getCount());

		$tester = new \Ruon\Lib\Test\Setter;
		$tester->test($this, $this->object, 'Count');
	}

	/**
	 * @covers Ruon\Query\QueryLimit::__construct
	 * @covers Ruon\Query\QueryLimit::getOffset
	 * @covers Ruon\Query\QueryLimit::setOffset
	 */
	public function testGetOffset()
	{
		$this->object = new QueryLimit(3, 10);
		$this->assertEquals(3, $this->object->getOffset());

		$tester = new \Ruon\Lib\Test\Setter;
		$tester->test($this, $this->object, 'Count');
	}

	/**
	 * @covers Ruon\Query\QueryLimit::setOffset
	 * @covers Ruon\Query\QueryLimit::hasOffset
	 */
	public function testHasOffset()
	{
		$this->object = new QueryLimit(0, 10);
		$this->assertEquals(true, $this->object->hasOffset());

		$this->object->setOffset(3);
		$this->assertEquals(true, $this->object->hasOffset());

		$this->object->setOffset(null);
		$this->assertEquals(false, $this->object->hasOffset());

		$this->object->setOffset(5);
		$this->assertEquals(true, $this->object->hasOffset());
	}

}