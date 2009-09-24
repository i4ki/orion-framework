<?php
/*
 * Created on 17/05/2009
 *
 * @author Tiago Natel de Moura
 * @email tiago_moura@live.com
 */
 /**
  * SISTEMA DEFAULT DO FUNCIONAMENTO DAS URLS.
  * Esse modo à url deve ser pega por _GET e deve ser tratada para segurança
  */

 class OrionCommand_Info_Default implements OrionCommand_Info {
 	// Retorna o valor do Module contido no GET
 	public function getModule() {
 		return $_GET['module'];
 	}

 	// Retorna o valor da Action contida no GET
 	public function getAction() {
 		return $_GET['action'];
 	}
	
	public function getArray()
	{
		return $_GET;
	}
 }