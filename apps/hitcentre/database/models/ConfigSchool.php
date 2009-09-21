<?php

/**
 * @author Tiago Natel de Moura[
 * @package 
 */

class ConfigSchool extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset','utf8');
		$this->option('collate','utf8_general_ci');
		
		$this->hasColumn('id','integer',4, array(
							'notnull' => true,
							'autoincrement' => true,
							'primary' => true
						)
		);
		
		$this->hasColumn('company_name','string', 255);
		
		$this->hasColumn('commercial_name','string', 255);
		
		$this->hasColumn('cnpj','string', 18);
		
		$this->hasColumn('street','string', 255);
		
		$this->hasColumn('district','string', 255);
		
		$this->hasColumn('city_id','integer', 8);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('country_id', 'integer', 8);
		
		$this->hasColumn('zip','string', 20);
		
		$this->hasColumn('telefone','string', 255);
		
		$this->hasColumn('telefone_fax','string', 255);
		
		$this->hasColumn('email_main','string', 255);
	}
	
	public function setUp() {
		$this->hasOne('City', array(
						'local' 	=> 'city_id',
						'foreign'	=> 'id'
					)
		);
		
		$this->hasOne('State', array(
						'local' 	=> 'state_id',
						'foreign' 	=> 'id'
					)
		);
		
		$this->hasOne('Country', array(
						'local' 	=> 'country_id',
						'foreign' 	=> 'id'
					)
		);
	}
}