<?php

class Role extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
				'primary' => true,
				'autoincrement' => true,
				'notnull' => true
			)
		);
		
		$this->hasColumn('name', 'string', 200);
		
		$this->hasColumn('admin_id', 'integer', 8);		
		
		$this->hasColumn('description', 'string', 5000);
	}
	
	public function setUp() {
		$this->hasOne('Admin', array(
						'local' => 'admin_id',
						'foreign' => 'id'
					)
		);
		
		$this->hasMany('Resource as Resources', array(
						'local' => 'role_id',
						'foreign' => 'resource_id',
						'refClass' => 'RoleResource'
					)
		);
	}
}