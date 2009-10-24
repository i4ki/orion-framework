<?php

class testOrionKernel extends UnitTestCase
{
	public $kern;
	
	public function testIf__OrionKernel__Exists()
	{
		$this->assertTrue(class_exists('OrionKernel'));
	}
	
	public function testIf__MethodGetInstance__Works()
	{
		$this->kern = OrionKernel::getInstance();
		$this->assertTrue(is_object($this->kern));
	}
	
	public function testIf__Singleton_Works_in_OrionKernel()
	{
		$this->assertIdentical($this->kern, OrionKernel::getInstance());
	}
}