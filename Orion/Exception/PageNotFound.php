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
 * OrionException_PageNotFound
 * Exception de página não encontrada
 * FIXME : Implantar suporte à arquivo de template para exibir a mensagem
 * Ainda somente esboço de Exception :(
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionException_PageNotFound extends Exception {
 	// Recebe obrigatoriamente a mensagem e o código do erro pode ser omitido
 	public function __construct( $mensagem, $codigo=0 ) 
	{
		if( Orion::getAttribute( Orion::ATTR_FACTORY_URL ) == Orion::ATTR_FACTORY_URL_DEFAULT )
			$info = new OrionCommand_Info_Default();
		else
			$info = new OrionCommand_Info_Rewrite();
		
		if( class_exists('Exception_'.$info->getAction().'_PageNotFound') )
		{
			$exception = 'Exception_'.$info->getAction() . '_PageNotFound'; 
			throw new $exception($mensagem, $codigo);
		}
		OrionTools_Geral::setHeader();
 		if( Orion::getAttribute(Orion::ATTR_ENV) == Orion::ATTR_ENV_DEV )
			parent::__construct( $mensagem, $codigo );
		
 	}

 	public function getMensagem() 
	{
 		return parent::getMessage();
 	}
	

 }