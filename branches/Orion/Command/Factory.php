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
 * OrionCommand_Factory
 * Factory :: Instancia as classes do Command automaticamente com base na URL
 *
 * @package     Orion
 * @subpackage	Command
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionCommand_Factory {
 	
     public function createCommand(OrionCommand_Info $info) {
     	/**
		 * Se o module e a Action não for informado, por default
		 * recebe o 'index'
		 */
     	$module = ($info->getModule() != NULL) ? $info->getModule() : 'index';
     	$action = ($info->getAction() != NULL) ? $info->getAction() : 'index';
     	$data = $info->getArray();

     	/**
		 * Passa a primeira letra para maíusculo
		 */
     	$module = htmlspecialchars(ucfirst(strtolower($module)));
     	$action = htmlspecialchars(ucfirst(strtolower($action)));

     	/**
		 * Cria o nome do arquivo que contém o command correspondente
		 */
     	$filename = 	Orion::getPathApps() . DIRECTORY_SEPARATOR . 
						Orion::getAttribute(Orion::ATTR_PROJECT) . DIRECTORY_SEPARATOR . 
						Orion::getAttribute(Orion::ATTR_DIR_COMMANDS) . DIRECTORY_SEPARATOR . 
						$module . DIRECTORY_SEPARATOR . $action . '.php';
		
     	if( !file_exists($filename) ) 
		{
     		throw new OrionException_PageNotFound(sprintf('Página não encontrada. %s', (Orion::$debugging == true ? 'File: ' . $filename .' - Modulo: '.$module.' - Action: '.$action : '')));
     	}

     	/**
		 * Inclui o arquivo
		 */
     	require_once($filename);

     	/**
		 * O nome das classes do Command por default tem o formato: MyClassCommand ou RecordCommand, TesteCommand
		 * Format: %sCommand
		 */
     	$classname = Orion::getFormatedClassCommand($action);

     	if(!class_exists($classname,false))
     	{
     		throw new Exception_PageNotFound('Classe Command não encontrada: '.$classname);
     	}

     	// Carrega e retorna a classe
     	return new $classname( $data );
     }
}