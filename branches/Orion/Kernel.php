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
 * Kernel do Orion - Núcleo
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class OrionKernel
{
	/**
	 * Parametros de ambiente
	 * @scope public
	 * @static
	 * @var 	OBJECT	$_env
	 */
	public static $_env;
	
	/**
	 * @scope	protected
	 * @var 	OBJECT	$_config
	 */
	protected $_config 		= 0;
	
	/**
	 * @scope protected
	 * @var 	OBJECT	$commandInfo
	 */
	protected $_commandInfo = 0;

	/**
	 * @scope	protected
	 * @var 	OBJECT 	$_factory
	 */
	protected $_factory 	= 0;

	private function __construct()
	{
		/** 
		 * TODO : A great center BlackHole **
		 * I believe that in the center of Orion there is a great blackhole.
		 * What do you find ??
		 */
	}

	public static function getInstance()
	{
		static $_instance;
		if( ! isset($_instance) )
			return new self();

		return $_instance;
	}
	
	public function getStaticInstances()
	{
		self::$_env = OrionCommand_Settings_Environment::getInstance();
	}

	/**
	 * @class	Orion
	 * @scope	public
	 * @name	init
	 * @param	void
	 * @return	OBJECT
	 */
	public function init()
	{
		$this->_init();
		/**
		 * TODO : Inclui o arquivo do Command e instancia a classe correspondente
		 */
		$_factory = new OrionCommand_Factory();
		$_factory	->createCommand($this->configCommand())
					->execute();
		return $this;
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	_init
	 * @param	void
	 * @return	OBJECT
	 */
	private function _init()
	{
		self::checkPermissions();
		return $this;
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	checkPermissions
	 * @param	void
	 * @return	OBJECT
	 */
	public static function checkPermissions()
	{
		$dirs = array(
			Orion::getAttribute(Orion::ATTR_DIR_LOGS),
			Orion::getAttribute(Orion::ATTR_DIR_CACHE),
			Orion::getAttribute(Orion::ATTR_DIR_TEMP)
		);
		
		foreach( $dirs as $dir )
		{
			if(!preg_match('/^\//', $dir))
				$dir = Orion::getPathOrion() . DIRECTORY_SEPARATOR . $dir;
			if(!is_writable($dir))
				throw new OrionException(sprintf("O arquivo %s deve ter permissão de escrita.", $dir));
		}
		return true;	
	}

	/**
	 * @class 	OrionKernel
	 * @name 	configCommand
	 * @scope	protected
	 * @param	void
	 * @return	BOOLEAN
	 */
	protected function configCommand()
	{
		if (self::$_env->_attributes[Orion::ATTR_FACTORY_URL] == Orion::ATTR_FACTORY_URL_FRIENDLY)
			$this->commandInfo = new OrionCommand_Info_Rewrite();
		elseif (self::$_env->_attributes[Orion::ATTR_FACTORY_URL] == Orion::ATTR_FACTORY_URL_DEFAULT)
			$this->commandInfo = new OrionCommand_Info_Default();
		else 
			throw new OrionException("Ajuste corretamente o sistema de URL'");

		return $this->commandInfo;
	}

	/**
	 * Retorna as configurações do Command
	 * @class 	OrionKernel
	 * @name 	getCommandInfo
	 * @scope 	public
	 * @param	void
	 * @return	OBJECT	self::commandInfo
	 */
	public function getCommandInfo()
	{
		return $this->commandInfo;
	}

	/**
	 * Retorna as configurações
	 * @class 	OrionKernel
	 * @name 	getCommandInfo
	 * @scope 	public
	 * @param	void
	 * @return	OBJECT	self::commandInfo
	 */
	public function getAttributesAsString()
	{
		$attr = '';
		foreach(self::$_env->_attributes as $key => $value)
			$attr .= $key . "\t" . $value . "\n";
		
		return $attr;
	}
}
