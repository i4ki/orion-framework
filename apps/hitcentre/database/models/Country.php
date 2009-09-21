<?php

/**
 * @author Tiago Moura
 * @version 1.0
 */

class Country extends Doctrine_Record {
	public function setTableDefinition() {
		
		$this->option('collate', 'utf8_general_ci');
        
		$this->option('charset', 'utf8');
        
		$this->hasColumn('iso', 'string', 2, array(
							'unique' => true
						)
		);
		
		$this->hasColumn('iso3', 'string', 3, array(
							'unique' => true
						)
		);
		
		$this->hasColumn('id', 'integer', 8, array(
							'primary' => true,
							'notnull' => true,
							'autoincrement' => false
						)
		);
		
		$this->hasColumn('name', 'string', 255);
	}
	
	public function setUp() {
		$this->hasMany('State', array(
						'local' => 'id',
						'foreign' => 'country_id'
					)
		);
		
		$this->hasMany('City as Cities', array(
						'local' => 'id',
						'foreign' => 'country_id'
					)
		);
		
		$this->hasMany('User as Users', array(
						'local' => 'id',
						'foreign' => 'country_id'
					)
		);
		
		$this->hasMany('Student as Students', array(
						'local'		=> 'id',
						'foreign'	=> 'country_id'
						)
		);
		
		$this->hasMany('Teacher as Teachers', array(
						'local'		=> 'id',
						'foreign'	=> 'country_id'
						)
		);
		
		$this->hasMany('Admin as Admins', array(
						'local' => 'id',
						'foreign' => 'country_id'
						)
		);
		
		$this->hasMany('ConfigSchool as ConfigSchools', array(
						'local' 	=> 'id',
						'foreign' 	=> 'country_id'
						)
		);
		
		$this->hasMany('Company as Companies', array(
						'local' 	=> 'id',
						'foreign' 	=> 'country_id'
						)
		);
		
		$this->hasMany('Responsible as Responsibles', array(
						'local'		=> 'id',
						'foreign'	=> 'country_id'
						)
		);
	}
}