<?php

require_once(ORION_PATH . SEP . 'Orion.php');

class testOrionOrganizer extends UnitTestCase
{
	public function testIf__ClassOrionOrganizer__Exists()
	{
		$this->assertTrue(class_exists('OrionOrganizer'));
	}
}