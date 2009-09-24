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
 * ObjectModel PersonTemplate
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class PersonTemplate extends Doctrine_Template
{
	public function setTableDefinition()
	{
		$this->hasColumn('firstname', 'string', 255);
		
		$this->hasColumn('lastname', 'string', 255);
		
		$this->hasColumn('address_id', 'integer');
		
		$this->hasColumn('tel', 'string', 32);
		
		$this->hasColumn('cel', 'string', 32);
	}
	
	public function setUp()
	{
		$this->hasOne('AddressTemplate as Address', array(
						'local'		=> 'address_id',
						'foreign'	=> 'id'
						)
		);
		
		$this->actAs('OrionTemplate');
	}
}