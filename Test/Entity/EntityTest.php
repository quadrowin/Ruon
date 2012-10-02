<?php

namespace Ruon\Entity;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-20 at 23:20:08.
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Entity
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Entity;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Ruon\Entity\Entity::__get
     */
    public function test__get()
    {
        $this->object->replaceFields(array(
            'field1' => 1,
            'field2' => 'second'
        ));

        $this->assertSame(1, $this->object->field1);
        $this->assertSame('second', $this->object->field2);
    }

    /**
     * @covers Ruon\Entity\Entity::__set
     */
    public function test__set()
    {
        $this->object->field1 = 'first';
        $this->object->field2 = 2;

        $this->assertSame(
            array('field1' => 'first', 'field2' => 2),
            $this->object->getFields()
        );
    }

    /**
     * @covers Ruon\Entity\Entity::getEntityScheme
     * @covers Ruon\Entity\Entity::setEntityScheme
     */
    public function testGetEntityScheme()
    {
        $tester = new \Ruon\Lib\Test\Setter;
        $tester->test($this, $this->object, 'EntityScheme');
    }

    /**
     * @covers Ruon\Entity\Entity::getFields
     */
    public function testGetFields()
    {
        $fields = array('a', 'b' => 'c');
        $this->object->replaceFields($fields);
        $this->assertSame($fields, $this->object->getFields());
    }

    /**
     * @covers Ruon\Entity\Entity::getTheFields
     */
    public function testGetTheFields()
    {
        $this->object->replaceFields(array(
            'a' => 1,
            'b' => 'second',
            'c' => true,
            'd' => 'e'
        ));
        $this->assertSame(
            array('b' => 'second', 'c' => true),
            $this->object->getTheFields(array('b', 'c'))
        );
    }

    /**
     * @covers Ruon\Entity\Entity::getUpdatedFields
     */
    public function testGetUpdatedFields()
    {
        $this->object->replaceFields(array(
            'a' => 'b',
            'c' => 'd',
            'e' => 'f',
            'g' => 'h'
        ));
        $this->object->mergeFields(array(
            'c' => 'ccc',
            'k' => 'l'
        ));
        $this->assertSame(
            array('a' => 'a', 'c' => 'c', 'e' => 'e', 'g' => 'g', 'k' => 'k'),
            $this->object->getUpdatedFields()
        );
    }

    /**
     * @covers Ruon\Entity\Entity::id
     * @todo   Implement testId().
     */
    public function testId()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ruon\Entity\Entity::insert
     * @todo   Implement testInsert().
     */
    public function testInsert()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ruon\Entity\Entity::mergeFields
     * @todo   Implement testMergeFields().
     */
    public function testMergeFields()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ruon\Entity\Entity::replaceFields
     * @todo   Implement testReplaceFields().
     */
    public function testReplaceFields()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ruon\Entity\Entity::save
     * @todo   Implement testSave().
     */
    public function testSave()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ruon\Entity\Entity::setEntityManager
     * @todo   Implement testSetEntityManager().
     */
    public function testSetEntityManager()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ruon\Entity\Entity::update
     * @todo   Implement testUpdate().
     */
    public function testUpdate()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

}
