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

abstract class OrionCommand_Settings
{
	private $_kern;
	private $route = array(
		
		'project'	=> array(
				'name'			=> Orion::ATTR_PROJECT,
				'project'		=> Orion::ATTR_PROJECT,
				'host'			=> Orion::ATTR_HOST,
				'hostname'		=> Orion::ATTR_HOST,
				'url'			=> Orion::ATTR_HOST,
				'environment'	=> Orion::ATTR_ENV,
				'env'			=> Orion::ATTR_ENV,
				'url-mode'		=> Orion::ATTR_URL_MODE
		),
		
		'directory'	=> array(
				'project' 		=> Orion::ATTR_DIR_PROJECT,
				'commands'		=> Orion::ATTR_DIR_COMMANDS,
				'database'		=> Orion::ATTR_DIR_DATABASE,
				'view'			=> Orion::ATTR_DIR_VIEW,
				'libs'			=> Orion::ATTR_DIR_LIBS,
				'tests'			=> Orion::ATTR_DIR_TESTS,
				'logs'			=> Orion::ATTR_DIR_LOGS
		),
		
		'database'	=> array(
				'development'	=> array(
						'host'			=> Orion::ATTR_HOST_DB_DEV,
						'hostname'		=> Orion::ATTR_HOST_DB_DEV,
						'username'		=> Orion::ATTR_USER_DB_DEV,
						'user'			=> Orion::ATTR_USER_DB_DEV,
						'password'		=> Orion::ATTR_PASS_DB_DEV,
						'pass'			=> Orion::ATTR_PASS_DB_DEV,
						'database'		=> Orion::ATTR_DATABASE_DEV,
						'db'			=> Orion::ATTR_DATABASE_DEV,
						'charset'		=> Orion::ATTR_CHARSET_DB_DEV,
						'collate'		=> Orion::ATTR_COLLATE_DB_DEV,
						'adapter'		=> Orion::ATTR_ADAPTER_DEV,
						'driver'		=> Orion::ATTR_ADAPTER_DEV,
						'engine'		=> Orion::ATTR_ADAPTER_ENGINE_DEV
				),
				'test'			=> array(
						'host'			=> Orion::ATTR_HOST_DB_TEST,
						'hostname'		=> Orion::ATTR_HOST_DB_TEST,
						'username'		=> Orion::ATTR_USER_DB_TEST,
						'user'			=> Orion::ATTR_USER_DB_TEST,
						'pass'			=> Orion::ATTR_PASS_DB_TEST,
						'password'		=> Orion::ATTR_PASS_DB_TEST,
						'database'		=> Orion::ATTR_DATABASE_TEST,
						'db'			=> Orion::ATTR_DATABASE_TEST,
						'charset'		=> Orion::ATTR_CHARSET_DB_TEST,
						'collate'		=> Orion::ATTR_COLLATE_DB_TEST,
						'adapter'		=> Orion::ATTR_ADAPTER_TEST,
						'driver'		=> Orion::ATTR_ADAPTER_TEST,
						'engine'		=> Orion::ATTR_ADAPTER_ENGINE_TEST
				),
				'production'	=> array(
						'host'			=> Orion::ATTR_HOST_DB_PROD,
						'hostname'		=> Orion::ATTR_HOST_DB_PROD,
						'username'		=> Orion::ATTR_USER_DB_PROD,
						'user'			=> Orion::ATTR_USER_DB_PROD,
						'pass'			=> Orion::ATTR_PASS_DB_PROD,
						'password'		=> Orion::ATTR_PASS_DB_PROD,
						'database'		=> Orion::ATTR_DATABASE_PROD,
						'db'			=> Orion::ATTR_DATABASE_PROD,
						'charset'		=> Orion::ATTR_CHARSET_DB_PROD,
						'collate'		=> Orion::ATTR_COLLATE_DB_PROD,
						'adapter'		=> Orion::ATTR_ADAPTER_PROD,
						'driver'		=> Orion::ATTR_ADAPTER_PROD,
						'engine'		=> Orion::ATTR_ADAPTER_ENGINE_PROD
				),
		),
		
		'orm'	=> array(
			'lib'		=> Orion::ATTR_ORM_LIB,
			'class'		=> Orion::ATTR_ORM_CLASS,
			'autoload'	=> Orion::ATTR_ORM_AUTOLOAD
		),
		
		'view'	=> array(
			'page'	=> array(
					'401'			=> Orion::ATTR_VIEW_PAGE_401,
					'402'			=> Orion::ATTR_VIEW_PAGE_402,
					'403'			=> Orion::ATTR_VIEW_PAGE_403,
					'404'			=> Orion::ATTR_VIEW_PAGE_404
			),
			'template_system' => array(
					'lib'			=> Orion::ATTR_VIEW_TEMPLATE_LIB,
					'class'			=> Orion::ATTR_VIEW_TEMPLATE_CLASS,
					'classname'		=> Orion::ATTR_VIEW_TEMPLATE_AUTOLOAD
			)
		)
	);
	
	protected $df;
	
	protected function __construct()
	{
		//$this->setDfConfiguration();
		

		/*require "/mnt/www/projetos/hitcentre/hitcentre/libs/Vendor/Orion/Orion/Vendor/Spyc/spyc.php";
		
		$def = Spyc::YAMLLoad("/mnt/www/projetos/hitcentre/hitcentre/config.yml");
		
		$this->getOrionConstantRelated( $def );*/
	}
	
	/**
	 * <yaml>
	 * 	# Este método retorna a relação entre as diretivas de 
	 * 	# configuração dos arquivos YAML que estão em modo
	 * 	# amigável ao desenvolvedor e a representação interna
	 * 	# do Framework.
	 *  #
	 *  # config.yml
	 *
	 *	database:
	 *    development:
	 *      username: 'root'
	 *      password: '11092001'
	 *    production:
	 *      username: 'client_1'
	 *      password: '08091988'
	 *    test:
	 *      username: 'test'
	 *      password: 'testpass'
	 *
	 * 	# fim
	 *	</yaml>
	 * 	As diretivas acima, após serem convertidas num array com algum
	 * 	parser YAML será algo como:
	 *	<code>
	 *	$definitions = array(
	 *		'database'	=> array(
	 *			'development'	=> array(
	 *					'username'	=>	'root',
	 *					'password'	=> 	'11092001'
	 *			),
	 *			'production'	=> array(
	 *					'username'	=> 	'client_1',
	 *					'password'	=> 	'08091988'
	 *			),
	 *			'test'			=> array(
	 *					'username'	=> 	'test',
	 *					'password'	=> 	'testpass'
	 *			)
	 *		)
	 *	);
	 *	</code>
	 *	
	 * 	E após ser tratada no presente método, retornará algo como:
	 *	<code>
	 *	$related = array(
	 *		Orion::ATTR_USER_DB_DEV		=> 'root',
	 *		Orion::ATTR_PASS_DB_DEV		=> '11092001',
	 *		Orion::ATTR_USER_DB_PROD	=> 'client_1',
	 *		Orion::ATTR_PASS_DB_PROD	=> '08091988',
	 *		Orion::ATTR_USER_DB_TEST	=> 'test',
	 *		Orion::ATTR_PASS_DB_TEST	=> 'testpass'
	 *	);	
	 * </code>
	 * @class	OrionCommand_Settings
	 * @scope	public
	 * @name	getOrionConstantRelated
	 * @param	array	definitions
	 * @return	array
	 */
	public function getOrionConstantRelated( $definitions = array() )
	{
		$def = new OrionArray_Raw($definitions);
		//$route = new OrionArray_Raw($this->route);
		print $def;
		//print $route;
	}
	
	private function _getOrionConstantRelated( $arr1, $arr2 )
	{
		print key($arr1) . ": ".key($arr2)."<br>";
		if($arr1 == $arr2)
			return true;
		else return false;
	}
	
	public function setDfConfiguration()
	{

		//OrionTools_Debug::debugArray($this->df);
		
		//OrionTools_Debug::debugArray($this->df);
		foreach($this->df as $config => $value)
		{
			//print $config.": ".$value."<br>";
			Orion::setAttribute($config, $value);
		}
		//print Orion::ATTR_URL_MODE .": ". $this->df[Orion::ATTR_URL_MODE]."<br>";
		return;
	}
	
	public static function getDfConfiguration()
	{
		$df = array(
			Orion::ATTR_ENV						=> Orion::ATTR_ENV_DEV,
			Orion::ATTR_DIR_APPS				=> 'apps',
			Orion::ATTR_DIR_COMMANDS			=> 'commands',
			Orion::ATTR_DIR_DATABASE			=> 'database',
			Orion::ATTR_DIR_LIBS				=> 'libs',
			Orion::ATTR_DIR_SCRIPTS				=> 'scripts',
			Orion::ATTR_DIR_TESTS				=> 'tests',
			Orion::ATTR_DIR_LOGS				=> '/mnt/www/tmp/logs',
			Orion::ATTR_DIR_CACHE				=> 'tmp/cache',
			Orion::ATTR_DIR_TEMP				=> 'tmp',
			Orion::ATTR_DIR_VIEW				=> 'view',
			Orion::ATTR_HOST					=> 'http://localhost:8080',
			Orion::ATTR_URL_MODE				=> Orion::ATTR_URL_MODE_DEFAULT,
			Orion::ATTR_FORMAT_CLASS_COMMAND	=> '%sCommand',
			Orion::ATTR_CHARSET_HTML			=> 'utf-8',
			Orion::ATTR_CHARSET_DB_DEV			=> 'utf8',
			Orion::ATTR_CHARSET_DB_TEST			=> 'utf8',
			Orion::ATTR_CHARSET_DB_PROD			=> 'utf8',
			Orion::ATTR_COLLATE_DB_DEV			=> 'utf8_general_ci',
			Orion::ATTR_COLLATE_DB_TEST			=> 'utf8_general_ci',
			Orion::ATTR_COLLATE_DB_PROD			=> 'utf8_general_ci',
			Orion::ATTR_ORM						=> 'none',
			Orion::ATTR_HOST_DB_DEV				=> 'localhost',
			Orion::ATTR_HOST_DB_TEST			=> 'localhost',
			Orion::ATTR_HOST_DB_PROD			=> 'localhost',
			Orion::ATTR_USER_DB_DEV				=> 'root',
			Orion::ATTR_USER_DB_TEST			=> 'teste',
			Orion::ATTR_USER_DB_PROD			=> 'user',
			Orion::ATTR_PASS_DB_DEV				=> '13579',
			Orion::ATTR_PASS_DB_TEST			=> '11235',
			Orion::ATTR_PASS_DB_PROD			=> '123456',
			Orion::ATTR_ADAPTER_DEV				=> 'mysql',
			Orion::ATTR_ADAPTER_TEST			=> 'mysql',
			Orion::ATTR_ADAPTER_PROD			=> 'mysql',
			Orion::ATTR_ADAPTER_ENGINE_DEV		=> 'innodb',
			Orion::ATTR_ADAPTER_ENGINE_TEST		=> 'innodb',
			Orion::ATTR_ADAPTER_ENGINE_PROD		=> 'innodb',
			Orion::ATTR_DATABASE_DEV			=> 'orion_dev',
			Orion::ATTR_DATABASE_TEST			=> 'orion_test',
			Orion::ATTR_DATABASE_PROD			=> 'orion_prod',
			Orion::ATTR_LANG					=> 'pt_BR',
			Orion::ATTR_INIT_FRAMEWORK			=> true
		);
		
		return $df;
	}
	
}