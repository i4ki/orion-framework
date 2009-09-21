<?php

class Teacher extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->option('charset','utf8');
		$this->option('collate','utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'primary'		=> true,
						'autoincrement'	=> true,
						'notnull'		=> true
						)
		);
		
		$this->hasColumn('firstname', 'string', 255);
		
		$this->hasColumn('lastname', 'string', 255);
		
		$this->hasColumn('acronym', 'string', 2);
		
		$this->hasColumn('cpf', 'string', 14);
		
		$this->hasColumn('rg', 'string', 14);
		
		$this->hasColumn('tel_res', 'string', 30);

		$this->hasColumn('tel_cel', 'string', 30);
		
		$this->hasColumn('email', 'string', 255);
		
		$this->hasColumn('address', 'string', 255);
		
		$this->hasColumn('number', 'string', 8);
		
		$this->hasColumn('complement', 'string', 255);
		
		$this->hasColumn('district', 'string', 255);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('state_foreign', 'string', 255);
		
		$this->hasColumn('city_id', 'integer', 8);
		
		$this->hasColumn('city_foreign', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', 8);
		
		$this->hasColumn('bank_name', 'string', 200);
		
		$this->hasColumn('ag_bank', 'string', 200);
		
		$this->hasColumn('account_bank', 'string', 200);
		
		$this->hasColumn('day_disp', 'string', 500);
		
		$this->hasColumn('date_admission', 'timestamp');
		
		$this->hasColumn('readjustment', 'timestamp');		
		
	}
	
	public function setUp()
	{
		$this->hasOne('Country', array(
					'local'		=> 'country_id',
					'foreign'	=> 'id'
					)
		);
		
		$this->hasOne('State', array(
					'local'		=> 'state_id',
					'foreign'	=> 'id'
					)
		);
		
		$this->hasOne('City', array(
					'local'		=> 'city_id',
					'foreign'	=> 'id'
					)
		);
		
		$this->hasMany('TeacherLanguage', array(
					'local'		=> 'id',
					'foreign'	=> 'teacher_id'
					)
		);
		
	}
}