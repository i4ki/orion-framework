<?php
/*
 * Created on 31/05/2009
 *
 * @author Tiago Natel de Moura
 */
require_once("Command.php");

 class testDatabase_MySQL extends PHPUnit_Framework_TestCase {
 	public function setUp() {
 		$this->dbMySQL = new Database_DBAbstract("mysql");
 	}
 	public function testIfPHPUnitWorksTrueTrue() {
 		$this->assertTrue(true);
 	}
 	public function testIfPHPUnitWorksFalseFalse() {
 		$this->assertFalse(false);
 	}

 	/*
 	 * TESTES DE INTEGRIDADE DA CLASSE
 	 */

 	public function testIfClassExists() {
 		$this->assertTrue(class_exists('Database_DBAbstract'));
 	}

 	public function testIfMethodConnectExists() {
 		$this->assertTrue(method_exists($this->dbMySQL,'connect'));
 	}
 	public function testIfMethodDriversExists() {
 		$this->assertTrue(method_exists($this->dbMySQL,'drivers'));
 	}
 	public function testIfMethodConfigExists() {
 		$this->assertTrue(method_exists($this->dbMySQL,'config'));
 	}
 	public function testIfMethodSelectDbExists() {
 		$this->assertTrue(method_exists($this->dbMySQL,'selectDB'));
 	}
 	public function testIfMethodSelectExists() {
 		$this->assertTrue(method_exists($this->dbMySQL,'select'));
 	}
 	public function testIfMethodInsertExists() {
 		$this->assertTrue(method_exists($this->dbMySQL,'insert'));
  	}

	/*
	 * MYSQL - TESTES DE VERIFICAÇÃO DE MÉTODOS
	 * CLASSE DATABASE_MYSQL
	 */
	public function testIfMethod_Drivers_ReturnClass_DatabaseMySQL() {
		$classe = $this->dbMySQL->drivers('mysql');
		$this->assertEquals('Database_MySQL',$classe);
	}


	/*
	 * POSTGRESQL - TESTES DE VERIFICAÇÃO DE MÉTODOS
	 * CLASSE DATABASE_POSTGRESQL
	 */



 }
?>
