<?php

/**
 * Tabela Empresas
 */
class Company extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id','integer',8, array(
							'primary' 		=> true,
							'autoincrement' => true,
							'notnull'		=> true
							)
		);
		
		$this->hasColumn('name','string',255, array(
							'notnull'		=> true
						)
		);
		
		$this->hasColumn('cnpj', 'string', 255, array(
							'notnull' 		=> true,
						)
		);
		
		$this->hasColumn('tel', 'string', 200);
		
		$this->hasColumn('tel_fax', 'string', 200);
		
		$this->hasColumn('email_contact', 'string', 255);
		
		$this->hasColumn('email_finance', 'string', 255);
		
		$this->hasColumn('address', 'string', 255);
		
		$this->hasColumn('number', 'string', 8);
		
		$this->hasColumn('complement', 'string', 255);
		
		$this->hasColumn('district', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', 8);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('state_foreign','string', 255);
		
		$this->hasColumn('city_id','integer', 8);
		
		$this->hasColumn('city_foreign', 'string', 255);
		
		$this->hasColumn('cep', 'string', 10);
		
		// and so on
	}
	
	public function setUp() {
		$this->hasOne('Country', array(
						'local'		=> 'country_id',
						'foreign' 	=> 'id'
					)
		);
		
		$this->hasOne('State', array(
						'local' 	=> 'state_id',
						'foreign' 	=> 'id',
					)
		);
		
		$this->hasOne('City', array(
						'local' 	=> 'city_id',
						'foreign' 	=> 'id'
					)
		);
		
		$this->hasMany('Student as Students', array(
						'local'		=> 'id',
						'foreign'	=> 'company_id'
						)
		);
		
		$this->actAs('Timestampable');
	}
}