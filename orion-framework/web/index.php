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
 * index.php
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */
 
 /**
  * Este é o arquivo com a classe principal do Orion, faz-se necessário
  * incluí-lo manualmente.
  */
 require_once('../Orion.php');
 
 /**
  * A classe Orion usa do design pattern singleton, portanto não se deve instanciá-la com "new".
  * Para iniciar ela, pegue uma instancia no método Orion::getInstance();
  * Ao pegar a instancia, o Orion automaticamente ajustará suas configurações padrões,
  * para alterar qualquer uma destas configurações, você pode passar um array com as novas
  * configurações para o método Orion::init() ou ajustar no arquivo de configuração config.yml
  */
  
  try {
	
	/**
	 * Biblioteca externa que necessita de autoload
	 */
	 $config = array(
		'project'	=> 'hitcentre'
		);
	
	$orion = 	Orion::getInstance()
				->init( $config );
 
	} catch( OrionException_PageNotFound $e )
	{
		if(Orion::getAttribute(Orion::ATTR_ENV) == Orion::ATTR_ENV_DEV)
		{
			print "Erro: " . $e->getMessage() . "<br>";
			print $e->getTraceAsString();
		} 
	} catch (Doctrine_Connection_Exception $e)
	{
		if(OrionMagic::getEnvironment() == Orion::ATTR_ENV_DEV)
		{
			print "Houve um erro na Query DQL<br>";
			print "Mensagem portável: " . $e->getPortableMessage() . "<br>";
			print "Código portável: " . $e->getPortableCode() . "<br>";
			print "Mensagem do banco: " . $e->getMessage() . "<br>";
			print "Cod.: " . $e->getCode() . "<br>";
		}
	}
 /**
  * ^ ^
  */