<?php

class Group extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('groups');
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('name', 'string', 255, array(
							'unique' => true
						)
		);
		
		$this->hasColumn('description', 'string', 500);
		
		$this->hasColumn('admin_id', 'integer', null);
		
		$this->hasColumn('role_id', 'integer', null);
	}
	
	public function setUp() {
		$this->hasMany('User as Users', array(
						'local' => 'id',
						'foreign' => 'group_id'
					)
		);
		
		$this->hasOne('Role', array(
						'local' => 'role_id',
						'foreign' => 'id'
					)
		);
		
		$this->hasOne('Admin', array(
						'local' => 'admin_id',
						'foreign' => 'id'
					)
		);
		
		$this->actAs('Timestampable');
	}
}