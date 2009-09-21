<?php

class TeacherLanguage extends Doctrine_Record
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
		
		$this->hasColumn('teacher_id', 'integer', 8);
		
		$this->hasColumn('language_id', 'integer', 8);
		
		$this->hasColumn('pronunciation', 'string', 255);
		
		$this->hasColumn('ntredacao', 'string', 8);
		
		$this->hasColumn('ntteste', 'string', 8);
	}
	
	public function setUp()
	{
		$this->hasOne('Teacher', array(
					'local'		=> 'teacher_id',
					'foreign'	=> 'id'
					)
		);
		
		$this->hasOne('Language', array(
					'local'		=> 'language_id',
					'foreign'	=> 'id'
					)
		);
	}
}