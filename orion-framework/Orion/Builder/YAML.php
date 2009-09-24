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
 * OrionBuilder_YAML
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionBuilder_YAML 
	extends OrionBuilder
{
	protected $yml;
	protected $lines;
	public static $ident_spaces = 0;
	public $properties 	= array();
	public static $currProperty	= 0;
	public static $lastProperty;
	protected $attr = array();
	protected $_nested = 0;
	
	public function __construct()
	{
	
	}
	
	/**
	 * FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : 
	 * FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : 
	 * FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : FIXME : 
	 */
	public function readYaml( $file )
	{
		$fp = fopen($file, 'r');
		if(!$fp)
			throw new Exception("Não foi possivel abrir o arquivo.");

		$this->yml = "";
		
		while(!feof($fp))
		{
			$this->yml .= fgets($fp, 1024);
		}
		
		$this->lines = explode("\n", $this->yml);
		
		
		for($i=0;$i<count($this->lines);$i++)
		{
			if( !$this->isValidLine($this->lines[$i], ($i+1)) )
				continue;
				
			if( preg_match('/^[\s]+/', $this->lines[$i]))
			{
				preg_match('/(?P<value>[\s]+)/', $this->lines[$i], $match);
				$this->setIdentationSpaces( strlen($match['value']) );
				break;
			}
		}
		
		for($i=0;$i<count($this->lines);$i++)
		{
			if( !$this->isValidLine($this->lines[$i], ($i+1)) )
				continue;
			
			$this->setAttributesProperties($this->lines[$i]);
			
					
		}
		
	}
	
	public function setAttributesProperties($line, $type = 1)
	{
		if( preg_match('/^(?P<property>[\w]+)\:/', $line, $match) )
		{
			OrionBuilder_YAML::$currProperty = $match['property'];
			//OrionBuilder_YAML::$lastProperty = $match['property'];
			$this->properties[OrionBuilder_YAML::$currProperty] = new Property( $match['property']);
		}	
		elseif( preg_match('/(?P<value>[\s]+)/', $line, $match) )
		{
			$ident = strlen($match['value']);
			
			if( strlen($match['value']) % OrionBuilder_YAML::$ident_spaces != 0 )
				throw new Exception("Erro de identação na linha ".($i+1).".");
			elseif( preg_match('/^(?P<attr>[\w]+)\:$/', trim($line), $match) )
			{
				// nested
				OrionBuilder_YAML::$lastProperty = $match['attr'];
				$this->properties[OrionBuilder_YAML::$currProperty]->createProperty( $match['attr'], $ident );
				
			}
			elseif( preg_match('/^[\s]{' . $ident . '}(?P<attr>[\w]+)\:[\s]*?(?P<value>[\w\W]+)/', $line, $match) )
			{
				$this->properties[OrionBuilder_YAML::$currProperty]->createAttr( $match['attr'], $match['value'], $ident);
			}
		}
	}
	
	public function isBlankLine( $line )
	{
		if( '' == trim($line, ' ') )
			return true;
		else 
			return false;
	}
	
	public function isCommentLine( $line )
	{
		if( preg_match('/^#/', ltrim($line)) )
			return true;
		else
			return false;
	}
	
	public function isEmptyLine( $line )
	{
		if( $this->isBlankLine($line) || $this->isCommentLine($line) )
			return true;
		else
			return false;
	}
	
	public function lineHaveTab( $line, $n )
	{
		if(preg_match('/[\t]+/', $line))
			throw new Exception("Um arquivo YAML não pode conter tabs. Erro na linha ".$n.".");
		else 
			return false;
	}
	
	public function isValidLine( $line, $n )
	{
		if($this->isBlankLine($line) || $this->isCommentLine($line))
			return false;
		else
			if(! $this->lineHaveTab($line, $n))
				return true;
	}
	
	public function setIdentationSpaces( $spaces )
	{
		OrionBuilder_YAML::$ident_spaces = $spaces;
		return true;
	}
	
	/**
	 * retorna o objeto com as propriedades pegas no arquivo
	 * num array.
	 */
	public function toArray()
	{
		$arr = array();
		foreach($this->properties as $property => $attribute)
		{
			if(!isset($attribute->attrs[0]->name))
			{
				$arr[$property] = array();
				for($i=0;$i<count($attribute->attrs[0]->attrs);$i++)
				{	
					$arr[$property][$attribute->attrs[0]->attrs[$i]->name] = $attribute->attrs[0]->attrs[$i]->value;
				}
			} else {
				$arr[$property] = array();
				for($j=0;$j<count($attribute->attrs);$j++)
				{
					$arr[$property][$attribute->attrs[$j]->name] = array();
					for($i=0;$i<count($attribute->attrs[$j]->attrs);$i++)
					{
						$arr[$property][$attribute->attrs[$j]->name][$attribute->attrs[$j]->attrs[$i]->name] = $attribute->attrs[$j]->attrs[$i]->value;
					}
				}
			}
		}
		
		return $arr;
	}
}

/**
 * classe de propriedades
 */
class Property
{
	public $name;
	public $ident;
	public $attrs = array();
	
	public function __construct( $name, $ident = 0 )
	{
		$name 	= ltrim($name);
		$this->name = $name;
		$this->ident = $ident;
	}
	
	public function createAttr( $attr, $value, $ident )
	{
		$attr 	= ltrim($attr);
		$value 	= ltrim($value);
			
		if(isset($this->attrs[count($this->attrs)-1]) && ( $this->attrs[count($this->attrs)-1]->ident + OrionBuilder_YAML::$ident_spaces) == $ident) 
		{
			$this->attrs[count($this->attrs)-1]->attrs[] = new Attribute( $attr, $value );
			/** cruzes, aqui há uma das nebulosas de órion ^ ^ */ 
		} elseif( 
			isset(
				$this	->attrs[count($this->attrs)-1]
						->attrs[count($this->attrs[count($this->attrs)-1]
						->attrs)-1]
				) && ( 
				$this	->attrs[count($this->attrs)-1]
						->attrs[count($this->attrs[count($this->attrs)-1]
						->attrs)-1]->ident + OrionBuilder_YAML::$ident_spaces
					) == $ident 
				)
			$this->attrs[count($this->attrs)-1]->attrs[count($this->attrs[count($this->attrs)-1]->attrs)-1]->attrs[] = new Attribute( $attr, $value );
		else {
			$this->attrs[]->attrs[] = new Attribute( $attr, $value );
		}
		return $this;
	}
	
	public function createProperty( $attr, $ident )
	{
			if(isset($this->attrs[count($this->attrs)-1]) && ($this->attrs[count($this->attrs)-1]->ident + OrionBuilder_YAML::$ident_spaces) == $ident) 
			{
				$this->attrs[count($this->attrs)-1]->attrs[] = new self( $attr, $ident );
			}
		else $this->attrs[] = new self( $attr, $ident );
		return;
	}
}

/**
 * classe atributos / values
 */
class Attribute
{
	public $name;
	public $value;
	
	public function __construct( $name, $value )
	{
		$this->name 	= $name;
		$this->value	= $value;
	}
}