<?php
/*
    This library is free software; you can redistribute it and/or
    modify it under the terms of the GNU Library General Public
    License version 2 as published by the Free Software Foundation.

    This library is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    Library General Public License for more details.

    You should have received a copy of the GNU Library General Public License
    along with this library; see the file COPYING.LIB.  If not, write to
    the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
    Boston, MA 02110-1301, USA.

    ---
    Copyright (C) 2009, Tiago Natel de Moura tiago_moura@live.com
*/

/**
 * Orion
 * ObjectModel Address
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */
class AddressTemplate extends Doctrine_Template
{
	public function setTableDefinition()
	{
		$this->hasColumn('address', 'string', 255);
		
		$this->hasColumn('number', 'integer', 6);
		
		$this->hasColumn('complement', 'string', 255);
		
		$this->hasColumn('district', 'string', 255);
		
		$this->hasColumn('country_id', 'integer', 8);
		
		$this->hasColumn('state_id', 'integer', 8);
		
		$this->hasColumn('city_id', 'integer', 8);
		
		$this->hasColumn('zip', 'string', 100);
	}
	
	public function setUp()
	{
		$this->hasOne('CountryTemplate as Country', array(
						'local'		=> 'country_id',
						'foreign'	=> 'id'
					)
		);
		
		$this->hasOne('StateTemplate as State', array(
						'local'		=> 'state_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->hasOne('CityTemplate as City', array(
						'local'		=> 'city_id',
						'foreign'	=> 'id'
					)
		);
		
		$this->hasMany('PersonTemplate as Persons', array(
						'local'		=> 'id',
						'foreign'	=> 'address_id'
					)
		);
		
		$this->actAs('OrionTemplate');
	}
}