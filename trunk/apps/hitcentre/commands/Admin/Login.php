<?php

/**
 * @author Tiago Moura
 */

class LoginCommand 
	extends Security_Hitcentre_Admin 
		implements OrionICommand {
	protected $manager;
	protected $objUser;
	protected $user;
	
	public function __construct() 
	{
		$this->defaultOperations();
		
		parent::__construct();
		
		/**
		 * Shutdown All Sessions
		 */
		Security_Restricted::shutdownAllSessions();
	}
	
	public function execute() {
		if( !empty($_POST) && isset($_POST) && !empty($_POST['csrf'])) {			
			$this->login();
		}
		
		$config = new Config();
		/**
		 * Cria uma seção com o hash do user_agent do usuário
		 * para verificar se é o usuário ou um hacker usando
		 * csrf ou xss script
		 * 
		 */
		$key = Security_Restricted::generateUniqueKEY('anonymous', 'anonymous');
				
		$smarty = new Smarty_Config();
		$smarty->assign('url', 'Admin/Login');
		$smarty->assign('title', 'Área Restrita');
		$smarty->assign('key',$key);
		$smarty->display('login.tpl');
	}
	
	/**
	 * Ajusta configurações padrões
	 *
	 */
	public function defaultOperations() {
		OrionTools_Geral::setHeader();
		$this->getInstanceModules();
	}
	
	/**
	 * Instancia dos módulos e bibliotecas
	 *
	 */
	public function getInstanceModules() {
		$this->manager = new OrionORM_Doctrine();
	}
	
	public function login() {
		
		$date = date('Y-m-d H:i:s');
		/**
		 * Data e hora de login na session
		 */
		$_SESSION['login_date'] = $date;
		$_POST = Security_Secure::secure( $_POST );
		
		if( $_POST['csrf'] != $_SESSION['anonymous'] ) {
			$ident = new Security_Ident();
			$ident->saveAtack();
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Login');
		}
		
		
		/**
		 * Busca o usuário
		 */
		$q = 	Doctrine_Query::create()
				->select('u.*');
		
		/**
		 * Atualiza a data do ultimo login do usuário 
		 */
		$q2 = 	Doctrine_Query::create();
		
		if ( $_POST['tipo'] == 1 || $_POST['tipo'] == '1' ) {
			$q->from('Admin u');
			$q2->update('Admin');
		} elseif ( $_POST['tipo'] == 0 || $_POST['tipo'] == '0' ) {
			$q->from('User u');
			$q2->update('User');
		} else {
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Login');
		}
		//print md5($_POST['rsa_senha'] . Config::encryptPass());
		//exit();
		$q->where('u.username = ? and u.password = ?',array($_POST['rsa_user'], md5($_POST['rsa_senha'] . Config::encryptPass())));
		//print $q->getSql();
		$this->objUser = $q->execute();
		$this->user = $this->objUser->toArray();
		
		/**
		 * Se existe o usuário, gerar a chave única e a seção e redirecionar
		 * para o admin
		 */
		if( count($this->user) == 1 ) {
			$q2	->set('last_login','?',$date)
				->set('last_iteration','?',$date)
				->where('id = ?', array($this->user[0]['id']));
		
			$q2->execute();
				
			$key = $this->user[0]['username'] . '--';
			$key .= Config::SECRET_KEY;
			$uniqueKEY = Security_Restricted::generateUniqueKEY($key, 'user', $date);
			
			$_SESSION['key'] = $uniqueKEY;
			unset($key);
			unset($uniqueKEY);
			
			$this->setSessionForUser();
			
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Users');
		}	
	}
	
	public function getAction() {
		
	}
	
	public function setSessionForUser() {
		$_SESSION['id'] 		= $this->user[0]['id'];
		$_SESSION['username']	= $this->user[0]['username'];
		$_SESSION['firstname'] 	= $this->user[0]['firstname'];
		$_SESSION['lastname']	= $this->user[0]['lastname'];
		$_SESSION['email']		= $this->user[0]['email'];
		$_SESSION['tipo_user']  = $_POST['tipo'];
		return $_SESSION;
	}
}