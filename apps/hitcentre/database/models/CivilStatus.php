<?php

class CivilStatus extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'primary'		=> true,
						'autoincrement'	=> true,
						'notnull'		=> true
						)
		);
		
		$this->hasColumn('name', 'string', 200);
	}
	
	public function setUp()
	{
		$this->hasMany('Student', array(
					'local'		=> 'id',
					'foreign'	=> 'civilstatus_id'
					)
		);
		
		$this->hasMany('Responsible', array(
					'local'		=> 'id',
					'foreign'	=> 'civilstatus_id'
					)
		);
			
	}
}