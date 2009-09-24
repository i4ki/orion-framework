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
 * OrionTools_Debug
 * Ferramentas de debug
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */


/** 
 * Esta classe possui métodos de auxílio no debug da aplicação
 * Ela ainda necessita que chame os métodos para debugar manualmente.
 * 
 * Pode se debugar Arrays, Objetos, Strings, etc, o retorno destes 
 * métodos já é a saída padrão!!!
 * 
 * Se deseja debugar um array use debugArray(), caso seja um objeto use debugObject()
 *
 */

class OrionTools_Debug {
	public function __construct() {
		/**
		 * Costrutor --> classe estática
		 */
	}
	
	public static function dumpVar( $var ) {
		print "<pre>";
		var_dump($var);
		print "</pre>";
	}
	
	public static function debugArray( $arr, $dump = false, $name = false, $exit = false ) {
		
		print "<br><br>###!&gt; Debugando array ".$name;
		
		print "<pre>";
		print_r($arr);
		print "</pre>";
		if ( $dump == true ) {
			print "<br />";
			print "DUMP DO ARRAY";
			print "<br />";
			OrionTools_Debug::dumpVar($arr);
		}
		
		print "&lt;!###<br><br><br>";
		if ($exit != false) {
			exit();
		}
		return;						
	}
	
	public static function debugBoolean( $bool, $dump = false ) {
		print "BOOLEAN: <br />";
		print "Value: " . (( $bool === true) ? "TRUE" : "FALSE");
		if( $dump == true ) {
			Tools_Debug::dumpVar($bool);
		}
	}
	
	/**
	 * Método debug, por default ele é desativado dãã
	 *
	 * @param array $opt
	 */
	public static function debugInit( $opt ) {
		print "###> File: ".$opt[0]."<br>";
			print "##-> Class ".$opt[1]."<br>";
			print "#--> Linha: ".$opt[2]."<br>";
			print "--->-------------------------------------------><br>";
	}
	
	public static function debugEnd() {
			print "#--><br>";
			print "##-><br>";
			print "###><br>";
			print "--->-------------------------------------------><br><br><br>";
	}
	
	/**
	 * Debug um statement if
	 * $arr é um array em que:
	 * $arr[0] == variável comparada
	 * $arr[1] == valor a comparar
	 *
	 * @param array $arr
	 * @param boolean $neg
	 */
	public static function debugIfCompare( $arr, $neg = false ) {
		print ":: IF COMPARE STATEMENT :: Verificando ".$arr[0]."<br>";
		if ($arr[0] == $arr[1]) {
			print ":: ".$arr[0]." === ".$arr[1]." ::<br>";
			if ($neg !== true) {
				Tools_Debug::printState();
			} else Tools_Debug::printState(false);
		} else {
			print ":: ".$arr[0]." !== ".$arr[1]." ::<br>";
			if ($neg !== true) {
				Tools_Debug::printState(false);
			} else Tools_Debug::printState();
		}
	}
	
	/**
	 * Debug if exists variable
	 *
	 * @param array $arr
	 * @param boolean $neg
	 */
	public static function debugIfExists( $arr, $neg = false ) {
		print ":: IF EXISTS ".$arr['var']."<br>";
		if (isset( $arr['value'] ) === true ) {
			if ( $neg !== true ) {
				print ":: ".$arr['var']." exists!<br>";
				Tools_Debug::printState();
			} else {
				Tools_Debug::printState(false);
			}
		} else {
			if ( $neg !== true ) {
				print ":: ".$arr['var']." not exists!<br>";
				Tools_Debug::printState(false);
			} else Tools_Debug::printState(true);
		}
		
		return true;
	}
	
	public static function printState( $success = true ) {
		if ( $success === true ) {
			print ":: <span style=\"color: green;\">SUCCESS</span><br>";
		} else {
			print ":: <span style=\"color: red;\">ERROR</span><br>";
		}
		return true;
	}
}