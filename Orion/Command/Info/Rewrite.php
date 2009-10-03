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
 * OrionCommand_Info_Rewrite
 * Factory :: URL_FRIENDLY
 *
 * @package     Orion
 * @subpackage	Command
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */
 
class OrionCommand_Info_Rewrite implements OrionCommand_Info {

    private $gets;
	
    public function __construct() {
					
		$this->gets = OrionKernel::$organizer->getModuleAction();
		
        //OrionTools_Debug::debugArray($this->gets, true, true, true, true);
        /**
         * Retira a sintax maliciosa
         */
       $this->gets = OrionSecurity_Secure::URLSecure( $this->gets );
	   
    }

	/**
	 * Retorna a primeira parte da URL
	 * A do Module
	 *
	 * @return String - Retorna o module usado
	 */
    public function getModule() {
        return !empty($this->gets[0]) ? $this->gets[0] : false;
    }
    /**
     * Retorna a segunda parte da URL
     * como uma String
     *
     * @return String
     */
    public function getAction() {
        return isset($this->gets[1]) ? $this->gets[1] : '';
    }
    /**
     * Retorna o terceiro item da URL que costuma ser
     * um dado do tipo DATA
     *
     * @return String - String do Data
     */
    public function getData() {
    	return $this->gets[2];
    }

    /**
     * Retorna todos as variáveis da URL num array
     * @param
     * @return Array  - Array de Variáveis da URL
     */
     public function getArray() {
     	return $this->gets;
     }

     /**
      * Retorna o item específico do array pelo indice especificado no
      * parâmetro.
      * @param string
      * @return string  -  String com a informação do indice espcificado por $ind
      */
      public function getVarByIndex( $ind ) {
      	return $this->gets[$ind];
      }
      
      public function getArrayToLower() {
      	return array_map('strtolower',$this->gets);
      }

}