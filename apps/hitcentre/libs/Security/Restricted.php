<?php

/**
 * @author Tiago Natel de Moura
 * Classe de Segurança do Sistema de Permissões
 */

class Security_Restricted extends OrionCommand {
	protected $user;
	protected $uniqueKEY;
	protected $url;
	protected $arrURL = array();
	
	public function __construct() {
		
		if (!headers_sent()) {
			OrionTools_Geral::setHeader();
		}
		/**
		 * Inicia a seção se ainda não foi iniciada
		 */
		if( $this->sessionIsRegistered() === false ) {
			$this->startSession();
		}
		$this->setURL();
		
		/**
		 * Verifica se o usuário está logado
		 */
		$this->isLogged();
		
		/**
		 * Filtra as variáveis globais
		 */
		$this->securityGlobalVars();
	}
	
	public function execute()
	{
	
	}
	
	public function getAction()
	{
	
	}
	
	/**
	 * Inicia a seção
	 *
	 * @param integer $id
	 * @param bool $regenerate
	 * @param bool $delete_old_session
	 */
	public static function startSession( $id = null, $regenerate = false, $delete_old_session = false ) {
		if($regenerate == false) {
			session_start( $id );
		}
		if (!headers_sent()) {
			session_regenerate_id( $delete_old_session );	
		}
		$_SESSION['session_id'] = session_id();
	}
	
	
	public static function shutdownAllSessions() {
				
		if (isset($_SESSION['anonymous'])) {
			$key = $_SESSION['anonymous'];	
		}
		
		$_SESSION = array();		
		
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(),'',time()-1000,'/');
		}
		
		Security_Restricted::startSession('admin',true);
		
		if ( isset($key) ) {			
			$_SESSION['anonymous'] = $key;	
		}
		
		return $_SESSION;
	}
	
	public function shutdownSessionByKey( $key ) {
		unset( $_SESSION[$key] );
	}
	
	/**
	 * Verifica se a seção está iniciada
	 *
	 * @return BOOLEAN
	 */
	public function sessionIsRegistered() {
		if( isset($_SESSION) == false && empty($_SESSION) ) {
			return false;
		} else return true;
	}
	
	/**
	 * Ajusta as variáveis de URL
	 *
	 */
	public function setURL() {
		/**
		 * Pega a url
		 */
		$this->url = new OrionCommand_Info_Rewrite();
		$this->arrURL = $this->url->getArrayToLower();
	}
	
	/**
	 * Verifica se o usuário está logado no sistema
	 *
	 * @return BOOLEAN
	 */
	public function isLogged() 
	{
		
 		if( isset($_SESSION['key']) && !empty($_SESSION['key']) )
		{
			$doctrine = new OrionORM_Doctrine();
			$table = Doctrine::getTable('User');
			$user = $table->findOneByUsername($_SESSION['username']);
			$user->last_iteration = date('Y-m-d h:i:s');
			$user->save();
			return true;
 		} else {
			//if(Orion::getAttribute(Orion::ATTR_DEBUG) == true)
				//OrionTools_Debug::debugArray($_SESSION, true, true, true, true);
 			$this->redirLogin();
 			return false;
 		}
 	}
 	
 	/**
 	 * Método sobrescrito pelos métodos das classes extendidas
 	 *
 	 */
 	public function redirLogin() {
 		
 		switch ($this->arrURL[0]) {
 			case 'admin':
 				print "putzzz";
 				$this->loginAdmin();
 				break;
 			case 'usuario':
 				$this->loginUser();
 				break;
 			case 'teacher':
 				$this->loginTeacher();
 				break;
 			default:
 				$this->loginUser();
 				break;
 		}
 	}
 	/**
 	 * Gera uma chave única para comunicação entre o browser
 	 * e a aplicação, para sanar multiplos ataques relacionados à
 	 * seção e cookies...
 	 *
 	 * @param string $str
 	 * @param string $date
 	 * @return string
 	 */
 	public static function generateUniqueKEY( 	$str, 
 												$id = false, 
 												$date = false, 
 												$session = true 
 											) {
 		$id = $id != false ? $id : $str;
 		if( $date == false ) {
 			$date = date('Y-m-d H:i:s');
 		}
 		
 		$hash_date = md5($date . Config::SECRET_KEY);
 		$hash_str = md5($str . Config::SECRET_KEY);
 		$hash_useragent = Security_Restricted::generateKeyForUserAgent();
 		
 		// 50 caracteres, para confundir o atacante...
 		$key = substr($hash_date,0,9).substr($hash_str,0,9).$hash_useragent;
 		
 		if ( $session == true ) {
 			$_SESSION[$id] = $key;	
 		} 		
 		
 		return $key;
 	}
 	
 	
 	/**
 	 * Amenizando ataques XSS Script e CSRF...
 	 * São somente precauções para um ataque ainda sem muitas
 	 * soluções de segurança ¬¬
 	 * 
 	 * Pega-se o USER AGENT do usuário no momento de preencher
 	 * o formulário de login e cria-se o hash. Se houver o roubo 
 	 * da seção de qualquer dos modos, seja XSS ou CSRF nós obrigamos
 	 * o atacante ser mais engenhoso ainda e acertar o user agent
 	 * da sua vítima. Infinitamente mais fácil pra ele usar 
 	 * tentativa e erro com requisições de user agents diferentes.
 	 * Mas se for um kiddie ele vai parar aqui!
 	 * 
 	 * @param string $user_agent
 	 */
 	 	
 	public static function generateKeyForUserAgent( $user_agent = null ) {
 		if( $user_agent == null ) {
 			$user_agent = $_SERVER['HTTP_USER_AGENT'];
 		}
 		
 		$key = md5($user_agent . Config::SECRET_KEY);
 		$_SESSION[base64_encode('USER_AGENT')] = $key;
 		return $key;
 	}
 	
 	protected function securityGlobalVars() {
 		//$_POST 		= Security_Secure::secure($_POST);
 		$_COOKIE 	= Security_Secure::secure($_COOKIE); 		
 	}
 	
}