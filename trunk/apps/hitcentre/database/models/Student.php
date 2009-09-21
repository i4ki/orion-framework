<?php

class Student extends Doctrine_Record {
	public function setTableDefinition() {
	
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id','integer',8,array(
							'primary'		=> true,
							'notnull'		=> true,
							'autoincrement'	=> true
						)
		);
		
		$this->hasColumn('firstname','string',255);
		
		$this->hasColumn('lastname','string', 255);
		
		$this->hasColumn('cpf','string',14);
		
		$this->hasColumn('rg','string',15);
		
		$this->hasColumn('gradeschool_id', 'integer', 8);
		
		$this->hasColumn('civilstatus_id','integer',8);
		
		$this->hasColumn('email_part', 'string', 255);
		
		$this->hasColumn('birthday','date');
		
		$this->hasColumn('tel_res','string',100);
		
		$this->hasColumn('tel_cel','string',100);
		
		$this->hasColumn('nationality','string',100);
		
		/**
		 * I'm the responsible?
		 */
		$this->hasColumn('i_resp', 'integer', 1);
		
		/**
		 * Foreign key for Responsible
		 */
		$this->hasColumn('responsible_id','integer',8);
		
		/**
		 * Foreign key for Pedagogic class
		 */
		$this->hasColumn('pedagogic_id','integer',8);
		
		$this->hasColumn('company_id', 'integer', 8);
		
		/**
		 * TODO : "addr_corresp" receive a value BOOLEAN that indicates
		 * where should be given the student's correspondences.
		 * 0 indicate in house and
		 * 1 indicate in work.
		 */
		$this->hasColumn('addr_corresp', 'integer', 1);
		
		$this->hasColumn('country_id','integer',8);
		
		$this->hasColumn('address','string',255);
		
		$this->hasColumn('number', 'string', 8);
		
		$this->hasColumn('complement', 'string', 255);
		
		$this->hasColumn('district','string',255);
		
		$this->hasColumn('state_id','integer',8);
		
		$this->hasColumn('state_foreign','string',255);
		
		$this->hasColumn('city_id','integer',8);
		
		$this->hasColumn('city_foreign','string',255);
		
		$this->hasColumn('cep', 'string', 10);
	}
	
	public function setUp()
	{
		$this->hasOne('City', array(
						'local'		=> 'city_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('State', array(
						'local'		=> 'state_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('Country', array(
						'local'		=> 'country_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('PedagogicStudent', array(
						'local'		=> 'pedagogic_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('RespRel', array(
						'local'		=> 'responsible_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('Company', array(
						'local'		=> 'company_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('CivilStatus', array(
						'local'		=> 'civilstatus_id',
						'foreign'	=> 'id'
					)
		);
		
		$this->hasOne('GradeSchool', array(
						'local'		=> 'gradeschool_id',
						'foreign'	=> 'id'
					)
		);
		
		$this->hasMany('CourseStudent', array(
						'local'		=> 'id',
						'foreign'	=> 'student_id'
						)
		);
		
		$this->actAs('Timestampable');
		
	}

}