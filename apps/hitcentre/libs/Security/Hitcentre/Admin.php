<?php

/**
 * Classe de controle da área restrita do admin
 *
 */
class Security_Hitcentre_Admin 
	extends Security_Restricted 
		implements Security_iRestrictedArea {
			
	protected $user;
	protected $arrUser;
	protected $uniqueKEY;
	
	public function __construct() {
		
		parent::__construct();
		$config = new Config();
		$this->blockDirectAccessInURL();
		
	}
	
	public function redirLogin() {
		if (isset($this->arrURL[0]) && $this->arrURL[0] == 'admin' && isset($this->arrURL[1]) && $this->arrURL[1] == 'login') {
			return true;
		} else {
			OrionTools_Geral::redirect( Orion::getAttribute( Orion::ATTR_HOST ) . 'Admin/Login', 'html');
			return false;
		}		
	}
	
	/**
	 * Válida o usuário dentro do admin
	 *
	 * @return unknown
	 */
	public function validUser() {
		/**
		 * Cria uma nova chave, se for outro 
		 * user_agent (outro usuário nessa seção) desloga-se.
		 */
		$_SESSION['username'] 	= 	!empty($_SESSION['username']) 	? 
									$_SESSION['username'] 			: '';
		$_SESSION['login_date']	= 	!empty($_SESSION['login_date'])	? 
									$_SESSION['login_date']			: '0000-00-00 00:00:00';
		$_SESSION['key']		= 	!empty($_SESSION['key'])		? 
									$_SESSION['key']				: '';
	
		$newKey = $this->generateUniqueKEY(
							$_SESSION['username'] . '--' . Config::SECRET_KEY,
							'newKey',
							$_SESSION['login_date'],
							false
						);
		
		if ( $_SESSION['key'] != $newKey ) {
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Login');
		} else return true;
	}
	
	/**
  	 * Pega o usuário (ou os usuários) atualmente logado(s)
  	 *
  	 */
  	protected function getUserLogged( $all = false ) {
  		if ($all == false) {
  			
  			/**
  			 * O usuário logado nessa seção
  			 */
  			$q = 	Doctrine_Query::create()
  				->select('u.*');
	  		if( isset($_SESSION['tipo_user']) && $_SESSION['tipo_user'] == 0 ) {
	  			$q->from('User u');
	  		} elseif ( isset($_SESSION['tipo_user']) && $_SESSION['tipo_user'] == 1 ) {
	  			$q->from('Admin u');
	  		}
	  		  		
	  		$q->where('u.id = ?',array($_SESSION['id']));
	  		$this->user = $q->execute();
	  		$this->arrUser = $this->user->toArray(true);
	  		if( count($this->arrUser) == 1 )
	  			return $this->arrUser;
	  		else {
	  			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Login');
	  			return false;
  			}	
  		} else {
	  		/**
			 * Busca todos os dados do usuário logado
			 */
			$q = 	Doctrine_Query::create()
					->select('u.*, g.name,c.name,s.name,cy.name');
			if( $_SESSION['tipo_user'] == 0 ) {
				$q->from('User u');
			} elseif ( $_SESSION['tipo_user'] == 1 ) {
				$q->from('Admin u');
			} else {
				OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Login');
				return false;
			}
			
			$q	->leftJoin('u.Group g')
				->leftJoin('u.Country c')
				->leftJoin('u.State s')
				->leftJoin('u.City cy')
				->where('u.id = ?',array($id));
			
			$this->user = $q->execute();
			$this->arrUser = $this->user->toArray(true);
			if ( count($this->arrUser) == 1 ) {
				OrionTools_Debug::debugArray($user->toArray(true));
				return $this->arrUser;
			} else {
				return false;
			}		
  		}	
  	}
  	
  	/**
  	 * Bloqueia o acesso direto à classes do sistema
  	 * Estas classes são especificadas pelo array $block
  	 * passado ao método.
  	 * 
  	 * Formato do Array:
  	 * 
  	 * $block = array(
  	 * 				'Admin/Manager',
  	 * 				'Admin/Configuration_Internals',
  	 * 				'Admin/Classe_Sem_Acesso_Pela_URL'
  	 * 			);
  	 *
  	 * @param array $block
  	 */
  	protected function blockDirectAccessInURL() {
  		$block = Config::getBlockedsURLs();
  		$url = "";
  		for ($i=0;$i<count($block);$i++) {
  			$urlb = explode('/', $block[$i]);
  			$urlb = array_map('strtolower',$urlb);
  						
  			if (isset($this->arrURL[7]) && ($this->arrURL[7] == 'Ajax' || $this->arrURL[7] == 'ajax')) {
  				return true;
  			} elseif ($urlb[count($urlb)-1] == @$this->arrURL[count($urlb)-1]) {
  				header('Location: '.Orion::getAttribute(Orion::ATTR_HOST));
  			}
  		}
  	}
}