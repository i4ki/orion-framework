<?php
/*
 * Created on 14/06/2009
 *
 * @author Tiago Natel de Moura
 */
 

 
 require_once(Orion::getPathProject() . 'libs/Upload/class.upload.php');

 /**
  * Classe UsuariosCommand que controla a página de controle de acesso
  * do sistema.
  *
  * @version 0.1
  *
  */

class UsersCommand 
	extends Security_Hitcentre_Admin 
 {
			
	protected 	$user;
	protected 	$arrUser = array();
  	protected 	$smarty;
	public 		$groups_js;
  	protected 	$doctrine;
  	protected 	$js;
  	protected 	$data = array();

  	public function __construct( $data ) {
  		 
  		$this->data = array_map('strtolower',$data);
  		
  		parent::__construct();
  		
  		/**
  		 * Executa as operações padrões 
  		 */
  		$this->defaultOperations();
  		  		
  	}
  	
  	/**
  	 * Executa operações padrões dos módulos
  	 *
  	 */
  	public function defaultOperations() {
  		OrionTools_Geral::setHeader();
  		
  		$this->getInstanceModules();  		
  		$this->validUser();  		
  		
  		$this->groups_js->setJS('Admin/groups.js');  		
  		
  		$this->getUserLogged();
		
		$info = new OrionMagic();
				
		
		$this->smarty->assign('url','Admin/Users');
		$this->smarty->assign('title','Hit Centre of Language');
		$this->smarty->assign('header','Hit Centre of Language');
		$this->smarty->assign('session',$_SESSION);
  	}
  	
  	public function getInstanceModules() {
		
		$configs = new Config();
		
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
		
  	}
  	
  	/**
  	 * Método para me salvar se caso de pau no Doctrine e eu 
  	 * não der jeito
  	 * 
  	 * Logo logo, vai ser deletado!!! ;)
  	 */
  	public function connectByPDO() {
  		$host = Config::HOST;
  		$user = Config::USER;
  		$pass = Config::PASS;
  		$database = Config::DATABASE;
  		
  		mysql_connect($host,$user,$pass);
  		mysql_select_db($database);
  		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
  	}

  	public function execute() {
  		
		
		
		if( !isset($this->data[2]) )	{
			$this->data[2] = '';
		}		
		$this->getOption();
  	}
  	
  	

  	public function getOption() {
  		
  		switch($this->data[2]) {
  			case "adduser":
  				$this->addUser();
  				break;
  			case "profile":
  				$this->profile();
  				break;
  			case "edituser":
  				$this->editUser();
  				break;
  			case "deleteuser":
  				$this->deleteUser();
  				break;
  			case "groups":
  				$this->groups();
  				break;
  			case "search":
  				$this->searchUser();
  				break;
  			case "usersonline":
  				$this->usersOnline();
  				break;
  			case "tools":
  				$this->tools();
  				break;
  			case "myaccount":
  				$this->myAccount();
  				break;
			case "notificar":
				$this->notificar();
				break;
  			default:
  				$this->usuarios();
  				break;
  		}
  	}
  	
  	public function usuarios() {
		//OrionTools_Debug::debugArray($this->data, true, true, true, true);
		$resultsPerPage = !empty($this->data[2]) && $this->data[2] > 0 ? $this->data[2] : 10;
		$page			= !empty($this->data[3]) && $this->data[3] > 0 ? $this->data[3] : 1;
		//OrionTools_Geral::alert($resultsPerPage);
		//OrionTools_Geral::alert($page);
  		$orderby 	= !empty($this->data[5]) 	? $this->data[5] : 'id';
		$order		= strtoupper( !empty($this->data[6])	? $this->data[6] : 'ASC' );
################################################
		# BUSCA OS USUÁRIOS
		
		$pager = new Doctrine_Pager(
				Doctrine_Query::create()
					->select('u.*, CONCAT(u.firstname, \' \', u.lastname) AS name, g.name AS group')
					->from('User u')
					->leftJoin('u.Group g')
					->orderby(($orderby != 'group' ? 'u.'.$orderby : 'g.name').' '.$order),
				$page,
				$resultsPerPage
		);
		$users = $pager->execute()->toArray();
		if($page > $pager->getLastPage())
			$users = array();
		
			
################################################
		# BUSCA DE GRUPOS
		$q =	Doctrine_Query::create()
				->select('g.id, g.name')
				->from('Group g');
		$groups = $q->execute()->toArray();
		
		/**
  		 * DynamicJS
  		 */
  		$this->groups_js->processJS();
  		
		/**
		 * SMARTY
		 */
		$this->smarty->assign('title','Hit Centre of Language');
		$this->smarty->assign('header','Hit Centre of Language');
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('order', $order == 'ASC' ? 'DESC' : 'ASC');
		$this->smarty->assign('groups',$groups);
  		$this->smarty->assign('users',$users);
  		$this->smarty->assign('count',count($users));
  		$this->smarty->display('users.tpl');
  		
  		
  	}
	
  	/**
  	 * Método para adicionar usuários ao sistema
  	 *
  	 */
  	public function addUser() {
  		
  		if( isset($_POST) && !empty($_POST)) {
  			$_POST = array_map('addslashes',$_POST);
  			$this->addUserAction();
  		} else {

#######################################################
			# BUSCA GRUPOS
			$q =	Doctrine_Query::create()
				  	->select('g.*')
				  	->from('Group g');
			$groups = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
#######################################################
					
			$this->smarty->assign('title', 'Adicionar usuário');
			$this->smarty->assign('header', 'Hit Centre of Language');
			$this->smarty->assign('groups', $groups);
			$this->smarty->display('addUser.tpl');			
  		}
  	}
  	
  	/**
  	 * Ação:: Adicionar Usuário ao sistema
  	 * @param null
  	 */
  	private function addUserAction() {
		/**
  		 * O username é UNICO:: Verifica se o username já está sendo usado.
  		 * Isto já é validade no cliente, somente precaução
  		 */
  		$q =	Doctrine_Query::create()
	  			->select('u.username')
	  			->from('User u')
	  			->addWhere('u.username = ?', array($_POST['username']));
	  	$buscaUser = $q->count();
	  	if( $buscaUser > 0 ) {
	  		OrionTools_Geral::alert('Usuário já existe');
	  		OrionTools_Geral::back();
	  		exit();
	  	}
		
	  	/**
	  	 * Chama o método de validação no servidor
	  	 */
	  	$this->validaFieldsForAddUsers( true ); 
	  		  	
	  	$user = new User();
	  	$user->username		= $_POST['username'];
	  	$user->password 	= $_POST['pass'];
	  	$user->firstname	= $_POST['firstname'];
	  	$user->lastname 	= $_POST['lastname'];
	  	$user->email 		= $_POST['email'];
	  	$user->street		= $_POST['street'];
	  	$user->district		= $_POST['district'];
	  	$user->country_id	= $_POST['country'];
	  	
	  	/**
	  	 * Se o país não for o Brasil, os campos Estado e Cidade vem em string!!!
	  	 * BRASIL === 76
	  	 */
	  	if( $_POST['country'] == 76 || $_POST['country'] == '76') {
	  		$user->state_id		= $_POST['state'];
	  		$user->city_id		= $_POST['city'];
	  	} else {
	  		$user->state_foreign  = $_POST['state_input'];
	  		$user->city_foreign   = $_POST['city_input'];
	  	}
	  	
	  	$user->tel_res		= $_POST['tel_res'];
	  	$user->tel_cel		= $_POST['tel_cel'];
	  	$user->cep 			= $_POST['cep'];
	  	$user->group_id		= $_POST['group'];
		
		$image = false;
		
		$file = Orion::getPathProject() . 'view/Admin/Hitcentre/templates/images/avatar/'.$_POST['username'].'/';
		if(!file_exists($file))
		{
			@chmod($file, 0777);
			if( mkdir($file) == FALSE )
			{
				print "Verifique as permissões do diretório de upload: ".Orion::getPathProject() . 'view/Admin/Hitcentre/templates/images/avatar/<br>';
				exit(1);
			}
		}
		
		if(!empty($_FILES['foto']))
		{
			$handle = new Upload($_FILES['foto']);
			if($handle->uploaded)
			{
				$handle->file_new_name_body = $_POST['username'].'_avatar';
				$handle->file_overwrite	= true;
				$handle->file_auto_rename = false;
				$handle->image_resize 	= true;
				$handle->image_x		= 200;
				$handle->image_ration_y	= true;
				$handle->process(Orion::getPathProject() . 'view/Admin/Hitcentre/templates/images/avatar/'.$_POST['username'].'/');
				if($handle->processed)
				{
					$image = $handle->file_dst_name;
					$handle->clean();
				} else {
					print "error: ".$handle->error;
					exit();
				}
			}
		}
		
		if(!empty($image))
			$user->imagem = $image;
	  	
	  	# Quando o sistema de permissão estiver 100% adicionar a flag aqui
	  	
	  	$user->save(); 
		
		if(isset($_POST['generatepass']) && $_POST['generatepass'] == 'yes')
		{
			$to 		= $_POST['firstname'] . ' ' . $_POST['lastname'] . '<' . $_POST['email'] . '>';
			$subject	= "Bem Vindo à Hitcentre";
		}
	  	 		
  		OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . "Admin/Users");
  	}
  	
  	/**
  	 * Edita o usuário
  	 *
  	 */
  	public function editUser() {
  		$id = addslashes($this->data[3]);
  		if (!empty( $_POST )) {
  			$_POST = array_map('addslashes', $_POST);
  			$this->updateUser( $id );
  		}
  		/**
  		 * Limpa a variável
  		 */
  		
  		$user = array();
#################################################
		# BUSCA O USUÁRIO
  		$q = 	Doctrine_Query::create()
  				->select('u.*')
  				->addSelect('g.name AS group')
  				->addSelect('c.name AS city')
  				->addSelect('s.name AS state')
  				->addSelect('ct.name AS country')
  				->from('User u')
  				->leftJoin('u.Group g')
  				->leftJoin('u.City c')
  				->leftJoin('u.State s')
  				->leftJoin('u.Country ct')
  				->addWhere('u.id = ?', array($id));
  		$user = $q->fetchOne(null, Doctrine::HYDRATE_ARRAY);
##################################################
		# BUSCA OS GRUPOS
		$q = 	Doctrine_Query::create()
				->select('g.*')
				->from('Group g');
		$groups = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
##################################################
  		
  		$this->smarty->assign('url', 'Admin/Users/EditUser');
  		$this->smarty->assign('user', $user);
  		$this->smarty->assign('groups', $groups);
  		$this->smarty->display('editUser.tpl');
  	}
  	
  	/**
  	 * Método que edita o usuário
  	 *
  	 */
  	public function updateUser( $id ) 
	{
		//OrionTools_Debug::debugArray($_POST);
		//OrionTools_Debug::debugArray($_FILES, true, true, true, true);
  		
		/**
  		 * Valida os campos
  		 */
  		if( $this->validaFieldsForAddUsers( false ) === true ) 
		{
		
			/**
			 * Upload da imagem
			 */
			 $image = false;
			 
			if(!empty($_FILES['foto']))
			{
				$handle = new Upload($_FILES['foto']);
				if($handle->uploaded)
				{
					$handle->file_new_name_body = $_POST['username'].'_avatar';
					$handle->file_overwrite	= false;
					$handle->file_auto_rename = true;
					$handle->image_resize 	= true;
					$handle->image_x		= 200;
					$handle->image_ration_y	= true;
					$handle->process(Orion::getPathProject() . 'view/Admin/Hitcentre/templates/images/avatar/'.$_POST['username'].'/');
					if($handle->processed)
					{
						$image = $handle->file_dst_name;
						$handle->clean();
					} else {
						print "error: ".$handle->error;
						exit();
					}
				}
			}
  			
  			$q = 	Doctrine_Query::create()->update('User')
  					->set('username', '?', array($_POST['username']))
  					->set('firstname','?', array($_POST['firstname']))
  					->set('lastname','?', array($_POST['lastname']))
  					->set('email', '?', array($_POST['email']));
  						if( !empty($_POST['pass']) ) {
	  						$q->set('password','?', array(Security_Secure::getHashOfPassForLogin($_POST['pass'])));
  						}
  					$q	->set('street','?', array($_POST['street']))
  						->set('district', '?', array($_POST['district']))
  						->set('country_id', '?', array($_POST['country']));
  					
					if( $_POST['country'] != 76 ) {
						$q	->set('city_foreign','?', array($_POST['city_input']))
							->set('city_id','?',array(null))
							->set('state_foreign','?', array($_POST['state_input']))
							->set('state_id','?',array(null));
					} else {
						$q	->set('city_id','?', array($_POST['city']))
							->set('city_foreign', '?', array(null))
							->set('state_id','?', array($_POST['state']))
							->set('state_foreign','?', array(null));	
					}
					$q	->set('cep', '?', array($_POST['cep']))
						->set('tel_res', '?', array($_POST['tel_res']))
						->set('tel_cel', '?', array($_POST['tel_cel']))
						->set('group_id','?', array($_POST['group']));
					if(!empty($image))
						$q->set('imagem', '?', array($image));
  					
  			$q	->where('id = ?', $id)
  				->limit(1);
  			$upd = $q->execute();
  			  			
  			OrionTools_Geral::alert('Usuário salvo com sucesso');
  			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Users/EditUser/'.$id);
  			exit();
  			
  		}
  	}
  		
  	  	
  	public function deleteUser() 
	{
  		$id = $this->data[3];
		
		$user = Doctrine::getTable('User')->find($id)->delete();
  		
		OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Users/');
  	}

  	public function validaFieldsForAddUsers( $senha = false ) {
  		
  		$erro = true;
  		/**
  		 * Verifica as senhas
  		 */
  		if( !empty($_POST['pass']) && $senha == false ) {
	  		if(($_POST['pass'] != $_POST['pass_2'])) {
	  			$erro = false;
	  			OrionTools_Geral::alert("Verifique sua senha");
	  			OrionTools_Geral::back();
	  			exit();
	  		}
  		} elseif (empty($_POST['pass']) && $senha == true ) {
  			$erro = false;
  			OrionTools_Geral::alert('Insira uma senha');
  			OrionTools_Geral::back();
  			exit();
  		} elseif (!empty($_POST['pass']) && ( $_POST['pass'] != $_POST['pass_2'] ) && $senha == true ) {
  			OrionTools_Geral::alert('As senhas não são iguais');
  			OrionTools_Geral::back();
  			exit();
  		}
  		/**
  		 * Verifica se o username foi preenchido (Isto já é validado no cliente,
  		 * somente precaução.
  		 */
  		if( empty($_POST['username']) ) {
  			$erro = false;
  			OrionTools_Geral::alert("Insira um username");
  			OrionTools_Geral::back();
  			exit();
  		}
  		
  		/**
	  	 * Primeiro nome obrigatório
	  	 */
	  	if( empty($_POST['firstname']) ) {
	  		$erro = false;
	  		OrionTools_Geral::alert('É necessário inserir o nome do usuário');
	  		OrionTools_Geral::back();
	  		exit();
	  	}
	  	
	  	/**
	  	 * Email obrigatório
	  	 */
	  	if( empty($_POST['email']) ) {
	  		$erro = false;
	  		OrionTools_Geral::alert('É necessário inserir um email para o usuário');
	  		OrionTools_Geral::back();
	  		exit();
	  	} else {
	  		/**
	  		 * Validação do email:: Fazer mais tarde
	  		 */
	  		
	  	}
	  	
	  	/**
	  	 * Verifica o país
	  	 */
	  	if( empty($_POST['country']) || $_POST['country'] == 0 || $_POST['country'] == '0') {
	  		$erro = false;
	  		OrionTools_Geral::alert('Você deve especificar o país do Usuário');
	  		OrionTools_Geral::back();
	  		exit();
	  	}
	  	
	  	/**
	  	 * Grupo Obrigatório
	  	 */
	  	if( empty($_POST['group']) ) {
	  		$erro = false;
	  		OrionTools_Geral::alert('É obrigatório indicar um grupo para o usuário.');
	  		OrionTools_Geral::back();
	  		exit();
	  	}
	  	
	  	return $erro;
  	}
  	
  	/**
  	 * Método que manipula os grupos
  	 * @param null
  	 */
  	public function groups() {
  		if (empty($this->data[3])) {
  			$this->data[3] = '';
  		}
		switch ($this->data[3]) {
			case 'main':
				$this->groupsMain();
				break;
			case 'editgroup':
				$this->editGroup();
				break;
			case 'save':
				switch ($this->data[5]) {
					case 'cookies':
						$this->saveGroupByCookies();
						break;
					case 'name':
						$this->saveGroupByName();
						break;
				}
				break;
			case 'deletegroup':
				$this->deleteGroup();
				break;
			default:
				$this->groupsMain();
				break;
		}

  	}
  	
  	/**
  	 * Método principal dos Grupos
  	 * Exibe os grupos já criados
  	 * Cria grupos
  	 */
  	public function groupsMain() {
		$orderby 	= isset($this->data[4]) ? $this->data[4] : 'id';
		$order		= isset($this->data[5]) ? $this->data[5] : 'asc';
##############################################
		# BUSCA OS GRUPOS
  		$q = 	Doctrine_Query::create()
  				->select('id, name, DATE_FORMAT(created_at,\'%d/%m/%Y\') AS created_at')
  				->from('Group')
				->orderby($orderby.' '.strtoupper($order));
  		//print $q->getSql();
  		$groups = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
##############################################
		# BUSCA AS ÁREAS
		$q = 	Doctrine_Query::create()
				->select('s.*')
				->from('Service s');
		$services = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
##############################################
		# BUSCA OS RECURSOS DAS ÁREAS
		$q = 	Doctrine_Query::create()
				->select('s.*')
				->from('Resource s');
		$resources = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
##############################################

		/**
		 * DynamicJS
		 * Ajustando no smarty às URL dos JS compilados
		 */
		$this->groups_js->assign('way_for_record_groups','Admin/Users/Groups/Save/By/Cookies');		
		$this->groups_js->processJS();
		$this->smarty->assign('groups_js',$this->groups_js->getURLFilenameCompiled());
		
		
		/**
		 * Envia a url, para decidir quais arquivos javascript e 
		 * css o smarty irá chamar
		 */
  		$this->smarty->assign('url', 'Admin/Users/Groups');
  		$this->smarty->assign('groups', $groups);
		$this->smarty->assign('order', ($order == strtolower('asc')) ? 'desc' : 'asc');
  		$this->smarty->assign('services', $services);
  		$this->smarty->assign('resources', $resources);
  		$this->smarty->display('groups.tpl');
  	}
  	
  	public function editGroup() {
				
  		$id = $this->data[4];
##############################################
		# BUSCA O GRUPO
		$q = 	Doctrine_Query::create()
				->select('g.*')
				->from('Group g')
				->where('g.id = ?',array($id));
		$group = $q->execute(array(),Doctrine::HYDRATE_ARRAY);
		if(!isset($group))
			throw new Doctrine_Connection_Exception('Erro da Query DQL');
		
		$group = OrionTools_Functions::downArray( $group );
##############################################
		# BUSCA AS AREAS
		$q = 	Doctrine_Query::create()
				->select('s.*')
				->from('Service s');
		$services = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		if(!isset($services))
			throw new Doctrine_Connection_Exception('Erro da Query DQL');
##############################################
		# BUSCA OS RECURSOS DAS AREAS
		$q = 	Doctrine_Query::create()
				->select('r.*')
				->from('Resource r');
		$resources = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		if(!isset($resources))
			throw new Doctrine_Connection_Exception('Erro da Query DQL');
##############################################
		
		if (isset($this->data[5]) && $this->data[5] == 'save' && isset($this->data[7]) && $this->data[7] == 'cookies') {
			$this->editGroupByCookies();
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Users/Groups');
		}

		$java = "createCookie('nameGroup','".$group['name']."');\n";
		
		/**
		 * DynamicJS
		 * Ajustando no smarty às URL dos JS compilados
		 */
		$this->groups_js->assign('createCookie_If_EditGroup',$java);
		$this->groups_js->assign('way_for_record_groups',Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Users/Groups/EditGroup/'.$id.'/Save/By/Cookies');
		$this->groups_js->processJS();
		/**
		 * Smarty
		 */
		$this->smarty->assign('groups_js',$this->groups_js->getURLFilenameCompiled());
		
		
		/**
		 * Envia a url
		 */
		$this->smarty->assign('url', 'Admin/Users/Groups');
		$this->smarty->assign('group',$group);
  		$this->smarty->assign('services', $services);
  		$this->smarty->assign('resources', $resources);
  		$this->smarty->display('editgroup.tpl');
  	}
  	
  	/**
  	 * Método deprecated  --> Atualmente utilziando cookies para gravar
  	 * novo grupo
  	 * 
  	 * @deprecated 
  	 */
  	public function saveGroupByName() {
		$name = addslashes($_POST['name']);
		$q = 	Doctrine_Query::create()
				->select('g.*')
				->from('Group g')
				->where('g.name = ?', $name);
		$group = $q->execute();
		if($group->count() > 0) {
			OrionTools_Geral::alert('Já existe um grupo com esse nome!!');
			OrionTools_Geral::call('allowNameGroup');
			exit();
		} else {
			unset($group);
			setcookie('nameGroup', $name, time()+3600);
			OrionTools_Geral::alert('cookie gravado');
		}		
	}
	
	/**
	 * Salva o grupo By Cookies :)
	 * Os cookies são criados no cliente e tem a seguinte forma:
	 * name == nome do grupo
	 * pattern == id do perfil padrão, se existir
	 * resource_X == os recources, o X é o id do resource que se
	 * está ajustando as permissões.
	 * resource_X --> BIN-BIN-BIN-BIN, são quatro valores 0 ou 1 cada, que
	 * indicam se a permissão pode criar, editar, deletar ou visualizar, nesta ordem.
	 * 1 allow
	 * 0 deny
	 *
	 */
	protected function saveGroupByCookies() {
		print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>\n";

		$name = utf8_encode($_COOKIE['nameGroup']);
		
		$perm = array();
		if( !isset($_COOKIE['pattern']) || empty($_COOKIE['pattern'])) {
			while(current($_COOKIE)) {
				if(strstr(key($_COOKIE),'resource_')) {
					$res = key($_COOKIE);
					$idRes = substr($res,9);
					$perm[]['id'] = $idRes;
					$perm[count($perm)-1]['permissoes'] = current($_COOKIE);
					$_op = explode('-',current($_COOKIE));
					$perm[count($perm)-1]['create'] = $_op[0];
					$perm[count($perm)-1]['update'] = $_op[1];
					$perm[count($perm)-1]['delete'] = $_op[2];
					$perm[count($perm)-1]['see'] = $_op[3];
				}
				next($_COOKIE);
			}
			
#####################################################
			# BUSCA POR GRUPO COM ESSE NOME			
			$q = 	Doctrine_Query::create()
					->select('g.*')
					->from('Group g')
					->where('g.name = ?',$name);
			$group = $q->execute();
#####################################################
			if($group->count()>0) {
				OrionTools_Geral::alert('Já existe um grupo com esse nome');
				OrionTools_Geral::back();
				exit();
			} else {
				# CASO CONTRÁRIO, CRIA UM NOVO GRUPO
				$group = new Group();
				$group->name = $name;
				$role = new Role();
				$role->name = $name;
#############################################
				# REFACTORING AQUI!!!
				$role->admin_id = 1; // ui...
#############################################
				$role->save();
				for ($i=0;$i<count($perm);$i++) {
					$rR = new RoleResource();
					$rR->role_id = $role->get('id');
					$rR->resource_id = $perm[$i]['id'];
					$rR->op_create = $perm[$i]['create'];
					$rR->op_update = $perm[$i]['update'];
					$rR->op_delete = $perm[$i]['delete'];
					$rR->op_see = $perm[$i]['see'];
					$rR->save();
				}
				
				$group->role_id = $role->get('id');
				$group->save();
				
				OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) .'Admin/Users/Groups' ,"html");
			}
		} else {
			$pattern = $_COOKIE['pattern'];
			$group = new Group();
			$group->name = $name;
			$group->role_id = $pattern;
			$group->save();
			
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) .'Admin/Users/Groups' ,"html");
		}
		
	}
	
	protected function editGroupByCookies() {
		print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>\n";
		
		$name = utf8_encode($_COOKIE['nameGroup']);
		
		$perm = array();
		if( !isset($_COOKIE['pattern']) || empty($_COOKIE['pattern'])) {
			while(current($_COOKIE)) 
			{
				if(strstr(key($_COOKIE),'resource_')) {
					$res									= key($_COOKIE);
					$idRes 									= substr($res,9);
					$perm[]['id'] 							= $idRes;
					$perm[count($perm)-1]['permissoes'] 	= current($_COOKIE);
					$_op 									= explode('-',current($_COOKIE));
					$perm[count($perm)-1]['create'] 		= $_op[0];
					$perm[count($perm)-1]['update'] 		= $_op[1];
					$perm[count($perm)-1]['delete'] 		= $_op[2];
					$perm[count($perm)-1]['see'] 			= $_op[3];
				}
				next($_COOKIE);
			}
						
			#####################################################
			# BUSCA POR GRUPO COM ESSE NOME
			$q = 	Doctrine_Query::create()
					->select('g.*')
					->from('Group g')
					->where('g.name = ?',$name);
			$group = $q->execute();
			if(!$group)
				throw new Doctrine_Connection_Exception('Erro na Query DQL');
#####################################################
			if($group->count()>0) {
				$group = $group->toArray();
				$group = $group[0];																										
				$q = 	Doctrine_Query::create()
						->select('r.*')
						->from('RoleResource r')
						->where('role_id',array($group['role_id']));
				$rR = $q->execute(array(),Doctrine::HYDRATE_ARRAY);
				
				for ($i=0;$i<count($perm);$i++) 
				{
					$q = 	Doctrine_Query::create()
							->update('RoleResource')
							->set('op_create','?',$perm[$i]['create'])
							->set('op_update','?',$perm[$i]['update'])
							->set('op_delete','?',$perm[$i]['delete'])
							->set('op_see','?',$perm[$i]['see'])
							->where('role_id = ? and resource_id = ?',array($group['role_id'],$perm[$i]['id']));
				
					$update = $q->execute();					
				}
				
				OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Users/Groups');				
				exit();
			} else {
				OrionTools_Geral::alert('Não existe um grupo com esse nome');
				OrionTools_Geral::back();
				exit();
			}
		}
	}
	
	protected function deleteGroup()
	{
		$q	= 	Doctrine_Query::create()
				->select('g.id')
				->from('Group g')
				->where('g.id = ?', array($this->data[4]))
				->limit(1);
		$q->execute()->delete();
		OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Users/Groups', 'html');
	}
	
	protected function searchUser()
	{
		$resultsPerPage = !empty($this->data[3]) && $this->data[3] > 0 ? $this->data[3] : 10;
		$page			= !empty($this->data[4]) && $this->data[4] > 0 ? $this->data[4] : 1;
		//OrionTools_Geral::alert($resultsPerPage);
		//OrionTools_Geral::alert($page);
  		$orderby 	= !empty($this->data[6]) 	? $this->data[6] : 'id';
		$order		= strtoupper( !empty($this->data[7])	? $this->data[7] : 'ASC' );
		
		
		$q	= 	Doctrine_Query::create()
				->select('g.id, g.name')
				->from('Group g');
		$groups = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		OrionTools_Functions::downArray($groups);
		
		$query = 	Doctrine_Query::create()
					->select('u.*, CONCAT(u.firstname, \' \', u.lastname) AS name, g.name AS group')
					->from('User u')
					->leftJoin('u.Group g');
			
		if(!empty($_POST) && isset($_POST))
		{
			$resultsPerPage = $_POST['resultsPerPage'];
			if(!empty($_POST['name']))
			{
				$name = explode(' ', $_POST['name']);
				$firstname 	= $name[0];
				$lastname 	= "";
				for($i=1;$i<count($name);$i++)
					if($i == (count($name)-1))
						$lastname .= $name[$i];
					else
						$lastname .= $name[$i].' ';
				$query	->addWhere('u.firstname LIKE ?', '%'.$firstname.'%');
				if(!empty($lastname))
					$query->addWhere('u.lastname LIKE ?', '%'.$lastname.'%');
			}
			if(!empty($_POST['group']))
			{
				$groupid = $_POST['group'];
				$query->addWhere('g.id = ?', $groupid);
			}
			if(!empty($_POST['email']))
			{
				$email = $_POST['email'];
				$query->addWhere('u.email LIKE ?', '%'.$email.'%');
			}		
		}
		
		$query->orderby(($orderby != 'group' ? 'u.'.$orderby : 'g.name').' '.$order);
		
		$pager = new Doctrine_Pager(
				$query,
				$page,
				$resultsPerPage
		);
		$users = $pager->execute()->toArray();
		if($page > $pager->getLastPage())
			$users = array();
		
		/**
		 * Envia a url, para decidir quais arquivos javascript e 
		 * css o smarty irá chamar
		 */
  		$this->smarty->assign('url', 'Admin/Users');
  		$this->smarty->assign('order', ($order == strtoupper('asc')) ? 'DESC' : 'ASC');
		$this->smarty->assign('groups', $groups);
		$this->smarty->assign('users', $users);
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('count',count($users));
  		$this->smarty->display('searchUser.tpl');
	}
	
	protected function usersOnline()
	{
		$resultsPerPage = !empty($this->data[3]) ? $this->data[3] : 10;
		$page = !empty($this->data[4]) ? $this->data[4] : 1;
		
		$orderby 	= !empty($this->data[6]) ? $this->data[6] : 'id';
		$order 		= !empty($this->data[7]) ? $this->data[7] : 'ASC';
		
		$time = (time() - 5*60);
		$time = date('Y-m-d h:i:s', strtotime($time));
		
		$query = 	Doctrine_Query::create()
					->select('u.*, CONCAT(u.firstname, \' \', u.lastname) AS name, g.name AS group')
					->from('User u')
					->leftJoin('u.Group g')
					->where('u.last_iteration > ?', $time)
					->orderby(($orderby != 'group' ? 'u.'.$orderby : 'g.name').' '.$order);
		
		$pager = new Doctrine_Pager(
				$query,
				$page,
				$resultsPerPage
		);
		$users = $pager->execute()->toArray();
		if($page > $pager->getLastPage())
			$users = array();
					
		
		$this->smarty->assign('url', 'Admin/Users');
  		$this->smarty->assign('order', ($order == strtoupper('asc')) ? 'DESC' : 'ASC');
		$this->smarty->assign('users', $users);
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('count',count($users));
  		$this->smarty->display('usersOnline.tpl');
	}
	
	protected function notificar()
	{
		$id = $this->data[3];
		$table = Doctrine::getTable('User');
		$user = $table->findOneById($id);
		$to 	= $user->email;
		
		$table = Doctrine::getTable('ConfigSchool');
		$from 	= $table->email_main;
		$message 	= $_POST['message'];
		$title		= $_POST['title'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'To: '.$user->firstname.' '.$user->lastname.' <'.$to.'>' . "\r\n";
		$headers .= 'From: Hitcentre <'.$from.'>' . "\r\n";
		
		mail($to, $title, $message, $headers);
		
		OrionTools_Geral::back();
	}
	
	
	
	protected function profile()
	{
		$id = addslashes($this->data[3]);
  		  		
  		$user = array();
#################################################
		# BUSCA O USUÁRIO
  		$q = 	Doctrine_Query::create()
  				->select('u.*')
  				->addSelect('g.name AS group')
  				->addSelect('c.name AS city')
  				->addSelect('s.name AS state')
  				->addSelect('ct.name AS country')
  				->from('User u')
  				->leftJoin('u.Group g')
  				->leftJoin('u.City c')
  				->leftJoin('u.State s')
  				->leftJoin('u.Country ct')
  				->addWhere('u.id = ?', array($id));
  		$user = $q->fetchOne(null, Doctrine::HYDRATE_ARRAY);
		
		$table 	= Doctrine::getTable('User');
		$address	= $table->findOneById(1);
		$country 	= $address->Country->name;
		$state		= $address->State->name;
		if(empty($state))
			$country = $address->state_foreign;
		$city		= $address->City->name;
		if(empty($city))
			$city = $address->city_foreign;
		$group 		= $address->Group->name;
		
		$this->smarty->assign('url', 'Admin/Users');
		$this->smarty->assign('user', $user);
		$this->smarty->assign('country', $country);
		$this->smarty->assign('state', $state);
		$this->smarty->assign('city', $city);
		$this->smarty->assign('group', $group);
		$this->smarty->display('profile.tpl');
	}
	

	
	/**
	 * Minha Conta
	 * @return true
	 */
	public function myAccount() 
	{
		throw new OrionException_PageNotFound("Página não encontrada.");
		/*
		$id = $this->data[3];
		
		if (!$this->getUserLogged(true)) {
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/Login');
			return false;
		} else {
			print "usuário devidamente logado: <br>";
			OrionTools_Debug::debugArray($this->arrUser);
		}*/
			
	}
  	
}