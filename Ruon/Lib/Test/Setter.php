<?php

namespace Ruon\Lib\Test;

/**
 *
 * Тестер для методов "set" и "get"
 *
 * @author goorus, morph
 *
 */
class Setter
{

	/**
	 * Значения для тестов по умолчанию
	 *
	 * @var array
	 */
	protected $defaultTests = array(
		'123',
		null
	);

	/**
	 * Выполняет тесты для сеттера и геттера и возвращает
	 * объект в начальное состояние
	 *
	 * @param \PHPUnit_Framework_TestCase $test Тест
	 * @param object $object Тестируемый объект
	 * @param string $property Название свойства.
     * Будут тестироваться методы "set{$property}" и "get{$property}"
	 * @param array $tests [optional] Значения для теста
	 * @param boolean $chainedCalls [optional] Если true, ожидается, что сеттер
	 * будет возвращать объект, если false - возвращаемое значение сеттера
	 * не проверяется.
	 */
	public function test(
        $test, 
        $object, 
        $property, 
        $tests = null,
        $chainedCalls = true
    ) {
        $getter = 'get' . $property;
        $setter = 'set' . $property;
        
		if (!$tests) {
			$tests = $this->defaultTests;
			$tests[] = new \stdClass();
		}

		$original = $object->$getter();

		foreach ($tests as $testValue) {
			$setReturn = $object->$setter($testValue);
			$getReturn = $object->$getter();

			if ($chainedCalls) {
				$test->assertSame(
					$object, $setReturn,
					'Setter did not return an object.'
				);
			}

			$test->assertSame($testValue, $getReturn);
		}

		$object->$setter($original);
	}

}
