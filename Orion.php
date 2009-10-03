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
 * Base do Orion - Faz a comunicação entre o cliente e o Kernel
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */
final class Orion
{
	const VERSION					= 0.3;
	const SITE						= 'www.orion-framework.org';
	const AUTHOR_EMAIL				= 'tiago_moura@live.com';
	
	/**
	 * Constantes de configuração
	 */
	const ATTR_PROJECT				= 0;
	const ATTR_URL_MODE				= 1;
	const ATTR_URL_MODE_DEFAULT		= 2;
	const ATTR_URL_MODE_REWRITE		= 3;
	const ATTR_CHARSET_HTML			= 4;
	const ATTR_HOST					= 5;
	const ATTR_ENV					= 6;
	const ATTR_ENV_DEV				= 7;
	const ATTR_ENV_TEST				= 8;
	const ATTR_ENV_PROD				= 9;
	const ATTR_SPECIAL_ULTIMATE_X9	= 10;
	const ATTR_LANG					= 11;
	const ATTR_SOBRA2				= 12;
	const ATTR_SOBRA3				= 13;
	const ATTR_SOBRA4				= 14;
	
	/**
	 * Formato de Classes
	 */
	 
	/**
	 * Formata as classes do Command
	 * por default elas tem o formato: %sCommand
	 * onde %s indica uma string que deverá ser a Action pega da url
	 * Você pode formatar como desejar, para isso use:
	 * $orion->setAttribute(Orion::ATTR_FORMAT_CLASS_COMMAND, "%sMyClassCommand"); ou
	 * $orion->setAttribute('format_class_command', "MyOtherClass%s"); ou
	 * $orion->setAttribute('format_command', "MyClass%sCommand");
	 * @scope constant
	 * @var	integer		ATTR_FORMAT_CLASS_COMMAND
	 */
	const ATTR_FORMAT_CLASS_COMMAND	= 15;
	
	/**
	 * Constantes de BD
	 */
	const ATTR_ORM					= 50;
	const ATTR_ALGO					= 51;
	const ATTR_HOST_DB_DEV			= 52;
	const ATTR_HOST_DB_TEST			= 53;
	const ATTR_HOST_DB_PROD			= 54;
	const ATTR_USER_DB_DEV			= 55;
	const ATTR_USER_DB_TEST			= 56;
	const ATTR_USER_DB_PROD			= 57;
	const ATTR_PASS_DB_DEV			= 58;
	const ATTR_PASS_DB_TEST			= 59;
	const ATTR_PASS_DB_PROD			= 60;
	const ATTR_ADAPTER_DEV			= 61;
	const ATTR_ADAPTER_TEST			= 62;
	const ATTR_ADAPTER_PROD			= 63;
	const ATTR_CHARSET_DB_DEV		= 64;
	const ATTR_CHARSET_DB_TEST		= 65;
	const ATTR_CHARSET_DB_PROD		= 66;
	const ATTR_COLLATE_DB_DEV		= 67;
	const ATTR_COLLATE_DB_TEST		= 68;
	const ATTR_COLLATE_DB_PROD		= 69;
	const ATTR_DATABASE_DEV			= 70;
	const ATTR_DATABASE_TEST		= 71;
	const ATTR_DATABASE_PROD		= 72;
	const ATTR_ORM_LIB				= 73;
	const ATTR_ORM_CLASS			= 74;
	const ATTR_ORM_AUTOLOAD			= 75;
	const ATTR_ADAPTER_ENGINE_DEV	= 76;
	const ATTR_ADAPTER_ENGINE_TEST	= 77;
	const ATTR_ADAPTER_ENGINE_PROD	= 78;
	
	/**
	 * Constantes da VIEW
	 */
	const ATTR_VIEW_TEMPLATE_LIB	= 90;
	const ATTR_VIEW_TEMPLATE_CLASS	= 91;
	const ATTR_VIEW_TEMPLATE_AUTOLOAD= 92;
	const ATTR_VIEW_PAGE_401		= 93;
	const ATTR_VIEW_PAGE_402		= 94;
	const ATTR_VIEW_PAGE_403		= 95;
	const ATTR_VIEW_PAGE_404		= 96;
	
	/**
	 * Constantes de diretórios
	 */
	const ATTR_DIR_LIBS				= 101;
	/**
	 * @var 	ATTR_DIR_APPS
	 * @deprecated
	 * @see 	Orion::ATTR_DIR_PROJECT
	 */
	const ATTR_DIR_APPS				= 102;
	const ATTR_DIR_LOGS				= 103;
	const ATTR_DIR_VIEW				= 104;
	const ATTR_DIR_PROJECT			= 105;
	const ATTR_DIR_COMMANDS			= 106;
	const ATTR_DIR_DATABASE			= 107;
	const ATTR_DIR_SCRIPTS			= 108;
	const ATTR_DIR_TESTS			= 109;
	const ATTR_DIR_CACHE			= 110;
	const ATTR_DIR_TEMP				= 111;
	const ATTR_DIR_CACHE_HTML		= 112;
	const ATTR_DIR_UNIVERSE			= 113;
	
	
	const ATTR_DEBUG				= 120;
	
	/**
	 * Constante => String
	 * @var array	$_const_string
	 * @deprecated 	Problems with performance
	 */
	public static $_const_string = array(
		'factory_url'			=> 'ATTR_FACTORY_URL',
		'default'				=> 'ATTR_FACTORY_URL_DEFAULT',
		'friendly'				=> 'ATTR_FACTORY_URL_FRIENDLY',
		'environment'			=> 'ATTR_ENV',
		'env'					=> 'ATTR_ENV',
		'development'			=> 'ATTR_ENV_DEV',
		'test'					=> 'ATTR_ENV_TEST',
		'production'			=> 'ATTR_ENV_PROD',
		'crud_c'				=> 'ATTR_CRUD_C',
		'crud_r'				=> 'ATTR_CRUD_R',
		'crud_r'				=> 'ATTR_CRUD_R',
		'crud_d'				=> 'ATTR_CRUD_D',
		'format_command'		=> 'ATTR_FORMAT_CLASS_COMMAND',
		'format_class_command'	=> 'ATTR_FORMAT_CLASS_COMMAND',
		'charset_html'			=> 'ATTR_CHARSET_HTML',
		'charset_db_dev'		=> 'ATTR_CHARSET_DB_DEV',
		'charset_db_test'		=> 'ATTR_CHARSET_DB_TEST',
		'charset_db_prod'		=> 'ATTR_CHARSET_DB_PROD',
		'collate_db_dev'		=> 'ATTR_COLLATE_DB_DEV',
		'collate_db_test'		=> 'ATTR_COLLATE_DB_TEST',
		'collate_db_prod'		=> 'ATTR_COLLATE_DB_PROD',
		'host_db_dev'			=> 'ATTR_HOST_DB_DEV',
		'host_db_test'			=> 'ATTR_HOST_DB_TEST',
		'host_db_prod'			=> 'ATTR_HOST_DB_PROD',
		'user_db_dev'			=> 'ATTR_USER_DB_DEV',
		'user_db_test'			=> 'ATTR_USER_DB_TEST',
		'user_db_prod'			=> 'ATTR_USER_DB_PROD',
		'pass_db_dev'			=> 'ATTR_PASS_DB_DEV',
		'pass_db_test'			=> 'ATTR_PASS_DB_TEST',
		'pass_db_prod'			=> 'ATTR_PASS_DB_PROD',
		'database_dev'			=> 'ATTR_DATABASE_DEV',
		'database_test'			=> 'ATTR_DATABASE_TEST',
		'database_prod'			=> 'ATTR_DATABASE_PROD',
		'adapter_dev'			=> 'ATTR_ADAPTER_DEV',
		'adapter_test'			=> 'ATTR_ADAPTER_TEST',
		'adapter_prod'			=> 'ATTR_ADAPTER_PROD',
		'adapter_engine_dev'	=> 'ATTR_ADAPTER_ENGINE_DEV',
		'adapter_engine_test'	=> 'ATTR_ADAPTER_ENGINE_TEST',
		'adapter_engine_prod'	=> 'ATTR_ADAPTER_ENGINE_PROD',
		'project'				=> 'ATTR_PROJECT'
	);
	
	/**
	 * Configurações padrão
	 * @var 	array 	$_defaults
	 */
	public $_defaults = array();
	
	/**
	 * Indica se as configurações já foram ajustadas
	 * @var 	BOOLEAN		$_already_init
	 */
	static $_already_init = false;
	
	private static $_path;
	
	/**
	 * Static instance of the nebula.
	 * Care, because there blackholes exist. 
	 * @var		OBJECT	$_kern
	 * @scope	static
	 */
	public static $_kern;
	
	public $organizer;
	
	/**
	 * Debugging ??
	 * Isto ainda não foi implementado, mas será de uma maneira 
	 * totalmente diferente aos debug que vemos por aí.
	 * Encher o código de IF's para o debug compromete seriamente a performance
	 * dos métodos, sem dizer que o código fica horrivel.
	 * Esta sendo desenvolvido de um modo que quando quisermos debugar a aplicação
	 * bastará rodar um script na linha de comando (# debug -x Orion.php), para 
	 * substituir no source alguns comentários chave pelo código do debug.
	 * Para retirar o código do debug?? # debug -u Orion.php  ^ ^
	 */
	public static $debugging = false;
	
	public $_performance = 0;
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	__construct
	 * @param	void
	 * @return	OBJECT
	 */
	private function __construct() 
	{
		/** TODO : This is the border of the nebula. */
		
		$this->_init();	
		$this->setDefaultAttributes( $this->_defaults );
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getInstance
	 * @param	void
	 * @return	OBJECT
	 */
	public static function getInstance()
	{
		static $_instance;
		if( !$_instance )
			$_instance = new self();
		return $_instance;		
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	autoload
	 * @param	string 	$classname
	 * @return	BOOLEAN
	 */
	public static function autoload( $classname )
	{
		if( class_exists( $classname, false ) || interface_exists( $classname, false ) )
			return false;
		
		if( $classname == 'Orion' )
			$file = __FILE__;
		
		elseif( preg_match('/^Orion/', $classname) == 1 ) 
		{
			/**
			* As classes do Orion iniciam com "Orion" seguido do caminho de diretórios
			* em que ela se encontra.
			* Assim a classe OrionKernel_Dump encontra-se dentro do diretório Kernel no 
			* arquivo Dump.php
			*/
			$arq = preg_replace('/^Orion/','', $classname);
					
			$file = self::getPath() . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR,explode('_',$arq)).'.php';
		} elseif(file_exists(	OrionKernel::$organizer->getPathLibs() . DIRECTORY_SEPARATOR .  
								implode(DIRECTORY_SEPARATOR,explode('_',$classname)).'.php'
							)
		)
		{
			/**
			 * Se não for uma classe Orion, deve procurar no seu diretório de bibliotecas
			 */
			 $file = 	OrionKernel::$organizer->getPathLibs() . DIRECTORY_SEPARATOR .  
						implode(DIRECTORY_SEPARATOR,explode('_',$classname)).'.php';
			
		} else {
			$dir_uni = Orion::getAttribute(Orion::ATTR_DIR_UNIVERSE);
			
			if(!preg_match('/^\//',$dir_uni))
				$dir_uni = Orion::getAttribute(Orion::ATTR_DIR_PROJECT) . DIRECTORY_SEPARATOR . $dir_uni; 
			
			$file = $dir_uni . DIRECTORY_SEPARATOR . 
					implode(DIRECTORY_SEPARATOR,explode('_',$classname)).'.php';
		}
		
		if( file_exists($file) )
			require_once($file);
		
		return true;
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	init
	 * @param	array	$configs
	 * @return	OBJECT
	 */
	 public function init( $configs )
	 {
		$project = is_array($configs) ? $configs['project'] : $configs;
		$this->setAttribute(Orion::ATTR_PROJECT, $project);
		
		if(is_array($configs) && !empty($configs['path_project']))
			$_yml_config = 	$configs['path_project'] . DIRECTORY_SEPARATOR . 
							'config.yml';
		elseif(file_exists(	Orion::getDfPathProjects() . DIRECTORY_SEPARATOR . 
							$project . DIRECTORY_SEPARATOR . 
							'config.yml'
		))
				$_yml_config = 	Orion::getDfPathProjects() . DIRECTORY_SEPARATOR . 
								$project . DIRECTORY_SEPARATOR . 
								'config.yml';
		else
			throw new OrionException("Arquivo de configuração de projeto não encontrado.", OrionError::FILE_NOT_EXISTS);
			
		if(!empty($configs['path_project']))
			$this->setAttribute(Orion::ATTR_DIR_PROJECT, $configs['path_project']);
		
		$this->loadYmlConfig($_yml_config);
		
		if	(is_array($configs))
			foreach( $configs as $attr => $value )
				if(! is_array($value))
					call_user_func_array( array('Orion', 'setAttribute'), array($attr, $value ));
				else 
					if($attr == 'library')
						$this->setLibraries( $value[0], $value[1], $value[2] );
		
		
		/**
		 * registra o autoload do ORM
		 */		
		$this->_setLibrary	(	self::getPath() . DIRECTORY_SEPARATOR . self::getAttribute(Orion::ATTR_ORM_LIB), 
								self::getAttribute(Orion::ATTR_ORM_CLASS),
								self::getAttribute(Orion::ATTR_ORM_AUTOLOAD)
							);
		
		self::$_kern->init();
		
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
		/**
		 * Se o autoload do Orion não foi registrado manualmente na spl_autoload_register,
		 * então ele será registrado automaticamente.
		 */
		if( ! class_exists('OrionKernel') )
			$this->registerOrionAutoload();
		
		$this->getInstanceKernel();
		$df = OrionCommand_Settings::getDfConfiguration();
		foreach($df as $config => $value)
			$this->setAttribute($config, $value);

		return $this;
	}
	
	protected function getInstanceKernel()
	{
		if(!isset(self::$_kern))
		{
			self::$_kern	= OrionKernel::getInstance();
			self::$_kern->getConfiguration();
		}
		
		return self::$_kern;
	}
	 
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	registerOrionAutoload
	 * @param	string
	 * @return	OBJECT 	self
	 */
	public function registerOrionAutoload()
	{
		$this->_setLibrary( __FILE__, 'Orion', 'autoload' );
				
		return $this;
	}	 
	 
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	setLibrary
	 * @param	array	$libs
	 * @return	OBJECT
	 */
	 public function setLibraries( $libs, $classname = false, $method = false )
	 {
		if(is_array($libs))
			foreach( $libs as $lib )
				$this->_setLibrary( $lib[0], $lib[1], $lib[2] );
		elseif(is_string($libs) && $classname != false && $method != false)
			$this->_setLibrary($libs, $classname, $method);
		else {
			/**
			 * Ainda não temos o autoload na spl para uma Exception aqui :(
			 */
			throw new OrionException("Erro ao tentar configurar outra biblioteca com o Orion");
		}
		return $this;
	 }
	 
	/**
	 * @class	Orion
	 * @scope	private
	 * @name	_setLibrary
	 * @param	string	$path
	 * @param 	string	$classname
	 * @param	string	$method
	 * @return	OBJECT	self
	 */
	 private function _setLibrary( $path, $classname, $method )
	 {
		/** 
		 * TODO : Para portabilidade, deve-se usar o formato *NIX
		 * de separador de diretórios ( '/' ), assim o Orion facilmente
		 * porta para os outros ambientes.
		 */
		$path = str_replace('/',DIRECTORY_SEPARATOR,$path);
		
		if(is_file($path))
			require_once($path);
		else
			throw new OrionException("Arquivo não encontrado: ".$path);
		
		if(!spl_autoload_register(array($classname, $method)))
			throw new OrionException(sprintf("Houve um problema ao registrar a biblioteca na SPL.", $path));
		
		return $this;	 
	 }

	/**
	 * Ajusta a configuração padrão do framework
	 * @class 	Orion
	 * @scope	protected
	 * @name 	setDefaultAttributes
	 * @param	array	$attrs
	 * @return	void
	 */
	protected function setDefaultAttributes( $attrs )
	{
		if( self::$_already_init == false )
		{
			foreach( $attrs as $key => $value )
				OrionKernel::$_env->setAttribute( $key, $value );
				
			self::$_already_init = true;
		}
		
		return;
	}

	/**
	 * @class	Orion
	 * @scope	public
	 * @name	setAttribute
	 * @param	void
	 * @return	OBJECT
	 */
	public static function setAttribute($attr, $value)
	{
		self::$_kern->setAttribute($attr, $value);
		return true;
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	setAttributesByConfClass
	 * @param	string	$class
	 * @return	OBJECT
	 */
	public function setAttributesByConfClass( $class )
	{
		try {
			if( !class_exists($class) )
				throw new OrionException('A classe não foi encontrada',2);
		} catch(OrionException $e) 
		{ 
			print $e->getMessage();
		}
		
		OrionKernel::$_env->setAttributesByConfClass( $class );
		
		return $this;
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getAttribute
	 * @param	mixed	$attr
	 * @return	mixed
	 */
	public static function getAttribute( $attr )
	{
		return OrionKernel::$_env->getAttribute( $attr );
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getAttrEnvironment
	 * @param	mixed	$attr
	 * @return	mixed
	 */
	public static function getAttrEnvironment( $attr )
	{
		$env = Orion::getAttribute(Orion::ATTR_ENV);
		if($env == Orion::ATTR_ENV_DEV)
			return Orion::getAttribute( constant('Orion::'.$attr . '_DEV') );
		elseif($env == Orion::ATTR_ENV_TEST)
			return Orion::getAttribute( constant('Orion::'.$attr . '_TEST') );
		elseif($env == Orion::getAttribute( Orion::ATTR_ENV_PROD ) )
			return Orion::getAttribute( constant('Orion::'.$attr . '_PROD') );
	}
	
	
	 
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getPath
	 * @param	void
	 * @return	string
	 */
	public static function getPath()
	{
		if( !self::$_path )
			self::$_path = dirname(__FILE__) . '/Orion';
		
		return self::$_path;
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getPathIndex
	 * @param	void
	 * @return	string
	 * @deprecated 	@see Orion::getPathOrion()
	 */	
	public static function getPathIndex()
	{
		return dirname(__FILE__);
	}
	
	/**
	 * This method is an alias to Orion::getPathIndex()
	 * @class	Orion
	 * @scope	public
	 * @name	getPathOrion
	 * @param	void
	 * @return	string
	 */
	public static function getPathOrion()
	{
		return dirname(__FILE__);
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getPathApps
	 * @param	void
	 * @deprecated
	 * @return	string
	 */
	public static function getPathApps()
	{
		$path = dirname(__FILE__);
		$path .= DIRECTORY_SEPARATOR . OrionKernel::$_env->_attributes[self::ATTR_DIR_APPS];
		return $path;
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getPathVendor
	 * @param	void
	 * @return	OBJECT
	 */	
	public static function getPathVendor()
	{
		return self::getPath() . DIRECTORY_SEPARATOR . 'Vendor';
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getDfPathProjects
	 * @param	void
	 * @return	string
	 */
	public static function getDfPathProjects()
	{
		return dirname($_SERVER['DOCUMENT_ROOT']);
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getProjectURL
	 * @param	void
	 * @return	string
	 */
	public static function getProjectURL()
	{
		return	OrionKernel::$organizer->getURLHost();
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getURLforView
	 * @param	void
	 * @deprecated
	 * @return	string
	 */
	public static function getURLforView()
	{
		return self::getProjectURL() . OrionKernel::$_env->_attributes[self::ATTR_DIR_VIEW];
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getDomain
	 * @param	void
	 * @return	string
	 */
	public static function getDomain()
	{
		return OrionKernel::$organizer->findURLHost();
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getFormatedClassCommand
	 * @param	string	$action
	 * @return	string
	 */
	 public static function getFormatedClassCommand( $action )
	 {
		$format = OrionKernel::$_env->_attributes[self::ATTR_FORMAT_CLASS_COMMAND];
		return sprintf($format, $action);
	 }
	 
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getFileCommand
	 * @param	string	Module
	 * @param 	string	Action
	 * @return	OBJECT
	 */
	public static function getFileCommand( $module, $action )
	{
		$command = 	OrionKernel::$organizer->paths['commands'] . DIRECTORY_SEPARATOR .
					$module . DIRECTORY_SEPARATOR .
					$action . '.php';
		return $command;
	}   
	 
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getAttributesAsArray
	 * @param	void
	 * @return	array
	 */
	 public function getAttributesAsArray()
	 {
		return OrionKernel::$_env->_attributes;
	 }
	
	
	/**
	 * FIXME :: FIXME
	 */
	public function generateCRUDbyDoctrine( $models, $configs = array() )
	{
		/** TODO : A Intergalactic nebula.
		 * It is known that Orion is a stellar nursery, well, here it is a one
		 * of the nurseries, for stars of the type Doctrine.
		 */
	}
	
	public function generateProtoCommand( $commands, $interfaces = array(), $force = true )
	{
		$builder = new OrionBuilder_Command( $interfaces );
		$builder->generateProtoCommand($commands, $force);
		
		return true;
	}
	
	public function loadYmlConfig( $file )
	{
		require_once(Orion::getPath() . DIRECTORY_SEPARATOR . 'Vendor/Spyc/spyc.php');
		
		$_config = Spyc::YAMLLoad($file);
		
		//OrionTools_Debug::debugArray($_config);
		/** project */
		if(!empty($_config['project']['name']))
			$this->setAttribute( Orion::ATTR_PROJECT, $_config['project']['name'] );
		if(!empty($_config['project']['host']))
			$this->setAttribute( Orion::ATTR_HOST, $_config['project']['host'] );
		if(!empty($_config['project']['environment']) || !empty($_config['project']['env']))
			$this->setAttribute( Orion::ATTR_ENV, $_config['project']['environment'] );
		if(!empty($_config['project']['url-mode']))
			if(	$_config['project']['url-mode'] == 'rewrite' || 
				$_config['project']['url-mode'] == 'friendly' ||
				$_config['project']['url-mode'] == 'amigavel'
			)
			$this->setAttribute( Orion::ATTR_URL_MODE, Orion::ATTR_URL_MODE_REWRITE );
		else
			$this->setAttribute( Orion::ATTR_URL_MODE, Orion::ATTR_URL_MODE_DEFAULT );
		
		if(!empty($_config['project']['lang']))
			$this->setAttribute( Orion::ATTR_LANG, $_config['project']['lang'] );
		
		/** directories */
		if(!empty($_config['directory']['commands']))
			$this->setAttribute( Orion::ATTR_DIR_COMMANDS, $_config['directory']['commands'] );
		if(!empty($_config['directory']['database']))
			$this->setAttribute( Orion::ATTR_DIR_DATABASE, $_config['directory']['database'] );
		if(!empty($_config['directory']['libs']))
			$this->setAttribute( Orion::ATTR_DIR_LIBS, $_config['directory']['libs'] );
		if(!empty($_config['directory']['tests']))
			$this->setAttribute( Orion::ATTR_DIR_TESTS, $_config['directory']['tests'] );
		if(!empty($_config['directory']['view']))
			$this->setAttribute( Orion::ATTR_DIR_VIEW, $_config['directory']['view'] );
		if(!empty($_config['directory']['logs']))
			$this->setAttribute( Orion::ATTR_DIR_LOGS, $_config['directory']['logs'] );
		if(!empty($_config['directory']['cache']))
			$this->setAttribute( Orion::ATTR_DIR_CACHE, $_config['directory']['cache'] );
		if(!empty($_config['directory']['cache-html']))
			$this->setAttribute( Orion::ATTR_DIR_CACHE_HTML, $_config['directory']['cache-html'] );
		
		/** database */
		if(!empty($_config['database']['development']))
		{
			$this->setAttribute(Orion::ATTR_HOST_DB_DEV, 		$_config['database']['development']['host']);
			$this->setAttribute(Orion::ATTR_USER_DB_DEV, 		$_config['database']['development']['user']);
			$this->setAttribute(Orion::ATTR_PASS_DB_DEV, 		$_config['database']['development']['pass']);
			$this->setAttribute(Orion::ATTR_DATABASE_DEV, 		$_config['database']['development']['database']);
			$this->setAttribute(Orion::ATTR_CHARSET_DB_DEV, 	$_config['database']['development']['charset']);
			$this->setAttribute(Orion::ATTR_COLLATE_DB_DEV, 	$_config['database']['development']['collate']);
			$this->setAttribute(Orion::ATTR_ADAPTER_DEV, 		$_config['database']['development']['adapter']);
			$this->setAttribute(Orion::ATTR_ADAPTER_ENGINE_DEV, $_config['database']['development']['engine']);
		}
		if(!empty($_config['database']['test']))
		{
			$this->setAttribute(Orion::ATTR_HOST_DB_TEST, 		$_config['database']['test']['host']);
			$this->setAttribute(Orion::ATTR_USER_DB_TEST, 		$_config['database']['test']['user']);
			$this->setAttribute(Orion::ATTR_PASS_DB_TEST, 		$_config['database']['test']['pass']);
			$this->setAttribute(Orion::ATTR_DATABASE_TEST,		$_config['database']['test']['database']);
			$this->setAttribute(Orion::ATTR_CHARSET_DB_TEST,	$_config['database']['test']['charset']);
			$this->setAttribute(Orion::ATTR_COLLATE_DB_TEST,	$_config['database']['test']['collate']);
			$this->setAttribute(Orion::ATTR_ADAPTER_TEST, 		$_config['database']['test']['adapter']);
			$this->setAttribute(Orion::ATTR_ADAPTER_ENGINE_TEST,$_config['database']['test']['engine']);
		}
		if(!empty($_config['database']['production']))
		{
			$this->setAttribute(Orion::ATTR_HOST_DB_PROD, 		$_config['database']['production']['host']);
			$this->setAttribute(Orion::ATTR_USER_DB_PROD, 		$_config['database']['production']['user']);
			$this->setAttribute(Orion::ATTR_PASS_DB_PROD, 		$_config['database']['production']['pass']);
			$this->setAttribute(Orion::ATTR_DATABASE_PROD,		$_config['database']['production']['database']);
			$this->setAttribute(Orion::ATTR_CHARSET_DB_PROD,	$_config['database']['production']['charset']);
			$this->setAttribute(Orion::ATTR_COLLATE_DB_PROD,	$_config['database']['production']['collate']);
			$this->setAttribute(Orion::ATTR_ADAPTER_PROD, 		$_config['database']['production']['adapter']);
			$this->setAttribute(Orion::ATTR_ADAPTER_ENGINE_PROD,$_config['database']['production']['engine']);
		}
		
		/** ORM */
		if(!empty($_config['orm']['lib']))
			$this->setAttribute( Orion::ATTR_ORM_LIB, $_config['orm']['lib'] );
		if(!empty($_config['orm']['class']))
			$this->setAttribute( Orion::ATTR_ORM_CLASS, $_config['orm']['class'] );
		if(!empty($_config['orm']['autoload']))
			$this->setAttribute( Orion::ATTR_ORM_AUTOLOAD, $_config['orm']['autoload'] );
		
		/** view */
		if(!empty($_config['view']['page']['404']))
			$this->setAttribute( Orion::ATTR_VIEW_PAGE_404, $_config['view']['page']['404'] );
		if(!empty($_config['view']['template_system']['lib']))
			$this->setAttribute( Orion::ATTR_VIEW_TEMPLATE_LIB, $_config['view']['template_system']['lib'] );
		if(!empty($_config['view']['template_system']['class']))
			$this->setAttribute( Orion::ATTR_VIEW_TEMPLATE_CLASS, $_config['view']['template_system']['class'] );
		if(!empty($_config['view']['template_system']['autoload']))
			$this->setAttribute( Orion::ATTR_VIEW_TEMPLATE_AUTOLOAD, $_config['view']['template_system']['autoload'] );
		
		if(!empty($_config['library']))
			foreach($_config['library'] as $libs)
				if(!empty($libs['lib']) && !empty($libs['class']) && !empty($libs['autoload']))
				{
					if(!preg_match('@^\/@', $libs['lib']))
						$libs['lib'] =	Orion::getAttribute(Orion::ATTR_DIR_PROJECT). DIRECTORY_SEPARATOR. $libs['lib'];
					
					$this->_setLibrary($libs['lib'], $libs['class'],$libs['autoload']);
				}
	}
	
	/**
	 * Método mágico __call para simular criação de métodos em
	 * tempo de execução na classe.
	 * @see 	__call
	 * @see 	__get
	 * @see 	__toString
	 * @see		__isset
	 */
	public function __call($method, $args)
	{
		if( preg_match('/^run/', $method) )
		{
			/**
			 * uma classe
			 */
			$class = preg_replace('/^run/', '', $method);
			$instance = new $class($args[0], $args[1]);
			$instance->run();
			return $instance;
		} elseif( preg_match('/^set/', $method) )
		{
			$at = preg_replace('/^set/', '', $method);
			self::setAttribute(strtolower($at), $args[0]);
			return $this;
		} elseif( preg_match('/^getPath/', $method) )
		{
			return OrionKernel::$organizer->$method();
		}
	}
	
	public static function __callStatic($method, $args)
	{
		if(preg_match('/^getPath/', $method))
			return OrionKernel::$organizer->$method();
		elseif(preg_match('/^getURL/', $method))
			return OrionKernel::$organizer->$method();
	}
	
	public function __toString()
	{
		return self::$_kern->getAttributesAsString();
		/*/return 	OrionToString::getInstance()
				->info("Classe Orion")
				->export(OrionKernel::$_env)
				->get();*/
	}
	
	public function __isset($property)
	{
		$attrs = $this->getAttributesAsArray();
		if(isset($attrs[$property]))
			return true;
		else
			return false;
	}
	
	public function __get($property)
	{
		return $property;
	}
	
	public function __destruct()
	{
		/**
		 * 
		 *	$this->_performance = $this->performance->diff();
		 * 	if($this->debugging == true)
		 *		prin $this->_performance;
		 */
	}	

}

 