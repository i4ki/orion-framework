<?php

/**
 * @author Tiago Natel de Moura
 * 
 * Classe de configuração do módulo DynamicJS
 */

class DynamicJS_Config extends DynamicJS_Manager {
	
	public function __construct() {
		define('DIR_DYNAMICJS_DESKTOP', DIR_VIEW  . 'scriptaculo' . DIRECTORY_SEPARATOR);
		
		$this->configureDynamicJS();
	}
	
	protected function configureDynamicJS() {
				
		/**
		 * Configura a area de trabalho
		 */
		$this->setDesktop(DIR_DYNAMICJS_DESKTOP);
		
		/**
		 * Configura o diretorio de arquivos compilados
		 */
		$this->setCompiledJS(DIR_LIBS . 'DynamicJS/CompiledJS');
		$this->setURLCompiledJS( Config::URL . 'Libs/DynamicJS/CompiledJS');
				
		/**
		 * Ajusta variáveis padrões
		 */
		$this->assign('URL', Config::URL);
		$this->assign('pathAdmin', Config::URL . "View/Admin/Hitcentre/templates/");
		return $this;
	}
}