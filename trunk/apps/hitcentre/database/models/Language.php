<?php

class Language extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->hasColumn('id', 'integer', 8, array(
						'notnull'		=> true,
						'autoincrement'	=> true,
						'primary'		=> true
						)
		);
		
		$this->hasColumn('name', 'string', 200);
		
		$this->hasColumn('created_by', 'string', 200);
		
	}
	
	public function setUp()
	{		
		$this->actAs('Timestampable');
		
		$this->hasMany('Course', array(
						'local'		=> 'id',
						'foreign'	=> 'language_id'
						)
		);
		
		$this->hasMany('TeacherLanguage', array(
						'local'		=> 'id',
						'foreign'	=> 'language_id'
						)
		);
	}
}