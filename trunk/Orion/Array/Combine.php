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
class OrionArray_Combine extends OrionArray
{
	protected $arr1 = array();
	protected $arr1_key = array(
		'index'		=> 0,
		'level'		=> 0
	);
	
	/**
	 * Internal representation of array
	 * e.g:
	 * $arr1_internals = array(
	 * 		0	=> array(
	 *			'idx_name'	=> 'projects',
	 *			'is_array'	=> true,
	 *			'parent'	=> false
	 *		),
	 *		1	=> array(
	 *			'idx_name'	=> 'name',
	 *			'is_array'	=> false,
	 *			'parent'	=> 0
	 *		),
	 *		2	=> array(
	 *			'idx_name'	=> 'hostname',
	 *			'is_array'	=> false,
	 *			'parent'	=> 0
	 *		)
	 * );
	 * where 'idx_name' is the name of the key,
	 * 'is_array' indicate if the array is a array and
	 * 'parent' indicate the parent key of the array, if
	 * he has no parent then receive false.
	 *
	 * @var	array	arr1_internals
	 */
	protected $arr1_internals = array();
	
	protected $arr2 = array();
	protected $arr2_key = array(
		'index'		=> 0,
		'level'		=> 0
	);
	protected $arr2_internals = array();
	
	public function __construct($arr1, $arr2)
	{
		$this->arr1 				= $arr1;
		$this->arr1_key['index']	= key($this->arr1);
		$this->arr1_key['level'] 	= 0;
		$this->arr2 				= $arr2;
		$this->arr2_key['index']	= key($this->arr2);
		$this->arr2_key['level']	= 0;
		
		$this->transformInInternalArray();
	}
	
	public function next()
	{
		next($this->arr1);
	}
	
	public function prev()
	{
		prev($this->arr1);
	}
	
	public function rewind()
	{
		reset($this->arr1);
	}
	
	public function count()
	{
		return count($this->arr1);
	}
	
	public function getMasterArray()
	{
		return $this->arr2;
	}
	
	public function getRefArray()
	{
		return $this->arr2;
	}
	
	public function getPrimaryArray()
	{
		return $this->arr1;
	}
	
	public function transformInInternalArray()
	{
		reset($this->arr1);
		$idx = array_keys($this->arr1);
		foreach($idx as $_arr_internal)
		{
			if($this->arr1
		}
		OrionTools_Debug::debugArray($idx);
		
		for($i=0;$i<count($idx);$i++)
			if(is_array($this->arr1[$idx[$i]]))
				print "is array<br>";
			else	
				print "is value<br>";
		OrionTools_Debug::debugArray(array_keys($arr));
	}
	
	private function _transformInInternalArray($arr)
	{
		
	}
	
	public function getArrayLevel()
	{
		
	}
}