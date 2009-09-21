<?php

/**
 * @author Tiago Natel de Moura
 * 
 * Classe de configuração do módulo DynamicLang
 */

class DynamicLang_Config extends DynamicLang_Manager {
	
	public function __construct( $str = false ) {
		
		if ($str != false) {
			parent::__construct( $str );	
		}	
				
		$this->configureDynamicLang();
	}
	
	protected function configureDynamicLang() {
				
		/**
		 * Configura o diretorio de arquivos compilados
		 */
		$this->setCompiledTarget(DIR_LIBS . 'DynamicLang/Compiled');
		$this->setURLCompiledTarget( Config::URL . 'Libs/DynamicLang/Compiled');
				
		/**
		 * Ajusta variáveis padrões
		 */
		$this->assign('URL', Config::URL);
		$this->assign('pathAdmin', Config::URL . "View/Admin/Hitcentre/templates/");
		$this->setTag('@#>','<#@');
		
		$this->createPatternForTags();
		return $this;
	}
}