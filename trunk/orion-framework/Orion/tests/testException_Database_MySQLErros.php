<?php
/*
 * Created on 01/06/2009
 *
 * @author Tiago Natel de Moura
 */

 require_once("../Command.php");

 class testException_Database_MySQLErros extends PHPUnit_Framework_TestCase {
 	public $erro;
 	public function setUp() {
 		$this->erro = new Exception_Database_MySQLErros(600);
 		$this->erro->lerXML();
 	}

 	public function testIfClassException_Database_MySQLErrosExists() {
 		$this->assertTrue(class_exists('Exception_Database_MySQLErros'));
 	}

 	public function testIfMethodGetNodeExists() {
 		$this->assertTrue(method_exists($this->erro,'getNode'));
 	}

 	public function testIfMethodGetNodeReturn() {
 		$this->assertArrayHasKey('codigo',$this->erro->getNode('erro'));
 	}
 }
?>
