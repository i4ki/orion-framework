<?php

class OrionInteger extends OrionNumber
{
	public $value;
	public $val;
	public $size;
	
	public function __construct($int = false)
	{
		if(!$int)
			$this->value = 0;
		elseif(is_integer($int))
			$this->value = $int;
		elseif(is_object($int) && get_class($int) == __CLASS__)
			$this->value = $int->value;
		else
			throw new OrionException(sprintf("%s passado para o construtor de %s, deveria ser um inteiro.", ucfirst(strtolower(gettype($int))), __CLASS__), OrionError::TYPE_INTEGER);
		$this->val = &$this->value;
		$this->size = &$this->value;
		$this->value = $int;
	}
	
	public static function __s($int)
	{
		return new self($int);
	}
	
	public function value()
	{
		return $this->value;
	}
	
	/**
	 * Add
	 * @class OrionInteger
	 * @scope public
	 * @param $add1 [, $add2, $add3, $add4, ...]
	 * @return 
	 */
	public function add()
	{
		$argc = func_num_args();
		$argv = func_get_args();
		
		for($i=0;$i<$argc;$i++)
			$this->value += $argv[$i];
		
		return $this->value;
	}
	
	public function sub()
	{
		$argc = func_num_args();
		$argv = func_get_args();
		
		for($i=0;$i<$argc;$i++)
			$this->value -= $argv[$i];
		
		return $this->value;
	}
	
	public function toString()
	{
		return sprintf("%s", $this->value);
	}
	
	public function decode($str)
	{
		
	}
	
	public function floatValue($precision = 2)
	{
		return (float) sprintf("%01.".$precision."f", $this->value);
	}
}