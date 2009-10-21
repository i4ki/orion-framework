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

class OrionToString
{
	public $s;
	private $nl;
	private $t;
	
	public function __construct()
	{
		$this->s 	= "";
		$this->nl 	= PHP_SAPI == "cli" ? "\n" : "<br>";
		$this->t	= PHP_SAPI == "cli" ? "\t" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	
	public static function getInstance()
	{
		return new self();
	}
	
	public function info( $msg )
	{
		$this->s .= $this->nl;
		$this->s .= $msg;
		$this->s .= $this->nl;
		return $this;
	}
	
	public function export($var, $echo = false)
	{
		if(is_array($var))
		{
			$this->s .= $this->t . "Array(".$this->nl;
			
			foreach($var as $a => $b)
				if(is_array($b))
					OrionToString::orion_export($b, false);
				else
					$this->s .= $this->t.$this->t."[".$a."]".$this->t."=> " . (is_string($b) ? "'".$b."'" : $b) . ",".$this->nl;
			$this->s = preg_replace('/\,$/','',$this->s);
			$this->s .= $this->t.");".$this->nl . $this->nl;
		}
		
		return $this;
	}
	
	public function get()
	{
		return $this->s;
	}
}