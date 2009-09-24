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
 * {info}
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class OrionBuilder_Interactive_Cli
{
	protected $_cli = 0;
	protected $_cli_screen_mode = 0;
	protected $_attrs = array();
		
	const ATTR_ICLI_MODE 			= 1;
	const ATTR_ICLI_MODE_NCURSES	= 2;
	
	public function __construct()
	{
		$this->_attrs[ATTR_ICLI_MODE] = ATTR_ICLI_MODE_NORMAL;
	}
	
	public function init()
	{
		/*if( function_exists('ncurses_init') )
		{
			$this->_attrs[ATTR_ICLI_MODE] = ATTR_ICLI_MODE_NCURSES;
			$this->_cli = new OrionBuilder_Interactive_NCurses();
		}
		else */$this->_cli = new OrionBuilder_Interactive_Normal();
		
		$this->_cli->presents();
		$this->_cli->mainMenu();
	}
	
	public function presents()
	{
		
	}
}