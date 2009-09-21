<?php
/*
 * Created on 17/05/2009
 *
 * @author Tiago Natel de Moura
 * @email tiago_moura@live.com
 */

/**
 * Classe IndexCommand de criação da Area Restrita do sistema
 *
 * @version 0.1
 */
 class IndexCommand extends Security_Hitcentre_Admin {
 	public $content;
 	protected $smarty;
 	protected $doctrine;
	
 	
 	/**
 	 * Construtor da área restrita, instanciar Security sempre no construtor
 	 * 
 	 * @param array $data
 	 */
 	public function __construct( $data ) {
  		
 		$this->data = array_map('strtolower',$data);
 		
 		parent::__construct();
 		
  		$this->defaultOperations();  		
  	}
  	
  	/**
  	 * Executa as operações padrões da classe, sem saturar o __construct()
  	 *
  	 */
  	public function defaultOperations() {
  		
  		$this->getInstanceModules();
  		$this->validUser();  		
  	}
  	
  	public function getInstanceModules() {
  		$this->doctrine = new OrionORM_Doctrine();
  	}
  	
 	public function execute() {
		$config = new Config();
		// Seta o diretório do Template
		
 		$this->smarty = new Smarty_Config();
 		

		// Seta as variáveis de Template
 		$this->smarty->assign("titulo", ":: SISTEMA DE GERENCIAMENTO DE PORTAL ::");
 		$this->smarty->assign("conteudo","Esta é a área restrita");
 		$this->smarty->assign('url','Admin/Index');
 		$this->smarty->assign('session',$_SESSION);

		// Mostra o template
		$this->smarty->display("index.tpl");
		
		
						
 	}
 	
 	public function getOption() {
 		
 	}
 }