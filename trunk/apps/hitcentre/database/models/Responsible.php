<?php

class Responsible extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset','utf8');
		$this->option('collate','utf8_general_ci');
		
		$this->hasColumn('id','integer',8,array(
							'primary'		=> true,
							'notnull'		=> true,
							'autoincrement'	=> true
						)
		);		
		
		$this->hasColumn('firstname', 'string', 255);
		
		$this->hasColumn('lastname', 'string', 255);
		
		$this->hasColumn('cpf', 'string', 14);
		
		$this->hasColumn('rg', 'string', 14);
		
		$this->hasColumn('civilstatus_id', 'integer', 8);
		
		$this->hasColumn('nationality', 'string', 255);
		
		$this->hasColumn('tel_res', 'string', 30);
		
		$this->hasColumn('tel_cel', 'string', 30);
		
		$this->hasColumn('email_part', 'string', 255);
		
		$this->hasColumn('email_pro', 'string', 255);
		
		$this->hasColumn('address', 'string', 255);
		
		$this->hasColumn('number', 'string', 8);
		
		$this->hasColumn('complement', 'string', 255);
		
		$this->hasColumn('district', 'string', 255);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('state_foreign', 'string', 255);
		
		$this->hasColumn('city_id', 'integer', 8);
		
		$this->hasColumn('city_foreign', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', 8);
		
		$this->hasColumn('cep', 'string', 10);
	}
	
	public function setUp()
	{
		$this->hasOne('City', array(
						'local'		=> 'city_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('State', array(
						'local'		=> 'state_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('Country', array(
						'local'		=> 'country_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('CivilStatus', array(
						'local'		=> 'civilstatus_id',
						'foreign'	=> 'id'
					)
		);
		
		$this->actAs('Timestampable');
	}
}