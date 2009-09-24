<?php
/*
 * #################################################
 * #################################################
 * ##########         INTERFACE         ############
 * #################################################
 *
 * @author Tiago Natel de Moura
 * @email tiago_moura@live.com
 */

 interface OrionCommand_Info {
 	// Método que retorna o método
 	public function getModule();

 	// Método que retorna a Action
 	public function getAction();
 }