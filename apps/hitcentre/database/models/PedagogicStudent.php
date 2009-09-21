<?php

class PedagogicStudent extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->option('charset','utf8');
		$this->option('collate','utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'notnull'		=> true,
						'primary'		=> true,
						'autoincrement'	=> true
						)
		);
		
		$this->hasColumn('nr_children', 'integer', 4);
		
		$this->hasColumn('hobby', 'string', 255);
		
		$this->hasColumn('expectations', 'string', 500);		
		
	}
	
	public function setUp()
	{
		$this->hasMany('Student', array(
						'local'		=> 'id',
						'foreign'	=> 'pedagogic_id'
						)
		);	
	}
}