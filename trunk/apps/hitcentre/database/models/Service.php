<?php

class Service extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
							'primary' => true,
							'autoincrement' => true,
							'notnull' => true
						)
		);
		
		$this->hasColumn('name', 'string', 255);
	}
	
	public function setUp() {
				
		$this->hasMany('Resource as Resources', array(
						'local' => 'id',
						'foreign' => 'service_id'
					)
		);
	}
}