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

 class OrionBuilder_Html extends OrionBuilder
 {
	private	$file;
	public 	$head;
	public 	$body;
	
	public function __construct( $html = false )
	{
		if(!empty($html))
		{
			$this->file = $html;
			$this->openHtml();
		}
	}
	
	public function openHtml()
	{
		$fp = fopen($this->file, 'r');
		$str = "";
		while(!feof($fp))
			$str .= fgets($fp, 1024);
		
		return $str;
	
	}
	
	public function generateSkel( $vars = array() )
	{
		$this->file = array();
		$this->file[]	= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		$this->file[]	= "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"pt-BR\" lang=\"pt-BR\">";
		$this->file[]	= "<html>";
		$this->file[]	= "<head>";
		$this->file[]	= "<title>" . !empty($vars['title']) ? $vars['title'] : 'Página não encontrada.' . "</title>";
		$this->file[]	= $this->head;
		$this->file[]	= "</head>";
		$this->file[]	= "<body>";
		$this->file[]	= $this->body;
		$this->file[]	= "</body>";
		$this->file[]	= "</html>";
		
		$src = implode("\n", $this->file);
		
		return $src;		
	}
 }