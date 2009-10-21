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
 * OrionOrganizer
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class OrionOrganizer
{
	public $project		= '';
	public $paths 		= array();
	public $urls		= array();
	
	/**
	 * @class	OrionOrganizer
	 * @scope	public
	 * @name	__construct
	 * @param	void
	 * @return	void
	 */
	private function __construct( $args = array() )
	{
		//$this->organizing();
	}
	
	/**
	 * @class	OrionOrganizer
	 * @scope	public
	 * @name	getInstance
	 * @param	void
	 * @return	OBJECT
	 */
	public static function getInstance( $args = array() )
	{
		static $instance;
		if(!$instance)
			$instance = new self($args);
		return $instance;
	}

	/**
	 * @class	OrionOrganizer
	 * @scope	public
	 * @name	organizing
	 * @param	void
	 * @return	OBJECT
	 */
	public function organizing()
	{
		$this->setOrionGlobalVars();
		
		/**
		 * Uma boa maneira de pegar o path do projeto sem depender de 
		 * uma configuração externa, mas tem o imprevisto de o usuário ter 
		 * o seu sistema configurado diferente do padrão dentro de libs/Vendor
		 *
		 * __FILE__ == "/path/of/project" . "/libs/Vendor/Orion/Orion/OrionOrganizer.php";
		 * $path_project = str_replace("/libs/Vendor/Orion/Orion/OrionOrganizer.php", "", __FILE__);
		 */
		$pattern = '/\/libs\/Vendor\/Orion\/Orion\/Organizer\.php$/';
		
		if(preg_match($pattern, __FILE__))
			$this->paths['project'] = preg_replace($pattern, '', __FILE__);
		else 
			$this->paths['project'] = Orion::getAttribute(Orion::ATTR_DIR_PROJECT);
		
		if(empty($this->paths['project']))
			throw new OrionException(sprintf("Falha ao ajustar o diretório onde encontra-se o projeto"), OrionError::INCORRECT_DIR_PROJECT);
		
		/**
		 * Detecta se a pasta pública está destro de um diretório.
		 */
		$root 			= Orion::$_SERVER['DOCUMENT_ROOT'];
		$script_file 	= Orion::$_SERVER['SCRIPT_FILENAME'];

		$root 			= 	preg_match(	'@\/$@', $root) ? 
							$root : 
							$root . DIRECTORY_SEPARATOR;
		
		$inside = str_replace(	$root,
								'',
								dirname($script_file)
		);
		
		if(!isset($inside)) $inside = '';
		unset($root, $script_file);
		
		$this->addPath('www', 	dirname($this->paths['project']) . DIRECTORY_SEPARATOR . 
								'www' . (!empty($inside) ? DIRECTORY_SEPARATOR . $inside : '')
		)->addPath('commands',	$this->paths['project'] . DIRECTORY_SEPARATOR .
								Orion::getAttribute(Orion::ATTR_DIR_COMMANDS)
		)->addPath('database',	$this->paths['project'] . DIRECTORY_SEPARATOR .
								Orion::getAttribute(Orion::ATTR_DIR_DATABASE)
		)->addPath('models',	$this->paths['database'] . DIRECTORY_SEPARATOR .
								'models'
		)->addPath('fixtures',	$this->paths['database'] . DIRECTORY_SEPARATOR .
								'fixtures'
		)->addPath('sql',		$this->paths['database'] . DIRECTORY_SEPARATOR .
								'sql'
		)->addPath('scripts', 	$this->paths['project']	. DIRECTORY_SEPARATOR .
								'scripts'
		)->addPath('view',		$this->paths['project'] . DIRECTORY_SEPARATOR .
								'view'
		)->addPath('libs',		$this->paths['project'] . DIRECTORY_SEPARATOR .
								'libs'
		)->addPath('logs',		preg_match('/^\//', Orion::getAttribute(Orion::ATTR_DIR_LOGS)) ?
								Orion::getAttribute(Orion::ATTR_DIR_LOGS) :
								dirname(Orion::$_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR .
								Orion::getAttribute(Orion::ATTR_DIR_LOGS)
		)->addPath('cache',		preg_match('/^\//', Orion::getAttribute(Orion::ATTR_DIR_CACHE)) ?
								Orion::getAttribute(Orion::ATTR_DIR_CACHE) :
								Orion::getPathOrion() . DIRECTORY_SEPARATOR .
								Orion::getAttribute(Orion::ATTR_DIR_CACHE)
		)->addPath('cache-html',preg_match('/^\//', Orion::getAttribute(Orion::ATTR_DIR_CACHE_HTML)) ?
								Orion::getAttribute(Orion::ATTR_DIR_CACHE_HTML) :
								Orion::getPathOrion() . DIRECTORY_SEPARATOR .
								Orion::getAttribute(Orion::ATTR_DIR_CACHE_HTML)
		);
		
		
		
		if(!empty($inside))
			$this->addURL('inside',	$inside);
		else 
			$this->addURL('inside', '');
		
		$this	->addURL('host', 		Orion::getAttribute(Orion::ATTR_HOST) . 
										(!empty($this->urls['inside']) ?
										'/'.$this->urls['inside'] : '')
				)
				->addURL('hostname', 	$this->urls['host'])
				->addURL('www',			$this->urls['host'])
				->addURL('uri',			!empty(Orion::$_SERVER['REQUEST_URI']) ?
										Orion::$_SERVER['REQUEST_URI'] : 
										''
				)->addURL('ip', 		gethostbyname(!empty(Orion::$_SERVER['HTTP_HOST']) ? 
														Orion::$_SERVER['HTTP_HOST'] :
														Orion::getAttribute(Orion::ATTR_HOST)
													)
				)->addURL('stylesheets', $this->urls['host'] . '/stylesheets')
				->addURL('css', 		$this->urls['stylesheets'])
				->addURL('javascripts', $this->urls['host'] . '/js')
				->addURL('js',			$this->urls['javascripts'])
				->addURL('images', 		$this->urls['host'] . '/images')
				->addURL('img',			$this->urls['images'])
				->addURL('google', 		'http://www.google.com')
				->addURL('orion', 		'http://code.google.com/p/orion-framework');
		
		//OrionTools_Debug::debugArray($this->paths);
		//OrionTools_Debug::debugArray($this->urls);	
	}
	
	public function setOrionGlobalVars()
	{
		foreach($_SERVER as $key => $value)
			if(empty(Orion::$_SERVER[$key]))
				Orion::$_SERVER[$key] = $value;
		
		return true;
	}
	
	public function addPath( $name, $path )
	{
		$this->paths[$name] = $path;
		return $this;
	}
	
	public function addURL( $name, $url )
	{
		$this->urls[$name] = $url;
		return $this;
	}
	
	public function __toString()
	{
		return 	OrionToString::getInstance()
				->info(sprintf("Informações da classe %s:",get_class($this)))
				->info(sprintf("public \$paths = "))
				->export($this->paths, true)
				->info(sprintf("public \$urls = "))
				->export($this->urls, true)
				->get();
	}
	
	public function getModuleAction()
	{
		
		$moduleAction = array();
		$moduleAction = preg_replace(	'/^\/'.
										str_replace('/', '\/', $this->getURLInside()).'\//', 
										'', 
										$this->getURLUri()
		);
		//print $this->getURLInside()."<br>";
		$moduleAction = explode('/', $moduleAction);
		if(empty($moduleAction[0]))
			array_shift($moduleAction);
		return $moduleAction;
	}
	
	public function __call($method, $args)
	{
		if(preg_match('/^getPath/', $method))
		{
			$method = preg_replace('/^getPath/', '', $method);
			return isset($this->paths[strtolower($method)]) ? $this->paths[strtolower($method)] : false;
		} elseif(preg_match('/^getURL/', $method))
		{
			$method = preg_replace('/^getURL/', '', $method);
			return 	isset($this->urls[strtolower($method)]) ? 
					$this->urls[strtolower($method)] :
					false;
		}
	}


}