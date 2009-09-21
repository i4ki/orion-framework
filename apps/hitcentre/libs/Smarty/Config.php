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

			$this->dirTemplates = 	(!empty($path)) ? 
									$path : 
									Orion::getAttribute( Orion::ATTR_DIR_APPS ) . DIRECTORY_SEPARATOR .
									Orion::getAttribute( Orion::ATTR_PROJECT ) . DIRECTORY_SEPARATOR .
									Orion::getAttribute( Orion::ATTR_DIR_VIEW) . DIRECTORY_SEPARATOR .
									Orion::getAttribute( Config::ATTR_DIR_TEMPLATES_ADMIN ) . DIRECTORY_SEPARATOR;
			
			$this->template_dir = $this->dirTemplates . "templates/";
			$this->compile_dir = $this->dirTemplates . "templates_c/";
			$this->cache_dir = $this->dirTemplates . "cache/";
			$this->config_dir = $this->dirTemplates . "configs/";
			
			$this->force_compile = true;
			$this->debugging = false;

			$this->left_delimiter = "{";
			$this->right_delimiter = "}";
			
			if	( 	Orion::getAttribute( Orion::ATTR_ENV ) == Orion::ATTR_ENV_DEV || 
					Orion::getAttribute( Orion::ATTR_ENV ) == Orion::ATTR_ENV_TEST
				)
				$this->compile_check = true;
			else
				$this->compile_check = false;

			/*
			 * Variáveis Smarty por Default
			 */
			 try
			 {
				$q = 	Doctrine_Query::create()
						->select('c.default_title, c.meta_description, c.meta_keywords')
						->from('ConfigPortal c')
						->where('id = ?', array(1));
				$configs = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
			} catch( Doctrine_Connection_Mysql_Exception $e )
			{
				if(OrionMagic::getEnvironment() == Orion::ATTR_ENV_DEV)
				{
					print "Houve um erro na Query DQL<br>";
					print "Mensagem portável: " . $e->getPortableMessage() . "<br>";
					print "Código portável: " . $e->getPortableCode() . "<br>";
					print "Mensagem do banco: " . $e->getMessage() . "<br>";
					print "Cod.: " . $e->getCode() . "<br>";
				}
			}
			
			$configs = $configs[0];
	
			$this->assign("SYSTEM_NAME",Config::SYSTEM_NAME);
			$this->assign("FRAMEWORK_NAME",Config::FRAMEWORK_NAME);
			$this->assign("CLIENTE",Config::CLIENTE);
			$this->assign('pathAdmin',Orion::getProjectURL() . "view/Admin/Hitcentre/templates/");
			$this->assign('URL', Orion::getAttribute(Orion::ATTR_HOST));
			$this->assign('default_title', $configs['default_title']);
			$this->assign('meta_description', $configs['meta_description']);
			$this->assign('meta_keywords', $configs['meta_keywords']);
		}
  }