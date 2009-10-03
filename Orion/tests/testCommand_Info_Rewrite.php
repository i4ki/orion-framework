<?php
/*
 * Created on 31/05/2009
 *
 * @author Tiago Natel de Moura
 */


 //Interface
 require_once("../Command.php");

 class testCommand_Info_Rewrite extends PHPUnit_Framework_TestCase {
 	protected $rewrite;

 	public function setUp() {
 		$this->rewrite = new Tests_Command_Info_RewriteMock();
 	}
	public function testIfPHPUnitWorksTrueTrue() {
		$this->assertTrue(true);
	}
	public function testIfPHPUnitWorksFalseFalse() {
		$this->assertFalse(false);
	}
	public function testIfMethodGetModuleExists() {
		$this->assertTrue(method_exists($this->rewrite,'getModule'));
	}
	public function testIfMethodGetActionExists() {
		$this->assertTrue(method_exists($this->rewrite,'getAction'));
	}
	public function testIfMethodGetDataxists() {
		$this->assertTrue(method_exists($this->rewrite,'getData'));
	}
	public function testIfMethodGetArrayExists() {
		$this->assertTrue(method_exists($this->rewrite,'getArray'));
	}
	public function testIfMethodGetVarByIndexExists() {
		$this->assertTrue(method_exists($this->rewrite,'getVarByIndex'));
	}

	public function testIfMethodGetModuleReturnString() {
		$this->rewrite->setVars();

		$this->assertType('string',$this->rewrite->getModule());
	}
 }
