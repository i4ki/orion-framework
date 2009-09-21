<?php

/**
 * Model Admin
 * @author  Tiago Moura
 * @module 	Doctrine
 *  
 */
class Admin extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'type' => 'integer',
						'autoincrement' => true,
						'notnull' => true,
						'primary' => true
						)
		);
		
		$this->hasColumn('username', 'string', 200, array(
						'unique' => true,
						'notnull' => true
						)
		);
		
		$this->hasColumn('password', 'string', 32, array(
						'notnull' => true
						)
		);
		
		$this->hasColumn('firstname', 'string', 200, array(
						'notnull' => true
						)
		);
		
		$this->hasColumn('lastname', 'string', 200);
		
		$this->hasColumn('email', 'string', 200, array(
						'notnull' => true
						)
		);
		
		$this->hasColumn('street', 'string', 255);
		
		$this->hasColumn('district', 'string', 255);
		
		$this->hasColumn('city_id', 'integer', 8);
		
		$this->hasColumn('city_foreign', 'string', 255);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('state_foreign', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', 8);
		
		$this->hasColumn('cep', 'string', 9);
		
		$this->hasColumn('tel_res', 'string', 32);
		
		$this->hasColumn('tel_cel', 'string', 32);
		
		$this->hasColumn('imagem', 'string', 200);
		
		$this->hasColumn('last_login','timestamp');
	}
	
	public function setUp() {
		$this->hasOne('City', array(
						'local' => 'city_id',
						'foreign' => 'id'
					)
		);
		
		$this->hasOne('State', array(
						'local' => 'state_id',
						'foreign' => 'id'
					)
		);
		
		$this->hasOne('Country', array(
						'local' => 'country_id',
						'foreign' => 'id'
					)
		);
		
		$this->hasMany('Group as Groups', array(
						'local' => 'id',
						'foreign' => 'admin_id'
						)
		);
		
		$this->hasMany('Role as Roles', array(
						'local' => 'id',
						'foreign' => 'admin_id'
						)
		);
		
		$this->actAs('Timestampable');
	}
}