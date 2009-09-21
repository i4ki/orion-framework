<?php

class Flag extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('name', 'string', 255, array(
							'unique' => true
						)
		);
		
		$this->hasColumn('resource_id', 'integer');
	}
	
	public function setUp() {
		$this->hasMany('User as Users', array(
						'local' => 'id',
						'foreign' => 'flag_id'
					)
		);
		
		$this->hasOne('Resource as Resources', array(
						'local' => 'resource_id',
						'foreign' => 'id'
					)
		);
	}
}