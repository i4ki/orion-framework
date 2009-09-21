<?php

class Resource extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'primary' => true,
						'notnull' => true,
						'autoincrement' => true
						)
		);
		
		$this->hasColumn('name', 'string', 200);
		
		$this->hasColumn('service_id', 'integer', null);
	}
	
	public function setUp() {
		$this->hasOne('Service', array(
					'local' => 'service_id',
					'foreign' => 'id'
					)
		);
		
		$this->hasMany('Role as Roles', array(
						'local' => 'resource_id',
						'foreign' => 'role_id',
						'refClass' => 'RoleResource'
					)
		);
		
		$this->hasMany('Flag as Flags', array(
						'local' => 'id',
						'resource_id'
					)
		);
	}
}