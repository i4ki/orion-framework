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
 * OrionCommand_Settings_Environment
 *
 * @package     Orion
 * @subpackage 	Command/Settings
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */
class OrionCommand_Settings_Environment
	extends OrionCommand_Settings 
		implements IteratorAggregate
{
	/**
	* TODO 	Array de configurações do Framework
	* @scope	protected
	* @var 	array	$_attributes
	*/
	public $_attributes 	= array();
	public $_urls			= array();

	protected function __construct()
	{
		parent::__construct();
	}

	/**
	 * @class	OrionCommand_Settings_Environment
	 * @name	setAttribute
	 * @scope 	protected
	 * @arg		$attr, $value
	 * @param	int	$attr
	 * @param	mixed	$value
	 * @return 	BOOL
	 */
	public function setAttribute( $attr, $value)
	{
		if(is_string($attr))
		{
			foreach(Orion::$_const_string as $key => $val)
			{
				if($attr == $key)
					if(!is_array($val))
					{
						foreach( Orion::$_const_string as $key => $val )
							if ( $key == $value )
								$value = constant('Orion::'.$val);
						$this->setAttribute(constant('Orion::'.$val), $value);
						break;
					}
					else {
						if(defined('Orion::'.$val['key']))
						{
							$attr = constant('Orion::'.$val['key']);
							foreach($val as $k => $v)
								if($value == $k)
									$this->setAttribute($attr, constant('Orion::'.$v));
						}
					}
			}
		} elseif(is_integer(( int ) $attr))
		{
			foreach(Orion::$_const_string as $key => $val)
				if( $value == $key )
					$value = constant('Orion::'.$val);
				$this->_attributes[$attr] = $value;
		}	
			return;
	}
	
	/**
	 * @class	OrionCommand_Settings_Environment
	 * @scope	public
	 * @name	setAttributesByConfClass
	 * @param	string	$classname
	 * @return	OBJECT
	 */
	public function setAttributesByConfClass( $classname )
	{
		/**
		 * FIXME : TORNAR ISSO ESCALÁVEL
		 */
		$p = array(
			Orion::ATTR_FACTORY_URL => 	defined($classname.'::URL_TYPE') 	? 
										constant($classname.'::URL_TYPE')	:
										constant('Orion::ATTR_FACTORY_URL_DEFAULT'),
			Orion::ATTR_CRUD_C		=> 	defined($classname.'::ATTR_CRUD_C')	?
										constant($classname.'::ATTR_CRUD_C')	:
										constant('Orion::ATTR_CRUD_C'),
			Orion::ATTR_CRUD_R		=> 	defined($classname.'::ATTR_CRUD_C')	?
										constant($classname.'::ATTR_CRUD_R')	:
										constant('Orion::ATTR_CRUD_R'),
			Orion::ATTR_CRUD_U		=> 	defined($classname.'::ATTR_CRUD_U')	?
										constant($classname.'::ATTR_CRUD_U')	:
										constant('Orion::ATTR_CRUD_U'),
			Orion::ATTR_CRUD_D		=> 	defined($classname.'::ATTR_CRUD_D')	?
										constant($classname.'::ATTR_CRUD_D')	:
										constant('Orion::ATTR_CRUD_D')
		);

		foreach($p as $key => $value)
			if(!empty($value))
				$this->setAttribute($key, $value);
		return $this;
	}


	/**
	 * Pega um atributo de configuração
	 * @class 	OrionCommand_Settings_Environment
	 * @name	getAttribute
	 * @scope	public
	 * @static
	 * @param	int	$attr
	 * @return	mixed
	 */
	public function getAttribute( $attr )
	{
		if(is_string($attr))
		{
			$up 	= strtoupper($attr);
			$const 	= 'Orion::' . $up;
			unset($up);
			if(defined($attr))
				$attr = constant($const);
			unset($const);
		}
		if(isset($this->_attributes[$attr]))
			return $this->_attributes[$attr];
	}
	
	public static function getInstance()
	{
		static $_instance;
		if( !$_instance )
			$_instance = new self();
		
		return $_instance;
	}
	
	public function getIterator()
	{
		return new ArrayIterator( $this->_attributes );
	}
}