<?php

/**
 * @author Tiago natel de Moura
 * 
 * Classe de configuração das seções do sistema:
 * 
 * Configurações:
 * * Portal
 * * Escola
 * * Administradores
 * * Promoções 
 */

class ConfigCommand 
	extends Security_Hitcentre_Admin 
{
	/**
	 * usuário atualmente logado
	 *
	 * @var OBJECT
	 */
	protected $user;
	
	/**
	 * Instancia do smarty template
	 *
	 * @var OBJECT
	 */
	protected $smarty;
	
	/**
	 * Instancia do doctrine
	 *
	 * @var OBJECT
	 */
	protected $doctrine;
	
	/**
	 * Array com os parametros da URL
	 *
	 * @var array
	 */
	protected $data = array();
	
	/**
	 * Orion Magic info's
	 */
	protected $info;
	
	
	public function __construct( $data ) {
		
		parent::__construct();
		$this->data = array_map('strtolower',$data);
		
		$this->defaultOperations();
	}
	
###############################################
	# Métodos da Interface Command
	
	/**
	 * Operações padrões
	 *
	 */
	public function defaultOperations() {
		OrionTools_Geral::setHeader(); 	
		
		$_POST = isset($_POST) ? array_map('addslashes',$_POST) : false;	
  		
  		$this->validUser();
  		
  		$this->getInstanceModules();
  		
  		$url = 	ucfirst($this->data[0]) . '/' . ucfirst($this->data[1]) . 
				(isset($this->data[2]) ? '/' . ucfirst($this->data[2]) : '');
			 		
  		$this->smarty->assign('url',$url);
  		$this->smarty->assign('title','Hit Centre of Language');
		$this->smarty->assign('header','Hit Centre of Language');
		$this->smarty->assign('session',$_SESSION);
  		
  		$this->groups_js->setJS('Admin/groups.js');  		
  		
  		$this->getUserLogged();
  		
  		return;
	}
	
	public function getInstanceModules() {
		/**
  		 * Doctrine
  		 */
  		$this->doctrine = new OrionORM_Doctrine();
  		
  		/**
  		 * DynamicJS
  		 */
  		$this->groups_js 	= new DynamicJS_Config();
  		
  		/**
  		 * Inicia o mecanismo de template
  		 */
  		$this->smarty = new Smarty_Config();
		
		$this->info = new OrionMagic();
  		
	}
	
	/**
	 * Método principal do command
	 *
	 */
	public function execute() {	
		
		if( !isset($this->data[2]) )	{
			$this->data[2] = '';
		}		
		$this->getOption();
		
		return;
	}
	
	/**
	 * Opção
	 *
	 */
	public function getOption() {
		switch ($this->data[2]) {
			case 'portal':
				$this->portal();
				break;
			case 'school':
				$this->school();
				break;
			case 'administrators':
				$this->administrators();
				break;
			case 'promotions':
				$this->promotions();
				break;	
			default:
				$this->portal();
				break;
		}
		
		return;
	}
	# Fim da Intercade Command
################################################
	
	/**
	 * Se não specificado qual a ação em Config
	 *
	 */
	protected function main() {
		$this->smarty->display('config.tpl');
		return;
	}
	
	protected function portal() {
		
		/**
		 * Verifica a operação
		 */
		$this->data[3] = isset($this->data[3]) ? $this->data[3] : '';
		if( $this->data[3] == 'save' ) {
			$this->saveDataPortal();
		} else {
			$q = 	Doctrine_Query::create()
					->select('p.*')
					->from('ConfigPortal p')
					->where('p.id = ?',array(1));
			$portal = $q->execute(array(),Doctrine::HYDRATE_ARRAY);
			$portal = $portal[0];
			
			/**
			 * Smarty
			 */
			$this->smarty->assign('portal',$portal);
			$this->smarty->display('configPortal.tpl');
		}
	}
	
	protected function saveDataPortal() {	
		
		reset($_POST);
		try {
			$q = 	Doctrine_Query::create()
					->update('ConfigPortal');
			for ($i=0;$i<count($_POST);$i++) {
				$q->set(key($_POST),'?',current($_POST));
				next($_POST);
			}
			$q->where('id = ?',array(1));
			
			$portal = $q->execute();
		} catch (Doctrine_Connection_Mysql_Exception $e) {
			print $e->getMessage();
		}
		if (isset($portal)) {
			OrionTools_Geral::redirect($this->info->getUrlForHost() . 'Admin/Config/Portal');
		} else {
			OrionTools_Geral::alert("Verifique novamente os dados");		
			OrionTools_Geral::back();
		}
	}
	
	protected function school() {
				
		if (isset($_POST) && !empty($_POST)) {
			$this->saveDataSchool();
		} else {
			$q = 	Doctrine_Query::create()
					->select('s.*')
					->from('ConfigSchool s')
					->where('s.id = ?',array(1));
			$school = $q->execute(array(),Doctrine::HYDRATE_ARRAY);
			$school = $school[0];
			/**
			 * Smarty
			 */
			$this->smarty->assign('school',$school);
			$this->smarty->display('configSchool.tpl');
		}
	}
	
	protected function saveDataSchool() {
		
		reset($_POST);
		
		$q = 	Doctrine_Query::create()
				->update('ConfigSchool')
				->set('company_name','?',$_POST['company_name'])
				->set('commercial_name','?',$_POST['commercial_name'])
				->set('cnpj','?',$_POST['cnpj'])
				->set('street','?',$_POST['street'])
				->set('district','?',$_POST['district'])
				->set('country_id','?',$_POST['country'])
				->set('state_id','?',$_POST['state'])
				->set('city_id','?',$_POST['city'])
				->set('zip','?',$_POST['zip'])
				->set('telefone','?',$_POST['telefone'])
				->set('telefone_fax','?',$_POST['telefone_fax'])
				->set('email_main','?',$_POST['email_main']);
		$q->where('id = ?',array(1));
		
		$school = $q->execute();
		if (isset($school)) {
			OrionTools_Geral::redirect(Config::URL . 'Admin/Config/School');
		} else {
			OrionTools_Geral::alert("Verifique novamente os dados");		
			OrionTools_Geral::back();
		}
		
		
	}
	
	protected function administrators() {
		/**
		 * Smarty
		 */
		$this->smarty->display('configAdmin.tpl');
	}
	
	protected function promotions() {
		/**
		 * Smarty
		 */
		$this->smarty->display('configPromotions.tpl');
	}
}