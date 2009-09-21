<?php

/**
 * @author Tiago Natel de Moura
 * @package Command/Admin/Manager.php
 * @version 0.1
 * 
 * Classe principal que manipulará as requisições do Ajax devolvendo num
 * formato que o Command possa apresentar à View
 * 
 * Utilizada principalmente para responder as requisições do ajax
 */

class ManagerCommand 
	extends Security_Hitcentre_Admin
{
	/**
	 * Resgata o módulo que está manipulando o Manager
	 *
	 * @var String
	 */
	private $module;
	
	/**
	 * Resgata a action que está manipulando o Manager
	 *
	 * @var String
	 */
	private $action;
	
	/**
	 * Resgata a ferramenta utilizada
	 *
	 * @var String
	 */
	private $tool;
	
	/**
	 * Resgata as variáveis da URL, num array
	 * $data[0] == Module == Admin
	 * $data[1] == Action == Manager
	 * $data[2] == Tool
	 * $data[3] == Method
	 * ...
	 *
	 * @var Array
	 */
	protected $data = array();
	
	/**
	 * Instancia do Módulo Doctrine
	 * 
	 * @see /Libs/Database/Doctrine
	 * @var Object
	 */
	public $doctrine;
	
	public function __construct( $data )
	{		
		parent::__construct();
		$this->data = array_map('strtolower',$data);
  		$this->defaultOperations();
	}
	
###################################################
	# Métodos da Inteface Command
		
	/**
	 * Ajusta operações padrões
	 *
	 */
	public function defaultOperations()
	{
		$this->data[2] = !empty($this->data[2]) ? $this->data[2] : '';
		
		$this->getInstanceModules();
	}
	
	/**
	 * Método Principal
	 *
	 */
	public function execute()
	{		
		$this->getOption();
	}
	
	/**
	 * A opção da url
	 *
	 */
	public function getOption()
	{		
		switch ($this->data[2]) {
			case 'search':
				$this->search();
				break;
			case 'groups':
				$this->groups();
				break;
			case 'school':
				$this->school();
				break;
			case 'getcompanies':
				$this->getCompanies();
				break;
		}
	}
	
	/**
	 * Instancia módulos e bibliotecas
	 *
	 */
	public function getInstanceModules()
	{
		$this->doctrine = new OrionORM_Doctrine();
	}
	
	# Fim dos métodos de Command
########################################
	
	public function search()
	{
		/**
		 * $why == O que buscar? Paises ? Cidades ? ufo ? 
		 */
		$why = $this->data[3];
		
		/**
		 * Buscar $why em que $cond = $value
		 */
		$values  = explode('-',$this->data[4]);
		
		$value1  = $values[1];
		$value2  = $values[2];
				
		
		/**
		 * Order by ?
		 */
		$order = $this->data[5];
		
		/**
		 * View as ?
		 */
		$view = $this->data[6];
			
		switch($why) {
			case 'country':
				$from = 'Country as a';
				$cond1 = "id";
				$checked = ($values[0] == 'null')?76:$values[0];
				break;
			case 'state':
				$from = 'State as a';
				$cond1 = 'country_id';
				$cond2 = 'id';
				$checked = ($values[0] == 'null')?26:$values[0];
				break;
			case 'city':
				$from = 'City as a';
				$cond1 = 'state_id';
				$cond2 = 'id';
				$checked = ($values[0] == 'null')?9422:$values[0];
				break;
			default:
				break;				
		}
		
		$q = 	Doctrine_Query::create()
				->from($from);
		if( !empty($value1) and $value1 != 'null' )
		{
			$q->where( 'a.' . $cond1 . ' = ?', $value1 );
			if(!empty($value2) and $value2 != 'null') {
				$q->andWhere( 'a.' . $cond2 . ' = ?', $value2 );
			}
		}
		
		$q->orderBy($order);
		
		$found = $q->execute();

		switch ($view)
		{
			case 'select':
				{
					foreach ( $found as $item )
					{
						switch ($why)
						{
							case 'country':
								# 76 === BRASIL
								print '<option value="' . $item->id . '"'.($item->id == $checked?" selected=\"selected\"":"").'>' . $item->name . '</option>\n';
								break;
							case 'state':
								print '<option value="' . $item->id . '"'.($item->id == $checked?" selected=\"selected\"":"").'>' . $item->name . '</option>\n';
								break;
							case 'city':
								print '<option value="' . $item->id . '"'.($item->id == $checked?" selected=\"selected\"":"").'>' . $item->name . '</option>\n';
								break;
						}
					}	
				}
				break;
			default:
				foreach ($found as $item) {
					print $item->id . ' - ' . $item->name . '<br />';
				}
				break;
		}
	}
	
	/**
	 * Método que responde as requisições da "manutenção de grupos"
	 *
	 */
	public function groups()
	{
		switch ($this->data[3])
		{
			case 'get':
				$this->getResources($this->data[4], $this->data[5]);
				break;
			case 'save':
				switch ($this->data[4]) {
					case 'groupbyname':
						$this->saveGroupByName();
						break;
				}
				break;
			case 'savepermission':
				$this->savePermission();
				break;					
		}
	}
	
	/**
	 * Resgata o recurso
	 *
	 * @param unknown_type $res
	 * @param unknown_type $rolePattern
	 */
	public function getResources( $res, $rolePattern = 0 )
	{
		
################################################
		# BUSCA OS RESOURCES DE DETERMINADO SERVICE		
		$q = 	Doctrine_Query::create()
				->select('r.*')
				->from('Resource r')
				->where('service_id = ?', array($res));
		$resources = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
################################################
		# BUSCA OS ROLES, PARA PODER ESCOLHER UM ROLE PADRÃO		
		$q = 	Doctrine_Query::create()
				->select('r.*')
				->from('Role as r');
		$roles = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		
		if($rolePattern != 0)
		{
#################################################
			# SE NÃO FOR NULO, BUSCA O ROLE PATTERN
			$q = 	Doctrine_Query::create()
					->select('rr.*')
					->from('RoleResource rr')
					->where('role_id = ?', array($rolePattern));
			$role = $q->execute();
		}
		
		print "<center><span class=\"title\">Configure as Permissoes</span></center>";
		print "<label for=\"role\">Perfis padrões: </label>\n";
		print "<select name=\"role\" id=\"role\" onchange=\"alterRolePattern(this.value);loadResources(".$res.", \$j('#role_pattern').attr('value'))\">\n";
		print "<option value=\"0\">Novo perfil</option>";
		for( $i = 0; $i < count($roles); $i++ )
		{
			print "<option value=\"".$roles[$i]['id']."\"";
				
				if($rolePattern != 0 && $rolePattern == $roles[$i]['id']) {
					print " selected=\"selected\"";
				}
			print ">".$roles[$i]['name']."</option>\n";
		}
		print "</select><span name=\"loader\" id=\"loader\"></span><br><br>";
		for ( $i=0 ; $i < count($resources); $i++ )
		{
			
			# Busca pelo Resource pattern
			if(!empty($role))
			{
				for ($j = 0; $j < count($role); $j++)
				{
					
					if( $role[$j]['resource_id'] == $resources[$i]['id'])
					{
						$resources[$i]['op_create'] = $role[$j]['op_create'];
						$resources[$i]['op_update'] = $role[$j]['op_update'];
						$resources[$i]['op_delete'] = $role[$j]['op_delete'];
						$resources[$i]['op_see'] = $role[$j]['op_see'];
					}
				}
			}
			
			print "<center><h4>".$resources[$i]['name'] . "</h4></center>\n";
			print "<table class=\"permission\">\n";
			print "<tr class=\"head\">\n";
			print "<th>Cadastrar</th><th>Editar</th><th>Deletar</th><th>Visualizar</th>\n";
			print "</tr>";
			print "<tr id=\"".$resources[$i]['id']."\">\n";
			print "<td><input type='checkbox' class='create' name='create_".$resources[$i]['id']."' id='create_".$resources[$i]['id']."' value='1'";
				if (isset($resources[$i]['op_create']) && $resources[$i]['op_create'] == 1) { print " checked='checked'"; }
			print " /></td>\n"; 
			
			print "<td><input type=\"checkbox\" class=\"edit\" name=\"edit_".$resources[$i]['id']."\" id=\"edit_".$resources[$i]['id']."\" value=\"1\"";
				if(isset($resources[$i]['op_update']) && $resources[$i]['op_update'] == 1) { print " checked='checked'"; }
			print " /></td>\n";
			print "<td><input type=\"checkbox\" class=\"delete\" name=\"delete_".$resources[$i]['id']."\" id=\"delete_".$resources[$i]['id']."\" value=\"1\"";
				if(isset($resources[$i]['op_delete']) && $resources[$i]['op_delete'] == 1) { print " checked='checked'"; }
			print " /></td>\n";
			print "<td><input type=\"checkbox\" class=\"view\" name=\"view_".$resources[$i]['id']."\" id=\"view_".$resources[$i]['id']."\" value=\"1\"";
				if(isset($resources[$i]['op_see']) && $resources[$i]['op_see'] == 1) { print " checked='checked'"; }
			print " /></td>\n";
			print "</tr>\n";
			print "</table>";		
		}
		print "<center><input type=\"button\" name=\"salvar\" id=\"salvar\" value=\"Salvar\" onclick=\"savePermissionInCookie()\" />\n";
		print "<input type=\"button\" name=\"rest\" id=\"rest\" value=\"Restaurar\" /></center>";
	}
	
	public function saveGroupByName()
	{
		$name = $_POST['name'];
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
			//setcookie('nameGroup', $name, time()+3600);
			OrionTools_Geral::alert('cookie gravado');
		}		
	}
	
	public function savePermission()
	{
		$resource = array();
		foreach ($_POST as $key => $value) {
			$$key = $value;
			if(strstr($key, "_")) {
				$pos = strrpos($key, '_');
				$id = substr($key, $pos+1);
				$op = substr($key, 0,-2);
				$resource[$id][$op] = $value;
			}
			
		}
		
		if(empty($name))
		{
			OrionTools_Geral::alert('Voce deve indicar um nome para o grupo!');
			OrionTools_Geral::back();
		}
	############################################
		# VERIFICA SE JÁ EXISTE UM GRUPO COM ESSE NOME
		$q = 	Doctrine_Query::create()
				->select('name')
				->from('Group')
				->where('name = ?', $name);
	############################################
		if($q->count() > 0)
		{
			$group = $q->execute();			
		} else
		{
			$group = new Group();
			$group->name = $name;
		}
			if( !empty($pattern) && $pattern != 0)
			{				
				$q = 	Doctrine_Query::create()
						->select('r.*')
						->from('Role r')
						->where('id = ?',array($pattern));
				$role = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
				if(count($role) < 1) {
					OrionTools_Geral::alert('Perfil não encontrado!');
					OrionTools_Geral::redirect();
				}
				
				$group->role_id = $role[0]['id'];
				$group->save();
				OrionTools_Geral::alert('Permissão cadastrada com sucesso');
				OrionTools_Geral::back();
			} else
			{				
				$role = new Role();
				$role->name = $name;
#############################################
				# ATENÇÃOOOOOOOOO  REFACTORING AQUI			
				$role->admin_id = 1;
#############################################

				$role->save();		
				
				while(current($resource)) {
					$roleResource = new RoleResource();
					$roleResource->role_id = $role->get('id');
					$roleResource->resource_id = key($resource);
					$roleResource->op_create = $resource[key($resource)]['create'];
					$roleResource->op_update = $resource[key($resource)]['edit'];
					$roleResource->op_delete = $resource[key($resource)]['delete'];
					$roleResource->op_see = $resource[key($resource)]['view'];
					$roleResource->save();
					next($resource);
				}
				
				$group->role_id = $role->get('id');
				OrionTools_Geral::alert($role->get('id'));
				$group->save();
				
				OrionTools_Geral::alert('Permissão cadastrada com sucesso');
				
			}
		
	}
	
	public function school()
	{
		switch ($this->data[3]) 
		{
			case 'entry':
				$this->schoolEntry();
				break;
			case 'getgradeschool':
				$this->getGradeSchoolXML();
				break;
			case 'getcivilstatus':
				$this->getCivilStatusXML();
				break;
			case 'getlanguages':
				$this->getLanguagesXML();
				break;
		}
		
	}
	
	public function schoolEntry()
	{
		switch ($this->data[4]) {
			case 'student':
				$this->schoolEntryStudent();
				break;
		}
		
		
	}
	
	protected function schoolEntryStudent()
	{
		switch ($this->data[5])
		{
			case 'toggleresp':
				{
					$file = $this->data[6] == 0 ? 
						'form_entry_student.tpl' : 
						'form_entry_student_not_resp.tpl';
						
					$str = file_get_contents(	Orion::getAttribute(Orion::ATTR_HOST) . 
								'apps/hitcentre/view/Admin/Hitcentre/templates/actions/Ajax/'.$file
							);
					print $str;
				}
				break;
			case 'toggleform':
				{
					$file 	= 	$this->data[6] == 0 ?
								'form_entry_student_secondpart.tpl' :
								'form_entry_student_secondpart2.tpl';
					$str 	= file_get_contents( 	Orion::getAttribute(Orion::ATTR_HOST) . 
								'apps/hitcentre/view/Admin/Hitcentre/templates/actions/Ajax/'.$file
								);
					print $str;
				}
				break;
			case 'getcompany':
				{
					$str = file_get_contents(	Orion::getAttribute(Orion::ATTR_HOST) .
								'apps/hitcentre/view/Admin/Hitcentre/templates/actions/Ajax/form_companies.tpl'
							);
					if($this->data[6] != 0)
					{
						$id = $this->data[6];
						$company = Doctrine::getTable('Company')->find($id);
						$str = preg_replace('/\@name\@/', 		$company->name, 		$str);
						$str = preg_replace('/\@tel\@/', 		$company->tel, 			$str);
						$str = preg_replace('/\@address\@/',	$company->address, 		$str);
						$str = preg_replace('/\@number\@/', 	$company->number, 		$str);
						$str = preg_replace('/\@complement\@/', $company->complement, 	$str);
						$str = preg_replace('/\@district\@/', 	$company->district, 	$str);
						$str = preg_replace('/\@fax\@/', 		$company->tel_fax, 		$str);
						$str = preg_replace('/\@cep\@/',		$company->cep,			$str);
					}
					
					$str = preg_replace('/\@\w+?\@/', '', $str);
					
					print $str;
				}
				break;
		}
		
	}
	
	protected function getGradeSchoolXML()
	{
		$q = 	Doctrine_Query::create()
				->select('g.*')
				->from('GradeSchool g');
		$grade_school = $q->execute()->toArray();
		
		OrionTools_Geral::setHeader('application/xml', 'utf-8');
		
		/**
		 * Cria a resposta num XML
		 */
		$dom = new DOMDocument('1.0', 'utf-8');
		
		$grades = $dom->createElement('grades');
		for($i=0;$i<count($grade_school);$i++)
		{
			$gschool = $dom->createElement('grade');
			$gschool->setAttributeNode(new DOMAttr('id', $grade_school[$i]['id']));
			$gschool->setAttributeNode(new DOMAttr('name', $grade_school[$i]['name']));
			$grades->appendChild($gschool);
			$dom->appendChild($grades);
		}
		print $dom->saveXML();
	}
	
	protected function getCivilStatusXML()
	{
		$q = 	Doctrine_Query::create()
				->select('c.*')
				->from('CivilStatus c');
		$civil_status = $q->execute()->toArray();
		
		OrionTools_Geral::setHeader('application/xml', 'utf-8');
		
		$dom = new DOMDocument('1.0', 'utf-8');
		
		$status = $dom->createElement('civil_status');
		for($i=0;$i<count($civil_status);$i++)
		{
			$civil = $dom->createElement('civil');
			$civil->setAttributeNode(new DOMAttr('id', $civil_status[$i]['id']));
			$civil->setAttributeNode(new DOMAttr('name', $civil_status[$i]['name']));
			$status->appendChild($civil);
			$dom->appendChild($status);
		}
		
		print $dom->saveXML();
	}
	
	protected function getLanguagesXML()
	{
		$q = 	Doctrine_Query::create()
				->select('l.id as id')
				->addSelect('l.name as name')
				->from('Language l');
		$languages = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		
		OrionTools_Geral::setHeader('application/xml', 'utf-8');
		
		$dom = new DOMDocument('1.0', 'utf-8');
		
		$langs = $dom->createElement('languages');
		for($i=0;$i<count($languages);$i++)
		{
			$lang = $dom->createElement('lang');
			$lang->setAttributeNode(new DOMAttr('id', $languages[$i]['id']));
			$lang->setAttributeNode(new DOMAttr('name', $languages[$i]['name']));
			$langs->appendChild($lang);
			$dom->appendChild($langs);
		}
		
		print $dom->saveXML();
	}
	
	protected function getCompanies()
	{
		$id = !empty($this->data[3]) ? $this->data[3] : false;
		if($id == false)
		{
			$companies = Doctrine::getTable('Company')->findAll()->toArray();
			print '<option value="0">Nova Empresa</option>';
			foreach($companies as $company)
			print '<option value="' . $company['id'] . '">'. $company['name'] . '</option>'; 
		} else {
			$company = Doctrine::getTable('Company')->find($id)->toArray();
			$field = $this->data[4];
			$response = $company[$field];
			if(empty($response) && $field == 'city_id')
				$response = $company['city_foreign'];
			elseif(empty($response) && $field == 'state_id')
				$response = $company['state_foreign'];
			
			print $response;
		}	
	}
}