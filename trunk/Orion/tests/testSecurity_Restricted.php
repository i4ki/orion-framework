<?php

require_once("../Command.php");

class testSecurity_Restricted extends PHPUnit_Framework_TestCase {
	
	/**
	 * Verifica se a classe existe
	 *
	 */
	public function testIfClass__Security_Restricted__Exists() {
		$this->assertTrue(class_exists('Security_Restricted'));
	}
	
#############################################
	#  Testes se métodos existem
	
	public function testIfMethod__startSession__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','startSession'));
	}
	
	public function testIfMethod__shutdownAllSssions__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','shutdownAllSessions'));
	}
	
	public function testIfMethod__shutdownSessionByKey__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','shutdownSessionByKey'));
	}
	
	public function testIfMethod__sessionIdRegistered__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','sessionIsRegistered'));
	}
	
	public function testIfMethod__setURL__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','setURL'));
	}
	
	public function testIfMethod__isLogged__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','isLogged'));
	}
	
	public function testIfMethod__redirLogin__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','redirLogin'));
	}
	
	public function testIfMethod__generateUniqueKEY__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','generateUniqueKEY'));
	}
	
	public function testIfMethod__generateKeyForUserAgent__Exists() {
		$this->assertTrue(method_exists('Security_Restricted','generateKeyForUserAgent'));
	}
	
##################################################
	# Testes de retornos de méthodos
	public function testIfMethod__shutdownAllSessions__Return_Array() {
		$this->assertTrue(is_array(Security_Restricted::shutdownAllSessions()));
	}
	
}
