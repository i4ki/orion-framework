<?php

class RespRel extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->option('charset','utf8');
		$this->option('collate','utf8_general_ci');
		
		$this->hasColumn('id','integer', 8, array(
							'autoincrement'	=> true,
							'notnull'		=> true,
							'primary'		=> true
						)
		);
						
		$this->hasColumn('resp_id', 'integer', 8, array(
							'notnull'		=> true,
							'autoincrement'	=> false
						)
		);
						
		$this->hasColumn('type_resp', 'integer', 1, array(
							'notnull'		=> true
						)
		);
	}
	
	public function setUp()
	{
		$this->hasOne('Student', array(
							'local'		=> 'id',
							'foreign'	=> 'foreign'
							)
		);
	}
	
	
	
}