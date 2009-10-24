<?php

require_once("configure_tests.php");

class AllTests extends TestSuite
{
	public function AllTests()
	{
		$this->TestSuite('All Tests');
		$this->addFile(TESTS_PATH . SEP . 'testOrion.php');
		$this->addFile(TESTS_PATH . SEP . 'Orion' . SEP . 'testOrionKernel.php');
		$this->addFile(TESTS_PATH . SEP . 'Orion' . SEP . 'testOrionOrganizer.php');
		$this->addFile(TESTS_PATH . SEP . 'Orion' . SEP . 'testString.php');
		$this->addFile(TESTS_PATH . SEP . 'Orion' . SEP . 'testInteger.php');
		
		$this->addFile(TESTS_PATH . SEP . 'Orion' . SEP . 'Security' . SEP . 'Crypt' . SEP . 'testRC4.php');
	}
}