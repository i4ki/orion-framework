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

 abstract class OrionCommand implements OrionICommand
 {
	protected $orm	= 0;
	
	public function __construct()
	{
	
	}
		
	public function __call( $method, $args )
	{
		if( preg_match('/^getInstanceOf/', $method ) )
		{
			$method = preg_replace('/^getInstanceOf/', '', $method);
			$class = $method;
			
			if(class_exists($class))
			{
				$methods_of_class = get_class_methods($class);
				foreach($methods_of_class as $method)
					if($method == 'getInstance')
						$obj = call_user_func(array($class, $method));
				if(!$obj)
					$obj = new $class;
				return $obj;
			} else return false;
		}
	}
 }