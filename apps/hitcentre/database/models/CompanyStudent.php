<?php

class CompanyStudent extends Doctrine_Record
{
	public function setTableDefinition()	
	{
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'primary'		=> true,
						'autoincrement'	=> true,
						'notnull'		=> true
						)
		);
		
		$this->hasColumn('student_id', 'integer', 8, array(
						'notnull'		=> true
						)
		);
		
		$this->hasColumn('company_id', 'integer', 8, array(
						'notnull'		=> true
						)
		);
		
		$this->hasColumn('company_position', 'string', 255);
		
		$this->hasColumn('student_email_company', 'string', 255);
	}
}