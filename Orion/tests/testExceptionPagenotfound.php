<?php
/*
 * Created on 31/05/2009
 *
 * @author Tiago Natel de Moura
 */
require_once("Command.php");


/**
 * VERMELHO
 * ALI EM BAIXO
 */

 class testExceptionPagenotfound extends PHPUnit_Framework_TestCase {
	protected $except;

	public function setUp() {
		$this->except = new Exception_Pagenotfound("Exception Teste::PHPUnit tests");
	}
	public function testIfPHPUnitWorksTrueTrue() {
		$this->assertTrue(true);
	}
	public function testIfPHPUnitWorksFalseFalse() {
		$this->assertFalse(false);
	}
	public function testIfMethodGetMessageExists() {
		$this->assertTrue(method_exists($this->except,'getMensagem'));
	}
	public function testIfMethod__constructExists() {
		$this->assertTrue(method_exists($this->except,'__construct'));
	}
 }
?>
