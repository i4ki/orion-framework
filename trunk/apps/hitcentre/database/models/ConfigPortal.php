<?php

/**
 * @author Tiago natel de Moura
 * @package DIR_DOCTRINE/models/ConfigPortal.php
 */

class ConfigPortal extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id','integer',4,array(
							'autoincrement' => true,
							'notnull' => true,
							'primary' => true
						)
		);
		
		$this->hasColumn('domain','string',255,array(
							'notnull' => true
						)
		);
		
		$this->hasColumn('default_title','string',255);
		
		$this->hasColumn('meta_description','string',500);
		
		$this->hasColumn('meta_keywords','string',500);
		
		$this->hasColumn('approve_profile','integer',1);
		
		$this->hasColumn('auth_email','integer', 1);
		
		$this->hasColumn('smtp_email','string', 255);
		
		$this->hasColumn('port_email', 'integer', 8);
		
		$this->hasColumn('user_email','string', 255);
		
		$this->hasColumn('pass_email','string', 255);
		
		$this->hasColumn('allow_ssl','integer', 1);
		
		$this->hasColumn('allow_logs','integer', 1);
		
		$this->hasColumn('login_admin','string',200);		
	}
	
	public function setUp() {
		
	}
}