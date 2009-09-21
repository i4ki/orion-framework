<?php

/**
 * Interface das classes de Controle das áreas restritas
 */

interface Security_iRestrictedArea {
	/**
	 * Método responsável por redirecionar para o login das áreas restritas
	 */
	public function redirLogin();
	
	
}