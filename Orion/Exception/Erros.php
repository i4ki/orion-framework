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

class OrionException_Erros 
{
 	public $erro;
 	public $msg;
 	private $xml;
 	private $file = "erros-default.xml";

 	public function __construct($erro = NULL) 
	{
 		$this->erro = $erro;
 		$this->file = dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->file;
 	}

 	public function lerXML() 
	{
 		$this->xml = file_get_contents($this->file);
 	}
	/**
	 * Método que recupera todos os erros do XML
	 * O XML tem o seguinte formato:
	 * #########################################
	 * <erro>
	 * 		<codigo>600</codigo>
	 * 		<msg>Esta é a mensagem</msg>
	 * </erro>
	 * #########################################
	 * @return array Retorna um Array do tipó 0 => (codigo => 600, msg => 'Mensagem')
	 */
 	public function getErros() 
	{
		$erros = $this->getNode('erro');
		return $this->msg;
 	}

 	/**
	 * Método que retorna o conteudo de um Nó do XML
	 */
 	public function getNode( $node, $xml = NULL, $attr = NULL,$value = NULL, $child = NULL ) 
	{
 		$pattern = !empty($attr) ? "/\<".$node." ".$attr."=(\'|\")".$value."(\'|\")\>(.*?)\<\/".$node."\>/s" : "/\<".$node."(.*?)\>(.*?)\<\/".$node."\>/s";
 		$xml = !empty($xml) ? $xml : $this->xml;
 		$n = preg_match_all($pattern,$xml,$nodeContent);
 		$i = count($nodeContent[2]);

		if( $attr == NULL ) {
			return $nodeContent[0];
		} elseif( !empty($attr) and empty($child)) {
			return $nodeContent[0][0];
		} elseif( !empty($attr) and !empty($child)) {
			return $nodeContent[4][0];
		}
 	}

 	public function getMsg( $code ) 
	{
 		$erro = $this->getNode('erro',NULL, 'codigo',$code);
 		$this->msg = $this->getNode('msg',$erro);
 		return utf8_decode($this->msg[0]);
 	}

 }
?>

