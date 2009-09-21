<?php

class Notify extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'primary'		=> true,
						'notnull'		=> true,
						'autoincrement'	=> true
						)
		);
		
		$this->hasColumn('subject', 'string', 500);
		
		$this->hasColumn('message', 'string', 2000);
		
		$this->hasColumn('headers', 'string', 2000);
	}
}