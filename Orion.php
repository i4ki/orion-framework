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
class Orion
{
	const VERSION					= 0.2;
	const SITE						= 'www.orion-framework.org';
	const AUTHOR_EMAIL				= 'tiago_moura@live.com';
	
	/**
	 * Constantes de configuração
	 */
	const ATTR_PROJECT				= 0;
	const ATTR_FACTORY_URL			= 1;
	const ATTR_FACTORY_URL_DEFAULT 	= 2;
	const ATTR_FACTORY_URL_FRIENDLY = 3;
	const ATTR_CHARSET_HTML			= 4;
	const ATTR_HOST					= 5;
	const ATTR_ENV					= 6;
	const ATTR_ENV_DEV				= 7;
	const ATTR_ENV_TEST				= 8;
	const ATTR_ENV_PROD				= 9;
	
	/**
	 * Árvore de relacionamentos Modules -> Actions
	 * Constantes para o CRUD
	 * Create 	= CRUD_C
	 * Retrieve	= CRUD_R
	 * Update	= CRUD_U
	 * Delete	= CRUD_D
	 * @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	 * @ Cada módulo deve implementar o CRUD   @
	 * @ /ModuleX/Orion::CRUD_C                @
	 * @ /ModuleX/Orion::CRUD_R                @
	 * @ /ModuleX/Orion::CRUD_U                @
	 * @ /ModuleX/Orion::CRUD_D                @
	 * @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	 *
	 */
	const ATTR_CRUD_C				= 11;
	const ATTR_CRUD_R				= 12;
	const ATTR_CRUD_U				= 13;
	const ATTR_CRUD_D				= 14;
	
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
	const ATTR_VIEW_TEPLATE_CLASS	= 91;
	const ATTR_VIEW_TEPLATE_AUTOLOAD= 92;
	const ATTR_VIEW_PAGE_404		= 93;
	
	/**
	 * Constantes de diretórios
	 */
	const ATTR_DIR_LIBS				= 101;
	const ATTR_DIR_APPS				= 102;
	const ATTR_DIR_LOGS				= 103;
	const ATTR_DIR_VIEW				= 104;
	const ATTR_DIR_PROJECT			= 105;
	const ATTR_DIR_COMMANDS			= 106;
	const ATTR_DIR_DATABASE			= 107;
	const ATTR_DIR_SCRIPTS			= 108;
	const ATTR_DIR_TESTS			= 109;
	
	const ATTR_DEBUG				= 120;
	
	/**
	 * Constante => String
	 * @var array	$_const_string
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
	public static $debugging = true;
	
	public static $_;
	
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
		
		self::$_ = create_function('$opt = NULL', 
			'
				class Microtime
				{
					public $init 	= 0;
					public $end 	= 0;
					
					public function __construct()
					{
					
					}
					
					public function getTime()
					{
						$time 	= microtime(true);
						$time 	= explode(" ", $time);
						$sec 	= $time[1];
						$msec 	= $time[0];
						return ($sec + $msec);
					}
					
					public function init()
					{
						$this->init = $this->getTime();
						return $this;
					}
					
					public function end()
					{
						$this->end = $this->getTime();
						return $this;
					}
					
					public function diff()
					{
						return ($this->end - $this->init); 
					}
				}
				$msec = new Microtime();
				return $msec;
			');
		
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
		
		elseif( preg_match('/^Orion/', $classname) == 1 ) {
			/**
			* As classes do Orion iniciam com "Orion" seguido do caminho de diretórios
			* em que ela se encontra.
			* Assim a classe OrionKernel_Dump encontra-se dentro do diretório Kernel no 
			* arquivo Dump.php
			*/
			$arq = preg_replace('/^Orion/','', $classname);
					
			$file = self::getPath() . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR,explode('_',$arq)).'.php';
		} else
			/**
			 * Se não for uma classe Orion, deve procurar no seu diretório de bibliotecas
			 */
			 $file = 	dirname(__FILE__) . DIRECTORY_SEPARATOR . 
						self::getAttribute(Orion::ATTR_DIR_APPS) . DIRECTORY_SEPARATOR .
						self::getAttribute(Orion::ATTR_PROJECT) . DIRECTORY_SEPARATOR . 
						self::getAttribute(Orion::ATTR_DIR_LIBS) . DIRECTORY_SEPARATOR . 
						implode(DIRECTORY_SEPARATOR,explode('_',$classname)).'.php';
						
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

		$_yml_config = Orion::getPathIndex() . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . $project . DIRECTORY_SEPARATOR . 'config.yml';
		if(file_exists($_yml_config))
			$this->loadYmlConfig( $_yml_config );
		
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
		
		$this->_defaults = array(
			self::ATTR_ENV					=> self::ATTR_ENV_DEV,
			self::ATTR_DIR_APPS				=> 'apps',
			self::ATTR_DIR_COMMANDS			=> 'commands',
			self::ATTR_DIR_DATABASE			=> 'database',
			self::ATTR_DIR_LIBS				=> 'libs',
			self::ATTR_DIR_SCRIPTS			=> 'scripts',
			self::ATTR_DIR_TESTS			=> 'tests',
			self::ATTR_DIR_LOGS				=> $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR,
			self::ATTR_DIR_VIEW				=> 'view',
			self::ATTR_HOST					=> 'http://localhost/Orion/',
			self::ATTR_FACTORY_URL 			=> self::ATTR_FACTORY_URL_DEFAULT,
			self::ATTR_CRUD_C				=> 'create',
			self::ATTR_CRUD_R				=> 'retrieve',
			self::ATTR_CRUD_U				=> 'update',
			self::ATTR_CRUD_D				=> 'delete',
			self::ATTR_FORMAT_CLASS_COMMAND	=> '%sCommand',
			self::ATTR_CHARSET_HTML			=> 'utf-8',
			self::ATTR_CHARSET_DB_DEV		=> 'utf8',
			self::ATTR_CHARSET_DB_TEST		=> 'utf8',
			self::ATTR_CHARSET_DB_PROD		=> 'utf8',
			self::ATTR_COLLATE_DB_DEV		=> 'utf8_general_ci',
			self::ATTR_COLLATE_DB_TEST		=> 'utf8_general_ci',
			self::ATTR_COLLATE_DB_PROD		=> 'utf8_general_ci',
			self::ATTR_ORM					=> 'none',
			self::ATTR_HOST_DB_DEV			=> 'localhost',
			self::ATTR_HOST_DB_TEST			=> 'localhost',
			self::ATTR_HOST_DB_PROD			=> 'localhost',
			self::ATTR_USER_DB_DEV			=> 'root',
			self::ATTR_USER_DB_TEST			=> 'test',
			self::ATTR_USER_DB_PROD			=> 'user',
			self::ATTR_PASS_DB_DEV			=> '13579',
			self::ATTR_PASS_DB_TEST			=> '11235',
			self::ATTR_PASS_DB_PROD			=> '123456',
			self::ATTR_ADAPTER_DEV			=> 'mysql',
			self::ATTR_ADAPTER_TEST			=> 'mysql',
			self::ATTR_ADAPTER_PROD			=> 'mysql',
			self::ATTR_ADAPTER_ENGINE_DEV	=> 'innodb',
			self::ATTR_ADAPTER_ENGINE_TEST	=> 'innodb',
			self::ATTR_ADAPTER_ENGINE_PROD	=> 'innodb',
			self::ATTR_DATABASE_DEV			=> 'orion_dev',
			self::ATTR_DATABASE_TEST		=> 'orion_test',
			self::ATTR_DATABASE_PROD		=> 'orion_prod'
		);
		
		/**
		 * FIXME : Quando tiver uma classe decente para ler arquivo YAML,
		 * fazer ler as configurações padrões de um yml ^ ^
		 * UPDATE: 10/09/2009 - Usando a classe Spyc temos um delay de 0.003479 seconds
		 * Enquanto ajustando com o array nativo um delay de 0,000071 seconds.
		 */
				
		self::$_kern	= OrionKernel::getInstance();
		self::$_kern->getStaticInstances();
						
		return $this;
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
			print "Erro ao tentar configurar outras bibliotecas com o Orion";
			exit(-1);
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
				
		require_once($path);	
		spl_autoload_register(array($classname, $method));		
		
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
		OrionKernel::$_env->setAttribute($attr, $value);
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
	 */	
	public static function getPathIndex()
	{
		return dirname(__FILE__);
	}
	
	/**
	 * @class	Orion
	 * @scope	public
	 * @name	getPathApps
	 * @param	void
	 * @return	string
	 */
	public static function getPathApps()
	{
		$path = dirname(__FILE__);
		$path .= DIRECTORY_SEPARATOR . OrionKernel::$_env->_attributes[self::ATTR_DIR_APPS];
		return $path;
	}
	
	public static function getPathProject()
	{
		return 	self::getPathApps() . DIRECTORY_SEPARATOR . 
				OrionKernel::$_env->_attributes[self::ATTR_PROJECT] . DIRECTORY_SEPARATOR;
	}
	
	public static function getPathVendor()
	{
		return self::getPath() . DIRECTORY_SEPARATOR . 'Vendor';
	}
	
	public static function getProjectURL()
	{
		return 	OrionKernel::$_env->_attributes[self::ATTR_HOST] . 
				( ! preg_match('/\/$/', OrionKernel::$_env->_attributes[self::ATTR_HOST]) ? '/' : ''). 
				OrionKernel::$_env->_attributes[self::ATTR_DIR_APPS] . '/' . 
				OrionKernel::$_env->_attributes[self::ATTR_PROJECT] . '/';
	}
	
	public static function getURLforView()
	{
		return self::getProjectURL() . OrionKernel::$_env->_attributes[self::ATTR_DIR_VIEW];
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
		
		/** system_url */
		if(!empty($_config['system_url']['factory_url']))
			$this->setAttribute( Orion::ATTR_FACTORY_URL, $_config['system_url']['factory_url'] );
		
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
			$this->setAttribute( Orion::ATTR_VIEW_TEPLATE_CLASS, $_config['view']['template_system']['class'] );
		if(!empty($_config['view']['template_system']['autoload']))
			$this->setAttribute( Orion::ATTR_VIEW_TEPLATE_AUTOLOAD, $_config['view']['template_system']['autoload'] );
		
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
		} 
	}
	
	public function __toString()
	{
		return self::$_kern->getAttributesAsString();
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

}

 