<?php

/**
 * @author Tiago Moura
 * @version 1.0
 */

class City extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
							'notnull' => true,
							'primary' => true,
							'autoincrement' => true
						)
		);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('name', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', 8);
	}
	
	public function setUp() {
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
		
		$this->hasMany('User as Users', array(
						'local' => 'id',
						'foreign' => 'city_id'
					)
		);
		
		$this->hasMany('Admin as Admins', array(
						'local' => 'id',
						'foreign' => 'city_id'
					)
		);
		
		$this->hasMany('ConfigSchool as ConfigSchools', array(
						'local' 	=> 'id',
						'foreign' 	=> 'city_id'
					)
		);
		
		$this->hasMany('Company as Companies', array(
						'local' 	=> 'id',
						'foreign' 	=> 'city_id'
						)
		);
		
		$this->hasMany('Responsible as Responsibles', array(
						'local'		=> 'id',
						'foreign'	=> 'city_id'
						)
		);
		
		$this->hasMany('Student as Students', array(
						'local'		=> 'id',
						'foreign'	=> 'city_id'
						)
		);
		
		$this->hasMany('Teacher as Teachers', array(
						'local'		=> 'id',
						'foreign'	=> 'city_id'
						)
		);
	}
}