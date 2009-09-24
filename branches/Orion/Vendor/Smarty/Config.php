<?php
/**
  * Created on 17/05/2009
  *
  * @author Tiago Natel de Moura
  * email: tiago_moura@live.com
  */

 require_once("Smarty.class.php");

 /**
  * Arquivo de configuração do Smarty
  * Esta classe instancia o Smarty e seta as configurações
  * padrões.
  * As configurações são resgatadas da classe Config em /Libs/Config.php
  *
  * @version 0.1
  */
  class Smarty_Config extends Smarty {
		protected $smarty;
		public $dirTemplates;

		/**
		 * Construtor
		 */
		public function __construct( $path = NULL ) {

			$this->Smarty();

			$this->dirTemplates = (!empty($path))?$path:DIR_TEMPLATE_ADMIN;

			$this->template_dir = $this->dirTemplates . "templates/";
			$this->compile_dir = $this->dirTemplates . "templates_c/";
			$this->cache_dir = $this->dirTemplates . "cache/";
			$this->config_dir = $this->dirTemplates . "configs/";

			$this->force_compile = true;
			$this->debugging = false;

			$this->left_delimiter = "{";
			$this->right_delimiter = "}";

			/*
			 * Variáveis Smarty por Default
			 */
			 $this->assign("SYSTEM_NAME",Config::SYSTEM_NAME);
			 $this->assign("FRAMEWORK_NAME",Config::FRAMEWORK_NAME);
			 $this->assign("CLIENTE",Config::CLIENTE);
			 $this->assign('pathAdmin',Config::URL . "View/Admin/Hitcentre/templates/");
			 $this->assign('URL', Config::URL);
		}
  }