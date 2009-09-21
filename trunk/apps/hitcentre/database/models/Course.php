<?php

class Course extends Doctrine_Record
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
		
		$this->hasColumn('description', 'string', 5000);
		
		$this->hasColumn('language_id', 'integer', 8);
		
		$this->hasColumn('created_by', 'string', 200);
		
	}
	
	public function setUp()
	{
		$this->hasMany('CourseStudent', array(
						'local'		=> 'id',
						'foreign'	=> 'course_id'
						)
		);
		
		$this->hasOne('Language', array(
						'local'		=> 'language_id',
						'foreign'	=> 'id'
					)
		);

		$this->actAs('Timestampable');
	}
}