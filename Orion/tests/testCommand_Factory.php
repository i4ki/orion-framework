<?php
/*
 * Created on 30/05/2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once("../Command.php");


 /*
  * Atenção::
  * Este método é importante
  */

 class testCommand extends PHPUnit_Framework_TestCase {
	protected $commFactory;

	public function testIfPHPUnitWorks() {
		$this->assertTrue(true);
		$this->assertFalse(false);
	}

	public function setUp() {
		$this->commFactory = new Command_Factory();
	}

	public function testIfMethodCreateCommandExists() {
		$this->assertTrue(method_exists($this->commFactory,'createCommand'));
	}

	/*
	 * Atenção::
	 * O método Command_Factory::createCommand() deve retornar um objeto
	 */
	 public function testTypeReturnMethodCreateCommand() {
	 	$info = new Command_Info_RewriteMock();
	 	$this->assertType('object',$this->commFactory->createCommand($info));
	 }
 }

 class Command_Info_RewriteMock implements Command_Info {
	protected $gets;

	public function getModule() { }

	public function getAction() { }
 }
?>
