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
 * OrionString
 * Simula objeto do tipo String
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */
class OrionString
{
	public $value;
	public $length;
	public $len;
	public $size;
	
	/**
	 * Armazena o número de matchs da última expressão regular
	 * @var countMatchs	
	 */
	public $countMatchs;
	
	/**
	 * Armazena um array com todos os matchs da última expressaão regular
	 * @var match
	 */
	public $match = array();

	public function __construct($str = false)
	{
		if(!$str)
			$this->value = '';
		elseif(is_string($str))
			$this->value = $str;
		elseif(is_object($str) && get_class($str) == __CLASS__)
			$this->value = $str->value;
		else
			throw new OrionException(sprintf("%s passado para o construtor de %s, deveria ser uma string.", ucfirst(strtolower(gettype($str))), __CLASS__), OrionError::TYPE_STRING);
		
		$this->length = strlen($this->value);
		$this->len = &$this->length;
		$this->size = &$this->length;
	}
	
	public function __s($str = false)
	{
		return new self($str);
	}
	
	public function length()
	{
		$this->length = strlen($this->value);
		return $this->length;
	}
	
	public function append($str)
	{
		if(is_string($str))
		{
			$this->value .= $str;
			$this->length += strlen($str);
		}
		elseif(is_object($str) && get_class($str) == __CLASS__)
		{
			$this->value .= $str->value;
			$this->length += strlen($str->value);
		} else
			throw new OrionException(sprintf("%s passado para o método %s::append, deveria ser string ou instancia da classe %s", ucfirst(strtolower(gettype($str))), __CLASS__, __CLASS__), OrionError::TYPE_STRING);
		
		return $this;
	}
	
	/**
	 * @class	OrionString
	 * @scope	public
	 * @name	chomp
	 * @param	charlist
	 * @return	OBJECT
	 */
	public function chomp($charlist = false)
	{
		$this->value = 	$charlist == false ? 
						rtrim($this->value) : 
						rtrim($this->value, $charlist);
		$this->length = strlen($this->value);
		return $this->value;
	}

	/**
	 * @class	OrionString
	 * @scope	public
	 * @name	match
	 * @param	pattern
	 * @return	BOOLEAN
	 */
	public function match($pattern)
	{
		return preg_match($pattern, $this->value);
	}
	
	public function matchAll($pattern, $flags = PREG_PATTERN_ORDER, $offset = 0)
	{
		$this->countMatchs = preg_match_all($pattern, $this->value, &$this->match, $flags, $offset);
		return $this->match;
	}
	
	/**
	 * @class	OrionString
	 * @scope	public
	 * @name	replaceAll
	 * @param	pattern
	 * @param	replace
	 * @return	string
	 */
	public function replaceAll($pattern, $replace, $limit = -1, $count = false)
	{
		$this->value = preg_replace($pattern, $replace, $this->value, $limit, $count);
		$this->length = strlen($this->value);
		return $this->value;
	}
	
	/**
	 * @class	OrionString
	 * @scope	public
	 * @name	charAt
	 * @param	$idx
	 * @return	char
	 */
	public function charAt($idx)
	{
		if(!is_integer($idx))
			throw new OrionException(sprintf("%s passado ao método %s::charAt, deveria ser um inteiro.", ucfirst(strtolower(gettype($idx))), __CLASS__), OrionError::TYPE_STRING);

		return !empty($this->value[$idx]) ? $this->value[$idx] : false;
	}
	
	public function charCodeAt($idx)
	{
		if(!is_integer($idx))
			throw new OrionException(sprintf("%s passado ao método %s::charAt, deveria ser um inteiro.", ucfirst(strtolower(gettype($idx))), __CLASS__), OrionError::TYPE_STRING);
		
		return !empty($this->value[$idx]) ? dechex(ord($this->value[$idx])) : false;
	}
	
	public function fromCharCode()
	{
		$argc = func_num_args();
		$argv = func_get_args();
		
		$this->value = '';
		for($i=0;$i<$argc;$i++)
			$this->value .= chr($argv[$i]);
		return $this->value;
	}
	
	public function fromCharCodeHex()
	{
		$argc = func_num_args();
		$argv = func_get_args();
		
		$this->value = '';
		for($i=0;$i<$argc;$i++)
			$this->value .= chr(hexdec($argv[$i]));
		return $this->value;
	}
	
	public function indexOf($substr, $inicio = 0)
	{
		return strpos($this->value, $substr, $inicio); 
	}
		
	public function toLowerCase($obj = false)
	{
		if($obj == true)
			$this->value = strtolower($this->value);
		return strtolower($this->value);
	}
	
	public function equals($str)
	{
		if(!is_string($str) && !(is_object($str) && get_class($str) == __CLASS__))
			throw new OrionException(sprintf("%s passado ao método %s::equals, deveria ser uma string ou instancia de OrionString.", ucfirst(strtolower(gettype($str))), __CLASS__), OrionError::TYPE_STRING);
		
		return strcmp($this->value, is_object($str) ? $str->value : $str) == 0 ? TRUE : false;
	}
	
	public function substring($start, $length = false)
	{
		if(!is_integer($start))
			throw new OrionException(sprintf("%s passado ao método %s::substring, deveria ser um inteiro.", ucfirst(strtolower(gettype($start))), __CLASS__), OrionError::TYPE_STRING);
		elseif(!is_integer($length) && $length != false)
			throw new OrionException(sprintf("%s passado ao método %s::substring, deveria ser um inteiro.", ucfirst(strtolower(gettype($length))), __CLASS__), OrionError::TYPE_STRING);
			
		return $length == false ? substr($this->value, $start) : substr($this->value, $start, $length);
	}
	
	public function htmlEntities($quote_style = ENT_QUOTES, $charset = "UTF-8")
	{
		
		return htmlentities($this->value, $quote_style, $charset);
	}
	
	public function __toString()
	{
		return $this->value;
	}
	
	public function toBin()
	{
		$bin = array();
		for($i=0;$i<strlen($this->value);$i++)
		{
			$bin[$i] = decbin(ord($this->value[$i]));
			switch(strlen($bin[$i]))
			{
				case 0:
				case 1:
					$bin[$i] = '0000000'.$bin[$i];
					break;
				case 2:
					$bin[$i] = '000000'.$bin[$i];
					break;
				case 3:
					$bin[$i] = '00000'.$bin[$i];
					break;
				case 4:
					$bin[$i] = '0000'.$bin[$i];
					break;
				case 5:
					$bin[$i] = '000'.$bin[$i];
					break;
				case 6:
					$bin[$i] = '00'.$bin[$i];
					break;
				case 7:
					$bin[$i] = '0'.$bin[$i];
					break;
				case 8:
					break;
			}
		}
		$bin = implode("",$bin);
		
		return $bin;
	}
}