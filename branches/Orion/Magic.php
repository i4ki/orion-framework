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
 * OrionMagic
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionMagic
 {
	
	public function __construct()
	{
		/**
		 * URL's importantes. Estas url's poderão ser chamadas como:
		 * Orion::getURLforProject() ou getURLforGoogle().
		 * @see __call
		 */
		OrionKernel::$_env->_urls = array(
			'project'	=> 	OrionKernel::$_env->_attributes[Orion::ATTR_HOST] . '/' . 
							OrionKernel::$_env->_attributes[Orion::ATTR_DIR_APPS] . '/' . 
							OrionKernel::$_env->_attributes[Orion::ATTR_PROJECT] . '/',
			'apps'		=> 	OrionKernel::$_env->_attributes[Orion::ATTR_HOST] . '/' .
							OrionKernel::$_env->_attributes[Orion::ATTR_DIR_APPS] . '/',
			'host'		=> 	OrionKernel::$_env->_attributes[Orion::ATTR_HOST],
			'google'	=> 	'http://www.google.com',
			'orion'		=>	'http://www.orion-framework.org',
			'pathadmin'	=> 	'{>project}view/Admin/Hitcentre/templates/'
		);
	}
	
	public function __call( $method, $args )
	{
		
		if(preg_match('/^getUrlFor/', $method))
		{
			$url = preg_replace('/^getUrlFor/', '', $method);
		
			if( isset(OrionKernel::$_env->_urls[strtolower($url)]) )
			{
				$url = OrionKernel::$_env->_urls[strtolower($url)];
				if(preg_match_all('/\{\>(?P<url>\w+)\}/', $url, $match))
				{
					foreach($match['url'] as $u)
					{
						$url = preg_replace('/\{\>(\w+)\}/', $this->__call('getUrlFor'.$u, array()), $url);
					}
					return $url;
				} else
					return $url;
			}
		} elseif( preg_match('/^getDirFor/', $method) )
		{
			$path 	= preg_replace('/^getDirFor/', '', $method);
			$const 	= constant('Orion::ATTR_DIR_'.strtoupper($path));
			if ( $const !== false )
			{
				return OrionKernel::$_env->_attributes[$const];
			} else
				return false;
		}
	}

	/**
	 * @class	OrionMagic
	 * @scope	public
	 * @name	getEnvironment
	 * @param	void
	 * @return	integer
	 */
	public static function getEnvironment()
	{
		return OrionKernel::$_env->_attributes[Orion::ATTR_ENV];
	}
	
	public function getInstanceForLib( $filename, $class )
	{
		if( file_exists($filename) )
			require_once($filename);
		else
			throw new OrionException('Arquivo de classe não encontrado em: '.$filename);
		
		return new $class();
	}
	
	/**
	 * @class	OrionMagic
	 * @scope	public
	 * @name	__isset
	 * @param	mixed
	 * @return	mixed
	 */
	public function __isset( $var )
	{
		return OrionKernel::$_env->_attributes[Orion::ATTR_ENV];
	}
	
	public function __unset( $var )
	{
	
	}
	
	public function __get( $var )
	{
	
	}
	
	public function __set( $var, $value )
	{
	
	}
	
	public function __toString()
	{
	
	}
 }