<?php

class testOrionInteger extends UnitTestCase
{
	protected $orion;
	
	public function setUp()
	{
		$this->orion = Orion::getInstance();
	}
	
	public function testIf__ClassOrionInteger__Exists()
	{
		$this->assertTrue(class_exists('OrionInteger'));
	}
	
	public function testIf__MethodOrionIntegerConstructor__IsWorks()
	{
		$int = new OrionInteger(1);
		$this->assertTrue(isset($int));
		$this->assertEqual(1, $int->value);
		$this->assertEqual(1, $int->val);
		$this->assertEqual(1, $int->value());
	
		try {
			$int = new OrionInteger("teste");
			$this->assertTrue(isset($int));
			$this->assertNotEqual("teste", $int->value);
			$this->assertNotEqual("teste", $int->val);
			$this->assertNotEqual("teste", $int->value());
			$this->fail();
		} catch(OrionException $e)
		{
			$this->assertEqual($e->getCode(), OrionError::TYPE_INTEGER);
		}
		
		try {
			$int = new OrionInteger();
			$this->assertEqual(0, $int->value);
			$this->assertEqual(0, $int->val);
			$this->assertEqual(0, $int->size);
		} catch(OrionException $e)
		{
			$this->fail();
		}
	}
	
	public function testIf__MethodAdd__Works()
	{
		$int = new OrionInteger(20);
		$this->assertEqual(30, $int->add(10));
		$this->assertEqual(50, $int->add(10,10));
		$this->assertEqual(100, $int->add(50));
		$this->assertEqual(500, $int->add(20,20,20,20,20,100,100,100));
		$this->assertEqual(450, $int->add(-50));
		$this->assertEqual(451.5, $int->add(1.5));
	}
	
	public function testIf__MethodSub__Works()
	{
		$int = new OrionInteger(20);
		$this->assertEqual(15, $int->sub(1,1,1,1,1));
		$this->assertEqual(10, $int->sub(2,2,1));
		$this->assertEqual(50, $int->sub(-40));
	}
	
	public function testIf__MethodToString__Works()
	{
		$int = new OrionInteger(500);
		$this->assertNotIdentical('500', $int->value);
		$this->assertIdentical('500', $int->toString());
	}
	
	public function testIf__MethodFloatValue__Works()
	{
		$this->assertIdentical(10.00,OrionInteger::__s(10)->floatValue());
		$this->assertIdentical(10.00000,OrionInteger::__s(10)->floatValue(5));
		$int = OrionInteger::__s(125);
		$int->add(0.15255);
		$this->assertIdentical(125.15255,$int->floatValue(5));
	}
}