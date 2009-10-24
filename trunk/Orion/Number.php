<?php

abstract class OrionNumber
{
	public function intValue()
	{
		return (integer) $this->value;
	}
	
	public function floatValue()
	{
		return (float) $this->value;
	}
	
	public function doubleValue()
	{
		return (double) $this->value;
	}
	
	public function byteValue()
	{
	
	}
}