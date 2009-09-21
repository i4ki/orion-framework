<?php

/**
 * @author Tiago Natel de Moura
 * 
 * Classe de configuração do módulo DynamicJS
 */

class DynamicJS_Config extends DynamicJS_Manager {
	
	public function __construct() {
		parent::__construct();
		define('DIR_DYNAMICJS_DESKTOP', Orion::getPathProject() . Orion::getAttribute(Orion::ATTR_DIR_VIEW) . DIRECTORY_SEPARATOR . 'scriptaculo' . DIRECTORY_SEPARATOR);
		
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
		$this->setCompiledJS( Orion::getPathProject() . DIRECTORY_SEPARATOR . Orion::getAttribute(Orion::ATTR_DIR_LIBS) . DIRECTORY_SEPARATOR . 'DynamicJS/CompiledJS');
		$this->setURLCompiledJS( Orion::getProjectURL() . Orion::getAttribute(Orion::ATTR_DIR_LIBS) . DIRECTORY_SEPARATOR . 'DynamicJS/CompiledJS');
				
		/**
		 * Ajusta variáveis padrões
		 */
		$this->assign('URL', Orion::getAttribute(Orion::ATTR_HOST));
		$this->assign('pathAdmin', Orion::getProjectURL() . "view/Admin/Hitcentre/templates/");
		return $this;
	}
}