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
class OrionArray_Raw extends OrionArray
{
	protected $arr 		= array();
	protected $output 	= array();
	private $tmp 		= array();
		
	protected $array_level = array();
	
	/**
	 * Internal representation of array
	 * e.g:
	 * $arr_internals = array(
	 * 		0	=> array(
	 *			'idx_name'	=> 'projects',
	 *			'is_array'	=> true,
	 *			'parent'	=> false,
	 *			'level'		=> 0,
	 *			'value'		=> false
	 *		),
	 *		1	=> array(
	 *			'idx_name'	=> 'name',
	 *			'is_array'	=> false,
	 *			'parent'	=> 0,
	 *			'level'		=> 1,
	 *			'value'		=> 'orion'
	 *		),
	 *		2	=> array(
	 *			'idx_name'	=> 'hostname',
	 *			'is_array'	=> false,
	 *			'parent'	=> 0,
	 *			'level'		=> 1,
	 *			'value'		=> 'localhost'
	 *		)
	 * );
	 * where 'idx_name' is the name of the key,
	 * 'is_array' indicate if the array is a array and
	 * 'parent' indicate the parent key of the array. If
	 * he has no parent then receive false.
	 *
	 * @var	array	arr_internals
	 */
	protected $arr_internals = array();
	
	protected $level = 0;
	
	public function __construct($arr)
	{
		$this->arr 				= $arr;
		
		$this->transformInInternalArray($this->arr);
	}
	
	public function next()
	{
		next($this->arr);
	}
	
	public function prev()
	{
		prev($this->arr);
	}
	
	public function rewind()
	{
		reset($this->arr);
	}
	
	public function count()
	{
		return count($this->arr);
	}
	
	public function transformInInternalArray( $arr, $parent = array())
	{
		foreach($arr as $key => $value)
		{
			if(is_array($value))
			{
				$this->arr_internals[] = array(
					'idx_name'	=> $key,
					'is_array'	=> true,
					'value'		=> false,
					'parent'	=> $parent,
					'level'		=> $this->level
				);
				$this->level++;
				$parent[] = $key;
				$this->transformInInternalArray($value, $parent);
			} else {
				$this->arr_internals[] = array(
					'idx_name'	=> $key,
					'is_array'	=> false,
					'value'		=> $value,
					'parent'	=> $parent,
					'level'		=> $this->level
				);
			}
		}
		
		$this->level--;
	}

	/**
	 * Returns all fields of array in level $level
	 * in the same structure of the input array. 
	 *
	 * @class	OrionArray_Raw
	 * @scope	public
	 * @name	getLevel
	 * @param	integer	$level
	 * @return	array
	 */
	public function getLevel($level)
	{
		$arr = array();
		
		$this->reBuildArrayTmp($level);
		
		//OrionTools_Debug::debugArray($this->tmp);
	}

		
	public function __toString()
	{
		OrionTools_Debug::debugArray($this->arr_internals);
		return "##";
	}
}