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
 * OrionTools_Functions
 * Classe com funções muito necessárias
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class OrionTools_Functions {
	
	public function __construct() {
		/** TODO : Other BlackHole */
		throw new OrionException(sprintf("A classe %s é estática e não deve ser instanciada.",get_class(self)));
	}	
	
	/**
	 * Método que trabalha como array_map mas que possibilita referenciar um método de uma classe
	 * Created by henrique@webcoder.com.br
	 */
  	public static function array_map_r( $func, $arr )
	{
   		$newArr = array();

    	foreach( $arr as $key => $value )
    	{
        	$newArr[ $key ] = ( is_array( $value ) ? Tools_Functions::array_map_r( $func, $value ) : ( is_array($func) ? call_user_func_array($func, array($value)) : $func( $value ) ) );
    	}

    	return $newArr;
	}
	
	/**
	 * Diminui o grau de um array
	 */
	public static function downArray( $arr ) 
	{
		return isset($arr[0]) ? $arr[0] : $arr;
	}
	
	/**
	 * Cria um diretório e ajusta a permissão
	 */
	public static function mkDir( $dir, $mod = 0777)
	{
		print $dir;
		mkdir($dir);
		chmod($dir, $mod);
		return $this;
	}	
}