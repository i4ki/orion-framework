<?php

/**
 *  Mock da classe Rewrite em Command_Info_Rewrite
 */

 class Command_Info_RewriteMock implements Command_Info {
 	private $gets;

 	public function setVars() {
 		$this->gets = array(
 							0 => "index",
 							1 => "index",
 							2 => "teste"
 							);
 	}

 	public function getModule() {
		return $this->gets[0];
 	}

 	public function getAction() {
 		return $this->gets[1];
 	}

 	public function getData() {
 		return $this->gets[2];
 	}

 	public function getArray() {
     	return $this->gets;
    }

    public function getVarByIndex( $ind ) {
      	return $this->gets[$ind];
    }

 }