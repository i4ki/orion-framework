<?php

class CourseStudent extends Doctrine_Record
{
	public function setTableDefinition()
	{
		$this->option('charset','utf8');
		$this->option('collate','utf8_general_ci');
		
		$this->hasColumn('id', 'integer', 8, array(
						'primary'		=> true,
						'autoincrement'	=> true,
						'notnull'		=> true
						)
		);
		
		$this->hasColumn('nr_contract', 'string', 100);
		
		$this->hasColumn('date_contract', 'date');
		
		$this->hasColumn('student_id',	'integer', 8);
		
		$this->hasColumn('course_id',	'integer', 8);
		
		$this->hasColumn('course_book',	'string', 255);
		
		$this->hasColumn('appraised_for', 'string', 255);
		
		$this->hasColumn('level', 'integer', 4);
		
		/** valor pago do material */
		$this->hasColumn('pays_material', 'decimal', 18, array(
						'length'	=> 18,
						'scale'		=> 2
						)
		);
		
		/** Data do pagamento do material */
		$this->hasColumn('date_pay_material', 'date');
		
		/** valor pago por hora ou mês */
		$this->hasColumn('value_pay_per', 'decimal', 18, array(
						'length'		=> 18,
						'scale'			=> 2
						)
		);
		
		/** " pagar por " === BOOLEAN WHERE 0 == 'per_month' AND 1 == 'per_hour' */
		$this->hasColumn('pay_per', 'integer', 1);
		
		$this->hasColumn('value_total_per_month', 'decimal', 18, array(
						'length'		=> 18,
						'scale'			=> 2
						)
		);
		
		$this->hasColumn('value_registration', 'decimal', 18, array(
						'length'		=> 18,
						'scale'			=> 2
						)
		);
		
		/** Data da 1st mensalidade */
		$this->hasColumn('date_pay_first_monthly', 'date');
		
		/** qtd de horas/mes */
		$this->hasColumn('amount_hours_month', 'integer', 8);
		
		/** data de vencimento */
		$this->hasColumn('date_expire', 'date');
		
		/** observações */
		$this->hasColumn('observations', 'string', 2000);
		
	}
	
	public function setUp()
	{
		$this->hasOne('Student', array(
					'local'		=> 'student_id',
					'foreign'	=> 'id'
					)
		);
		
		$this->hasOne('Course', array(
					'local'		=> 'course_id',
					'foreign'	=> 'id'
					)
		);
	}
	
}