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
 * OrionIterator
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionIterator implements Iterator
 {
	private $prop = array();
	
	public function __construct( $array )
	{
		if	(is_array($array))
			$this->prop	= $array;
			
	}
	
	public function rewind()
	{
		reset($this->prop);
		return $this->prop;
	}
	
	public function current()
	{
		return current($this->prop);
	}
	
	public function key()
	{
		return key($this->prop);
	}
	
	public function next()
	{
		return next($this->prop);
	}
	
	public function prev()
	{
		return prev($this->prop);
	}
	
	public function valid()
	{
		return ($this->current() === true);
	}
	
	public function push( $var )
	{
		if(is_array($var))
			foreach($var as $value)
				$this->prop[] = $value;
		else
			$this->prop[] = $var;
			
		return $this->prop;
	}
	
	public function pop()
	{
		array_pop($this->prop);
		return $this->prop;
	}
	
	public function shift()
	{
		array_shift($this->prop);
		return $this->prop;
	}
	
	public function unshift( $var )
	{
		if(is_array($var))
			foreach($var as $value)
				array_unshift($this->prop, $value);
		else
			array_unshift($this->prop, $var);
		
		return $this->prop;
	}
	
	public function unique()
	{
		array_unique($this->prop);
		return $this->prop;
	}
	
	
 }