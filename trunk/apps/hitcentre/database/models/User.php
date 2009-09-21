<?php

/**
 * Classe Usuario
 * @author Tiago Moura
 * @version 1.0
 */ 
class User extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		/**
		 * Dados de Acesso
		 * password será automaticamente convertido num hash
		 */
		$this->hasColumn('username', 'string', 200, array(
							'unique' => true,
							'notnull' => true
						)
		);
		
		$this->hasColumn('password', 'string', '32');
		
		/**
		 * Dados pessoais
		 */		
		$this->hasColumn('firstname', 'string', 255, array(
							'notnull' => true
						)
		);
		
		$this->hasColumn('lastname', 'string', 255);
		
		$this->hasColumn('email', 'string', 255, array(
						'notnull' => true
						)
		);
		
		$this->hasColumn('street', 'string', 255);
		
		$this->hasColumn('district', 'string', 255);
		
		$this->hasColumn('city_id', 'integer', 8);
		
		$this->hasColumn('city_foreign', 'string', 255);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('state_foreign', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', null);
		
		$this->hasColumn('cep', 'string', 9);
		
		$this->hasColumn('tel_res', 'string', 32);
		
		$this->hasColumn('tel_cel', 'string', 32);
		
		$this->hasColumn('imagem', 'string', 200);
		
		$this->hasColumn('last_login', 'timestamp');
		
		$this->hasColumn('last_iteration', 'timestamp');
		
		/**
		 * Permissões
		 */
		$this->hasColumn('group_id', 'integer', null, array(
							'notnull' => true
						)
		);
		
		$this->hasColumn('flag_id', 'integer', null);
				
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
		
		$this->hasOne('Group', array(
						'local' => 'group_id',
						'foreign' => 'id'
					)
		);
		
		$this->hasOne('Flag', array(
						'local' => 'flag_id',
						'foreign' => 'id'
					)
		);
		
		$this->actAs('Timestampable');
		
		$this->hasMutator('password', 'setPassword');
	}
	
		/**
	 * Cria o hash da senha automaticamente
	 */
	
	public function setPassword( $password ) 
	{
		if( class_exists('Config') )
			$this->_set('password', md5($password . Config::encryptPass()) );
		else
			$this->_set('password', $password);
	}
}