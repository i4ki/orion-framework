<?php

/**
 * @author Tiago Moura
 * @version 1.0
 */

class CityTemplate extends Doctrine_Template 
{
	public function setTableDefinition() 
	{
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('name', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', 8);
	}
	
	public function setUp() 
	{
		$this->hasOne('StateTemplate as State', array(
						'local' => 'state_id',
						'foreign' => 'id'
					)
		);
		
		$this->hasOne('CountryTemplate as Country', array(
						'local' => 'country_id',
						'foreign' => 'id'
					)
		);
		
		$this->actAs('OrionTemplate');
	}
}