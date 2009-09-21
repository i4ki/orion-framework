<?php

/**
 * @author Tiago Natel de Moura
 * Controle da escola
 *
 */
class SchoolCommand 
	extends Security_Hitcentre_Admin
		implements 	iHitcentre,
					System_iMonitor
{
	/**
	 * Private's vars
	 * Libraries in use
	 *
	 * @var Objects
	 */
	private $doctrine;
	private $dynamicJS;
	private $smarty;
	
	/**
	 * Informações relevantes em
	 * variadas partes do sistema
	 *
	 * @var object
	 */
	private $_monitor;
	
	/**
	 * Public's vars
	 *
	 * @var array
	 */
	public $data;
	
	/**
	 * Construtor
	 *
	 * @param array $data
	 */
	public function __construct( $data )
	{
		$this->data = array_map('strtolower',$data);
		
		parent::__construct();
		
		$this->defaultOperations();
		
	}

###################################################
	# Métodos da Interface Command
		
	/**
	 * Operações default
	 */
	public function defaultOperations()
	{
		$this->data[2] 	= 	isset($this->data[2]) 	?
							$this->data[2]			:
							'';
		OrionTools_Geral::setHeader();
		
		$this->getInstanceModules();
		$this->getUserLogged();
		$this->getInstanceSystem();
		
		$this->smarty->assign('title','Hit Centre of Language');
		$this->smarty->assign('header','Hit Centre of Language');
		$this->smarty->assign('session',$_SESSION);
		$this->smarty->assign('school',$this->_monitor->getInfoSchool());
	}
	
	/**
	 * Execute
	 * Método automaticamente chamado pela index
	 *
	 */
	public function execute()
	{
		//OrionTools_Debug::debugArray($_SESSION);
		$this->getOption();
	}
	
	/**
	 * Instancia as bibliotecas do sistema
	 *
	 */
	public function getInstanceModules()
	{
		$this->doctrine 	= new OrionORM_Doctrine();
		
		$this->dynamicJS 	= new DynamicJS_Config();
		
		$this->smarty 		= new Smarty_Config();
	}
	
	/**
	 * Pega a opção da url e executa o método
	 * correspondente
	 *
	 */
	public function getOption()
	{
		switch ($this->data[2]) {
			case 'students':
				$this->students();
				break;
			case 'viewstudent':
				$this->viewStudent();
				break;
			case 'deletestudent':
				$this->deleteStudent();
				break;
			case 'editcompany':
				$this->editCompany();
				break;
			case 'teachers':
				$this->teachers();
				break;
			case 'deleteteacher':
				$this->deleteTeacher();
				break;
			case 'entries':
				$this->entries();
				break;
			case 'courses':
				$this->courses();
				break;
			case 'languages':
				$this->languages();
				break;
			case 'companies':
				$this->companies();
				break;
			case 'deletecompany':
				$this->deleteCompany();
				break;
			case 'events':
				$this->events();
				break;
		}
	}
	# Fim dos métodos de Command
##################################################
	# Interfaces de System_iMonitor
	public function getInstanceSystem()
	{
		$this->_monitor = new System_Hitcentre_Info_Configs();
		return $this->_monitor;
	}
	# Fim dos métodos de System_iMonitor
##################################################

	/**
	 * cadastros
	 *
	 */
	private function entries()
	{
		switch ($this->data[3]) 
		{
			case 'students':
				$this->entryStudent();
				break;
			case 'teachers':
				$this->entryTeacher();
				break;
			case 'companies':
				$this->entryCompany();
				break;
		}
	}
	
	private function students()
	{
		$resultsPerPage = !empty($this->data[3]) ? $this->data[3] : 10;
		$page 			= !empty($this->data[4]) ? $this->data[4] : 1;
		$orderby		= !empty($this->data[6]) ? $this->data[6] : 'id';
		$order			= !empty($this->data[7]) ? strtoupper($this->data[7]) : 'ASC';
		
		$query = 	Doctrine_Query::create()
					->select("s.*, CONCAT(s.firstname, ' ', s.lastname) as name")
					->addSelect("cs.*, c.name as course")
					->addSelect('l.name as language')
					->from("Student s")
					->leftJoin('s.PedagogicStudent ps')
					->leftJoin('s.CourseStudent cs')
					->leftJoin('cs.Course c')
					->leftJoin('c.Language l');
		if($orderby == 'id' || $orderby == 'email_part' || $orderby == 'firstname')
			$query->orderby('s.'.$orderby.' '.$order);
		elseif($orderby == 'course')
			$query->orderby('c.name '.$order);
		elseif($orderby == 'teacher' || $orderby == 'status')
			print '';
		
		$pager = new Doctrine_Pager(
			$query,
			$page,
			$resultsPerPage
		);
		
		$student = $pager->execute(array(), Doctrine::HYDRATE_ARRAY);
		
		if($page > $pager->getLastPage())
		$student = array();
		/**
		 * Smarty
		 */
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('count', $pager->getNumResults());
		$this->smarty->assign('order', $order == 'ASC' ? 'DESC' : 'ASC');
		$this->smarty->assign('student', $student);
		$this->smarty->assign('url','Admin/School/Students');
		$this->smarty->assign('add_student', $this->dynamicJS->getURLFilenameCompiled());
		$this->smarty->display("School/students.tpl");
	}
	
	private function viewStudent()
	{
		$id = !empty($this->data[3]) ? $this->data[3] : false;
		
		if(!$id)
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Students');
		
		$student = Doctrine::getTable('Student')->find($id)->toArray();
		$birthday = explode('-', $student['birthday']);		
		$student['birthday'] = $birthday[2] . $birthday[1] . $birthday[0];
		
		if($student['i_resp'] == 1)
		{
			$resp = Doctrine::getTable('Responsible')->find($student['responsible_id'])->toArray();
			$resp_cities = Doctrine::getTable('City')->findByState($resp['state_id'])->toArray();
			
			$this->smarty->assign('resp', $resp);			
			$this->smarty->assign('resp_cities', $resp_cities);
		}
		$countries 	= Doctrine_Query::create()->select('c.id, c.name')->from('Country c')->execute(array(), Doctrine::HYDRATE_ARRAY);
		$states		= Doctrine_Query::create()->select('s.id, s.name')->from('State s')->execute(array(), Doctrine::HYDRATE_ARRAY);
		$cities		= Doctrine_Query::create()->select('c.id, c.name')->from('City c')->where('state_id = ?', $student['state_id'])->execute(array(),Doctrine::HYDRATE_ARRAY);
		$companies 	= Doctrine_Query::create()->select('c.*')->from('Company c')->orderby('c.name ASC')->execute(array(), Doctrine::HYDRATE_ARRAY);
		
		$civil_status = Doctrine::getTable('CivilStatus')->findAll()->toArray();
		
		$this->smarty->assign('url', 'Admin/School/viewStudent');
		$this->smarty->assign('countries', $countries);
		$this->smarty->assign('states', $states);
		$this->smarty->assign('cities', $cities);
		$this->smarty->assign('civil_status', $civil_status);
		$this->smarty->assign('companies', $companies);
		$this->smarty->assign('student', $student);

		$this->smarty->display('School/viewStudent.tpl');
	}
	
	private function deleteStudent()
	{
		$id = $this->data[3];
		// deleta relacionamentos do estudante e cursos
		$courseStudent = Doctrine::getTable('CourseStudent')->findByStudent($id)->delete();
		
		$student = Doctrine::getTable('Student')->find($id);
		$student->delete();
		OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Students' );
		exit();
	}
	
	private function teachers()
	{
		$resultsPerPage = !empty($this->data[3]) ? $this->data[3] : 10;
		$page 			= !empty($this->data[4]) ? $this->data[4] : 1;
		$orderby		= !empty($this->data[6]) ? $this->data[6] : 'id';
		$order			= !empty($this->data[7]) ? strtoupper($this->data[7]) : 'ASC';
		
		$query = 	Doctrine_Query::create()
					->select("t.*, CONCAT(t.firstname, ' ', t.lastname) as name")
					->addSelect('tl.*,l.name as language')
					->from("Teacher t")
					->leftJoin('t.TeacherLanguage tl')
					->leftJoin('tl.Language l');
		if($orderby == 'id' || $orderby == 'email' || $orderby == 'firstname')
			$query->orderby('t.'.$orderby.' '.$order);
		
		$pager = new Doctrine_Pager(
			$query,
			$page,
			$resultsPerPage
		);
		
		$teachers = $pager->execute(array(), Doctrine::HYDRATE_ARRAY);
		for($i=0;$i<count($teachers);$i++)
		{
			for($j=0;$j<count($teachers[$i]['TeacherLanguage']);$j++)
				$teachers[$i]['languages'][] = $teachers[$i]['TeacherLanguage'][$j]['Language'];
		}
				
		if($page > $pager->getLastPage())
		$student = array();
		/**
		 * Smarty
		 */
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('count', $pager->getNumResults());
		$this->smarty->assign('order', $order == 'ASC' ? 'DESC' : 'ASC');
		$this->smarty->assign('teacher', $teachers);
		$this->smarty->assign('url','Admin/School/Teachers');
		$this->smarty->assign('add_student', $this->dynamicJS->getURLFilenameCompiled());
		$this->smarty->display("School/teachers.tpl");
	}
	
	private function deleteTeacher()
	{
		$id = $this->data[3];
		$teacherLang = Doctrine::getTable('TeacherLanguage')->findByTeacher($id);
		$teacherLang->delete();
		$teacher = Doctrine::getTable('Teacher')->find($id);
		$teacher->delete();
		OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST).'Admin/School/Teachers');
	}	
	
	private function languages()
	{
		//OrionTools_Debug::debugArray($this->data);
		$resultsPerPage 	= !empty($this->data[3]) && is_integer($this->data[3]) ? $this->data[3] : 10;
		$page 				= !empty($this->data[4]) && is_integer($this->data[3]) ? $this->data[4] : 1;
		$orderby			= !empty($this->data[6]) ? 	$this->data[6] : 'id';
		$order				= !empty($this->data[7]) ? 	strtoupper($this->data[7]) : 'ASC';
		
		$query = 	Doctrine_Query::create()
					->select('l.*')
					->from('Language l')
					->orderby('l.'.$orderby. ' ' . $order);
		
		$pager = new Doctrine_Pager(
			$query,
			$page,
			$resultsPerPage
		);
		
		$langs = $pager->execute()->toArray();
		
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('count', $pager->getNumResults());
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('languages', $langs);
		$this->smarty->assign('order', $order == 'ASC' ? 'DESC' : 'ASC');
		$this->smarty->assign('url','Admin/School/Languages');
		$this->smarty->assign('opt', 'add');
		
		if(!empty($_POST) && $this->data[3] == 'add')
		{
			$lang = new Language();
			$lang->name 		= $_POST['name'];
			$lang->created_by	= 'tiago_moura';
			$lang->save();
						
			OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Languages/'.$resultsPerPage.'/'.$page.'/OrderBy/'.$orderby.'/'.$order);
			exit();
		} elseif(!empty($_POST) && $this->data[3] == 'edit')
		{
			$lang = Doctrine::getTable('Language')->find($_POST['languageid']);
			$lang->name = $_POST['name'];
			$lang->save();
			OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Languages/'.$resultsPerPage.'/'.$page.'/OrderBy/'.$orderby.'/'.$order );
			exit();
		}
		
		elseif( 	!empty($this->data[3]) 	&& 
					$this->data[3] == 'del' && 
					!empty($this->data[4])
				)				
		{
			$coursesWithItsLang = Doctrine::getTable('Course')->findByLanguage($this->data[4])->count();
			if( $coursesWithItsLang == 0 )
			{
				$langs = Doctrine::getTable('Language')->find($this->data[4]);
				$langs->delete();
				OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Languages/'.$resultsPerPage.'/'.$page.'/OrderBy/'.$orderby.'/'.$order );
				exit();
			} elseif( $coursesWithItsLang > 0 )
			{
				OrionTools_Geral::alert('Há cursos cadastrados nesse idioma. Não é possivel excluir.');
				OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Languages');
			}
		} elseif(	!empty($this->data[3]) 		&&
					$this->data[3] == 'edit' 	&&
					!empty($this->data[4])
				)
		{
			$lang = Doctrine::getTable('Language')->find($this->data[4])->toArray();
			$this->smarty->assign('opt', 'edit');
			$this->smarty->assign('language', $lang);
			$this->smarty->display("School/languages.tpl");
		}
		
		$this->smarty->display("School/languages.tpl");
	}
	
	private function courses()
	{
		if( isset($_POST) && !empty($_POST['description']) )
		{
			$_POST['description'] = str_replace("\n", '', $_POST['description']);
			$_POST['description'] = preg_replace('/^(\n)|(\r)|(\r\n)/', '', $_POST['description']);
			$_POST['description'] = preg_replace('/\n/','',$_POST['description']);
			$_POST['description'] = preg_replace('/\'/', '\\\'', $_POST['description']);
		}		
		
		$resultsPerPage 	= !empty($this->data[3]) && is_integer($this->data[3]) ? $this->data[3] : 10;
		$page 				= !empty($this->data[4]) && is_integer($this->data[3]) ? $this->data[4] : 1;
		$orderby			= !empty($this->data[6]) ? 	$this->data[6] : 'id';
			$order			= !empty($this->data[7]) ? 	strtoupper($this->data[7]) : 'ASC';
		
		$query = 	Doctrine_Query::create()
					->select('c.*, l.name as language')
					->from('Course c')
					->leftJoin('c.Language l')
					->orderby('c.'.$orderby. ' ' . $order);
		
		$pager = new Doctrine_Pager(
			$query,
			$page,
			$resultsPerPage
		);
		
		$courses = $pager->execute()->toArray();
		
		$languages = Doctrine_Query::create()->select('l.*')->from('Language l')->execute(array(), Doctrine::HYDRATE_ARRAY);
		
		for($i=0;$i<count($courses);$i++)
		{
			$nrStudents = 	Doctrine_Query::create()
							->select('s.id')
							->from('Student s')
							->leftJoin('s.CourseStudent cs')
							->where('cs.course_id = ?', array($courses[$i]['id']))
							->execute()
							->count();
			$courses[$i]['students'] = $nrStudents;
		}
		
		//OrionTools_Debug::debugArray($courses, true, true, true, true);
		
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('count', $pager->getNumResults());
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('courses', $courses);
		$this->smarty->assign('languages', $languages);
		$this->smarty->assign('order', $order == 'ASC' ? 'DESC' : 'ASC');
		$this->smarty->assign('url','Admin/School/Courses');
		$this->smarty->assign('opt', 'add');
		
		if(!empty($_POST) && $this->data[3] == 'add')
		{
			$course = new Course();
			$course->name 			= $_POST['name'];
			$course->description	= $_POST['description'];
			$course->language_id	= $_POST['language'];
			$course->created_by		= 'tiago_moura';
			$course->save();
						
			OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Courses/'.$resultsPerPage.'/'.$page.'/OrderBy/'.$orderby.'/'.$order);
			exit();
		} elseif(!empty($_POST) && $this->data[3] == 'edit')
		{
			//OrionTools_Debug::debugArray($_POST, true, true, true, true);
			$course = Doctrine::getTable('Course')->find($_POST['courseid']);
			$course->name 			= $_POST['name'];
			$course->description	= $_POST['description'];
			$course->language_id	= $_POST['language'];
			$course->save();
			OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Courses/'.$resultsPerPage.'/'.$page.'/OrderBy/'.$orderby.'/'.$order );
			exit();
		}
		
		elseif( 	!empty($this->data[3]) 	&& 
					$this->data[3] == 'del' && 
					!empty($this->data[4])
				)				
		{
			
			if(	Doctrine::getTable('CourseStudent')
				->findByCourse($this->data[4])
				->count() > 0 )
			{
				OrionTools_Geral::alert("Você não pode excluir este curso, pois há alunos matriculados nele.");
				OrionTools_Geral::back();
			} else {	
				$course = Doctrine::getTable('Course')->find($this->data[4]);
				$course->delete();
				OrionTools_Geral::redirect( Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Courses/'.$resultsPerPage.'/'.$page.'/OrderBy/'.$orderby.'/'.$order );
				exit();
			}
		} elseif(	!empty($this->data[3]) 		&&
					$this->data[3] == 'edit' 	&&
					!empty($this->data[4])
				)
		{
			$course = Doctrine::getTable('Course')->find($this->data[4])->toArray();
			//OrionTools_Debug::debugArray($course, true, true, true, true);
			//$course['description'] = '"' . $course['description'] . '"';
			$this->smarty->assign('opt', 'edit');
			$this->smarty->assign('course', $course);
		}
		
		$this->smarty->display("School/courses.tpl");
	}
	
	private function companies()
	{
		$resultsPerPage = !empty($this->data[3]) ? $this->data[3] : 10;
		$page 			= !empty($this->data[4]) ? $this->data[4] : 1;
		$orderby		= !empty($this->data[6]) ? $this->data[6] : 'id';
		$order			= !empty($this->data[7]) ? strtoupper($this->data[7]) : 'ASC';
		
		$query = 	Doctrine_Query::create()
					->select("c.*, s.id")
					->from("Company c")
					->leftJoin('c.Students s');
		
		if($orderby == 'id' || $orderby == 'email_contact' || $orderby == 'name')
			$query->orderby('c.'.$orderby.' '.$order);
		
		$pager = new Doctrine_Pager(
			$query,
			$page,
			$resultsPerPage
		);
		
		$companies = $pager->execute(array(), Doctrine::HYDRATE_ARRAY);
		for($i=0;$i<count($companies);$i++)
		{
			$companies[$i]['students'] = count($companies[$i]['Students']);
		}
		//OrionTools_Debug::debugArray($companies);				
		if($page > $pager->getLastPage())
			$companies = array();
		/**
		 * Smarty
		 */
		$this->smarty->assign('resultsPerPage', $resultsPerPage);
		$this->smarty->assign('page', $page);
		$this->smarty->assign('totalPage', $pager->getLastPage());
		$this->smarty->assign('count', $pager->getNumResults());
		$this->smarty->assign('order', $order == 'ASC' ? 'DESC' : 'ASC');
		$this->smarty->assign('companies', $companies);
		$this->smarty->assign('url','Admin/School/Teachers');
		$this->smarty->display("School/companies.tpl");
	}
	
	private function deleteCompany()
	{
		$id = $this->data[3];
		
		
		// se tiver estudantes cadastrados nessa empresa, exibe a msg
		if(Doctrine::getTable('Student')->findByCompany($id)->count() > 0)
		{
			OrionTools_Geral::alert('Há estudantes cadastrados nessa empresa!!!');
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Companies');
		}
		
		$company = Doctrine::getTable('Company')->find($id)->delete();
		OrionTools_Geral::alert('Empresa excluída com sucesso.');
		OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Companies');
		
	}
	
	private function editCompany()
	{
		$this->smarty->assign('url', 'Admin/School/Company');
		$this->smarty->display('School/editCompany.tpl');
	}
	
	private function events()
	{
		$this->smarty->assign('url', 'Admin/School/Events');
		$this->smarty->display('School/events.tpl');
	}
	
	/**
	 * Ações do cadastro do estudante
	 *
	 */
	private function entryStudent()
	{
		if (isset($this->data[4]) && !empty($this->data[4])) 
			switch ($this->data[4])
			{
				case 'secondpart':
					$this->formEntryStudentSecondPart();
					break;
				case 'thirdpart':
					$this->formEntryStudentThirdPart();
					break;
				case 'save':
					$this->entryStudentSave();
					break;
				default:
					$this->formEntryStudent();
					break;
			}
		else 
			$this->formEntryStudent();
	}
	
	/**
	 * Formulario de cadastro de Estudantes
	 *
	 */
	private function formEntryStudent()
	{
		/**
		 * Gera o número de matrícula
		 */
		$nr_contract = Algorithms::getNextNrContract();
		
		$school = $this->_monitor->getInfoSchool();
		$country_id = $school['country_id'];
		$state_id	= $school['state_id'];
		$city_id	= $school['city_id'];
		
		$companies = Doctrine::getTable('Company')->findAll()->toArray();
		
		$this->dynamicJS->setJS('Admin/add_student2.js');
		$this->dynamicJS->assign('country_id', $country_id);
		$this->dynamicJS->assign('state_id', $state_id);
		$this->dynamicJS->assign('city_id', $city_id);
		$this->dynamicJS->assign('nr_contract', $nr_contract);
		$this->dynamicJS->processJS();
		

		/**
		 * Smarty
		 */
		$this->smarty->assign('date',date('d-m-Y'));
		$this->smarty->assign('url','Admin/School/Entries/Students');
		$this->smarty->assign('companies', $companies);
		$this->smarty->assign('add_student', $this->dynamicJS->getURLFilenameCompiled());
		$this->smarty->display("School/addStudent.tpl");
	}
	
	private function formEntryStudentSecondPart()
	{
	
		foreach($_POST as $key => $value)
		{
			$_SESSION[$key] = $value;
		}
		
		//Tools_Debug::debugArray($_SESSION, true, true, true, true);
		
		if($_SESSION['tipo'] == 'resp')
			$this->smarty->assign('resp',0);
		else 
			$this->smarty->assign('resp',1);
		
		# 		cursos
		$q =	Doctrine_Query::create()
				->select('c.name, l.name as language')
				->from('Course c')
				->leftJoin('c.Language l')
				->orderby('c.name ASC');
				
		$courses = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		
		# 		grade school
		$q	= 	Doctrine_Query::create()
				->select('g.*')
				->from('GradeSchool g');
		$grade_school = $q->execute()->toArray();
		
		#		civil status
		$q	= 	Doctrine_Query::create()
				->select('c.*')
				->from('CivilStatus c');
		$civil_status = $q->execute()->toArray();
		
		$this->smarty->assign('url','Admin/School/Entries/Students');
		$this->smarty->assign('courses', $courses);
		$this->smarty->assign('grade_school', $grade_school);
		$this->smarty->assign('civil_status', $civil_status);
		$this->smarty->assign('param','second_part');
		$this->smarty->display('School/addStudentSecondPart.tpl');
	}
	
	private function formEntryStudentThirdPart()
	{
		foreach($_POST as $key => $value)
			$_SESSION[$key] = $value;
		
		if($_SESSION['tipo'] == 'resp')
			$this->smarty->assign('resp', 0);
		else 
			$this->smarty->assign('resp', 1);
		
		$q =	Doctrine_Query::create()
				->select('c.name, l.name as language')
				->from('Course c')
				->leftJoin('c.Language l')
				->orderby('c.name ASC');
				
		$courses = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		
		$this->smarty->assign('url', 'Admin/School/Entries/Students');
		$this->smarty->assign('param', 'thirdpart');
		$this->smarty->assign('courses', $courses);
		$this->smarty->display('School/addStudentThirdPart.tpl');
	}
	
	/**
	 * Salva novo aluno
	 */
	private function entryStudentSave()
	{
		
		foreach($_POST as $key => $value)
			$_SESSION[$key] = $value;
			
		Tools_Debug::debugArray($_SESSION);
		exit();
		$this->validFormsForResponsibleStudent();
		
		/**
		 * Info Pedagogic 
		 */
		$pedagogic = new PedagogicStudent();
		$pedagogic->nr_children 	= $_SESSION['havechildren'] == 0 ? 
									  0 : 
									  $_SESSION['childrens'];
		$pedagogic->hobby			= $_SESSION['hobby'];
		$pedagogic->expectations	= $_SESSION['expectations'];
		$pedagogic->save();
		
		/**
		 * Info Student
		 */
		$student = 	new Student();
		
		$student->firstname			= $_SESSION['student_firstname'];
		$student->lastname			= $_SESSION['student_lastname'];
		$student->cpf				= $_SESSION['student_cpf'];
		$student->rg				= $_SESSION['student_rg'];
		$student->gradeschool_id	= $_SESSION['student_grade_school'];
		$student->civilstatus_id	= $_SESSION['student_civil_status'];
		$student->email_part		= $_SESSION['student_email_part'];
		$student->birthday			= $_SESSION['student_birthday']; 
		$student->tel_res			= $_SESSION['student_tel_res'];
		$student->tel_cel			= $_SESSION['student_tel_cel'];
		$student->nationality		= $_SESSION['student_nationality'];
		
		$student->pedagogic_id		= $pedagogic->id;
		$student->country_id		= $_SESSION['student_country_id'];
		$student->address			= $_SESSION['student_address'];
		$student->number			= $_SESSION['student_number'];
		$student->complement		= $_SESSION['student_complement'];
		$student->district			= $_SESSION['student_district'];
		$student->cep				= $_SESSION['student_cep'];
		
		if(empty($_SESSION['student_state_foreign']))
			$student->state_id		= $_SESSION['student_state_id'];
		else 
			$student->state_foreign		= $_SESSION['student_state_foreign'];
		if(empty($_SESSION['student_city_foreign']))
			$student->city_id		= $_SESSION['student_city_id'];
		else 
			$student->city_foreign	= $_SESSION['student_city_foreign'];
		if(!empty($_SESSION['addr_corresp']))
			$student->addr_corresp	= $_SESSION['addr_corresp'];
	
		if($_SESSION['tipo'] == 'resp')
		{
			/**
			 * FIXME : Rever todos os FIXME's abaixo para usar o método
			 * automatizado do doctrine de gravar os dados, percorrendo
			 * os arrays.
			 */			
			
			/**
			 * Student -> i_resp == BOOL WHERE 0 == "RESPONSIBLE" AND 1 == NOT_RESPONSIBLE */
			$student->i_resp			= 0;
			$student->responsible_id	= NULL;
			
				
			if($_SESSION['company_id'] != 0)
				$student->company_id	= $_SESSION['company_id'];
			else {
				$company = new Company();
				$company->name				= $_SESSION['company_name'];
				$company->address			= $_SESSION['company_address'];
				$company->number			= $_SESSION['company_number'];
				$company->complement		= $_SESSION['company_complement'];
				$company->tel				= $_SESSION['company_tel'];
				$company->fax				= $_SESSION['company_fax'];
				$company->district			= $_SESSION['company_district'];
				$company->country_id		= $_SESSION['company_country_id'];
				if(!empty($_SESSION['company_city_foreign']))
					$company->city_foreign	= $_SESSION['company_city_foreign'];
				else
					$company->city_id		= $_SESSION['company_city_id'];
				if(!empty($_SESSION['company_state_foreign']))
					$company->state_foreign = $_SESSION['company_state_foreign'];
				else 
					$company->state_id		= $_SESSION['company_state_id'];
				/** record in the database... */
				$company->save();
				
				
				/**
				 * $company->id store the value of the next free position in table Company.
				 * therefore, ($company->id - 1) store id of the previously company recorded.
				 */
				 $student->company_id	= ($company->id - 1);
			}			
			
			/** HIMANNN */
			$student->save();
			
			/**
			 * grava o relacionamento STUDENT -> COURSES
			 */
			$courseStudent = new CourseStudent();
			$courseStudent->nr_contract 			= $_SESSION['nr_contract'];
			$courseStudent->date_contract			= $_SESSION['date_contract'];
			$courseStudent->student_id				= $student->id;
			$courseStudent->course_id				= $_SESSION['course'];
			$courseStudent->course_book				= $_SESSION['course_book'];
			$courseStudent->appraised_for			= $_SESSION['appraised_for'];
			$courseStudent->level					= $_SESSION['level'];
			$courseStudent->pays_material			= $_SESSION['pays_material'];
			$courseStudent->date_pay_material		= $_SESSION['date_pay_material'];
			$courseStudent->value_pay_per			= $_SESSION['value_pay_per'];
			$courseStudent->pay_per					= $_SESSION['pay_per'];
			$courseStudent->value_registration		= $_SESSION['value_registration'];
			$courseStudent->date_pay_first_monthly	= $_SESSION['date_pay_first_monthly'];
			$courseStudent->amount_hours_month		= $_SESSION['amount_hours_month'];
			$courseStudent->date_expire				= $_SESSION['date_expire'];
			$courseStudent->observations			= $_SESSION['observations'];
			$courseStudent->save();
				
			OrionTools_Geral::alert("Estudante salvo com sucesso!");
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Students');
		} else {
			
			$student->i_resp = 1;
			$responsible = new Responsible();
			$responsible->firstname 	= $_SESSION['resp_firstname'];
			$responsible->lastname		= $_SESSION['resp_lastname'];
			$responsible->cpf			= $_SESSION['resp_cpf'];
			$responsible->rg 			= $_SESSION['resp_rg'];
			$responsible->civilstatus_id= $_SESSION['resp_civil_status'];
			$responsible->nationality	= $_SESSION['resp_nationality']; 
			$responsible->tel_res		= $_SESSION['resp_tel_res'];
			$responsible->tel_cel		= $_SESSION['resp_tel_cel'];
			$responsible->email_part	= $_SESSION['resp_email'];
			$responsible->address		= $_SESSION['resp_address'];
			$responsible->number		= $_SESSION['resp_number'];
			$responsible->complement	= $_SESSION['resp_complement'];
			$responsible->district		= $_SESSION['resp_district'];
			$responsible->country_id	= $_SESSION['country_id'];
			$responsible->state_id		= $_SESSION['state_id'];
			$responsible->city_id		= $_SESSION['city_id'];
						
			$responsible->save();
			
			$resp_rel = new RespRel();
			$resp_rel->resp_id 	= $responsible->id;
			$resp_rel->type_resp	= 0;
			$resp_rel->save();
			
			$student->responsible_id = $resp_rel->id;
			
			$student->save();
			
			/**
			 * grava o relacionamento STUDENT -> COURSES
			 */
			$courseStudent = new CourseStudent();
			$courseStudent->nr_contract 			= $_SESSION['nr_contract'];
			$courseStudent->date_contract			= $_SESSION['date_contract'];
			$courseStudent->student_id				= $student->id;
			$courseStudent->course_id				= $_SESSION['course'];
			$courseStudent->course_book		 		= $_SESSION['course_book'];
			$courseStudent->appraised_for			= $_SESSION['appraised_for'];
			$courseStudent->level					= $_SESSION['level'];
			$courseStudent->pays_material			= $_SESSION['pays_material'];
			$courseStudent->date_pay_material		= $_SESSION['date_pay_material'];
			$courseStudent->value_pay_per			= $_SESSION['value_pay_per'];
			$courseStudent->pay_per					= $_SESSION['pay_per'];
			$courseStudent->value_registration		= $_SESSION['value_registration'];
			$courseStudent->date_pay_first_monthly	= $_SESSION['date_pay_first_monthly'];
			$courseStudent->amount_hours_month		= $_SESSION['amount_hours_month'];
			$courseStudent->date_expire				= $_SESSION['date_expire'];
			$courseStudent->observations			= $_SESSION['observations'];
			$courseStudent->save();
			
			OrionTools_Geral::alert("Salvo!");
			OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Students');		
		
		}		
	}
	
	private function validFormsForResponsibleStudent()
	{
		
		if(empty($_SESSION['course']))
		{
			OrionTools_Geral::alert('Você deve cadastrar o usuário em algum curso.');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['level']))
		{
			OrionTools_Geral::alert('Você deve cadastrar o nível do estudante.');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['nr_contract']))
		{
			OrionTools_Geral::alert('Número do contrato não informado.');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['date_contract']))
		{
			OrionTools_Geral::alert('Insira a data do contrato');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['student_firstname']))
		{
			OrionTools_Geral::alert('O nome do estudante deve ser informado');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['student_lastname']))
		{
			OrionTools_Geral::alert('O sobrenome do estudante deve ser informado.');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['student_cpf']))
		{
			OrionTools_Geral::alert('O CPF do estudante deve ser informado.');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['student_email_part']))
		{
			OrionTools_Geral::alert('O email do estudante deve ser informado');
			OrionTools_Geral::back();
		}
		if(empty($_SESSION['student_tel_res']) && empty($_SESSION['student_tel_cel']))
		{
			OrionTools_Geral::alert('O telefone residencial ou celular do estudante deve ser informado.');
			OrionTools_Geral::back();
		}
		if(	empty($_SESSION['student_country_id']) 	|| 
			empty($_SESSION['student_address']) 	|| 
			empty($_SESSION['student_district'])
		)
		{
			OrionTools_Geral::alert('Preenche corretamente o endereço do estudante.');
			OrionTools_Geral::back();
		}
		if(	($_SESSION['tipo'] == 'resp' 	&& 
			$_SESSION['company_id'] != 0)	&&
			empty($_SESSION['company_name'])
		)
		{
			OrionTools_Geral::alert('Preencha corretamente os dados da nova empresa.');
			OrionTools_Geral::back();
		}
		if($_SESSION['tipo'] != 'resp')
		{
			if(empty($_SESSION['resp_firstname']) || empty($_SESSION['resp_lastname']))
			{
				OrionTools_Geral::alert('Insira o corretamente o nome do responsável.');
				OrionTools_Geral::back();
			}
			if(empty($_SESSION['resp_cpf']))
			{
				OrionTools_Geral::alert('Insira corretamente o CPF do responsável.');
				OrionTools_Geral::back();
			}
			if(empty($_SESSION['resp_tel_res']) && empty($_SESSION['resp_tel_cel']))
			{
				OrionTools_Geral::alert('Insira um telefone para contato com o responsável.');
				OrionTools_Geral::back();
			}
			if(empty($_SESSION['resp_address']) || empty($_SESSION['resp_district']))
			{
				OrionTools_Geral::alert('Preencha corretamente o endereço do responsável.');
				OrionTools_Geral::back();
			}
			
		}
	}
	
	/**
	 * Cadastro de Professores
	 *
	 */
	private function entryTeacher()
	{
		if( isset($this->data[4]) && $this->data[4] == 'save' && !empty($_POST) )
			$this->saveTeacher();
		
		$q = 	Doctrine_Query::create()
				->select('l.*')
				->from('Language l');
		$languages = $q->execute()->toArray();
		
		/**
		 * Smarty
		 */
		$this->smarty->assign('url','Admin/School/Entries/Teachers');
		$this->smarty->assign('languages', $languages);
		$this->smarty->assign('date_admission', date('d/m/Y'));
		$this->smarty->display("School/addTeacher.tpl");
	}
	
	private function saveTeacher()
	{
		$teacher = new Teacher();
		$teacher->firstname		= $_POST['firstname'];
		$teacher->lastname 		= $_POST['lastname'];
		$teacher->cpf			= $_POST['cpf'];
		$teacher->rg			= $_POST['rg'];
		$teacher->acronym		= $_POST['acronym'];
		$teacher->email			= $_POST['email'];
		$teacher->tel_res		= $_POST['tel_res'];
		$teacher->tel_cel		= $_POST['tel_cel'];
		$teacher->address		= $_POST['address'];
		$teacher->number		= $_POST['number'];
		$teacher->complement	= $_POST['complement'];
		$teacher->district		= $_POST['district'];
		$teacher->country_id	= $_POST['country_id'];
		if(empty($_POST['state_foreign']))
		{
			$teacher->state_id	= $_POST['state_id'];
			$teacher->city_id 	= $_POST['city_id'];
		} else {
			$teacher->state_foreign	= $_POST['state_foreign'];
			$teacher->city_foreign	= $_POST['city_foreign'];
		}
		
		$teacher->day_disp		= $_POST['day_disp'];
		$teacher->bank_name		= $_POST['bank_name'];
		$teacher->ag_bank		= $_POST['ag_bank'];
		$teacher->account_bank	= $_POST['account_bank'];
		$teacher->date_admission= $_POST['date_admission'];
		$teacher->readjustment	= $_POST['date_admission'];
		
		$teacher->save();
				
		foreach( $_POST as $key => $value )
		{
			if(preg_match('/language_(\d+)/', $key, $match))
			{
				$teacherLang = new TeacherLanguage();
				$teacherLang->teacher_id 	= $teacher->id;
				$teacherLang->language_id 	= $_POST['language_'.$match[1]];
				$teacherLang->pronunciation	= $_POST['pronunciation_'.$match[1]];
				$teacherLang->ntredacao		= $_POST['ntredacao_'.$match[1]];
				$teacherLang->ntteste		= $_POST['ntteste_'.$match[1]];
				
				$teacherLang->save();
				
				unset($teacherLang);
			}
		}
		
		OrionTools_Geral::alert("Professor cadastrado com sucesso.");
		OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Teachers');
	}
	
	/**
	 * cadastro de empresas
	 *
	 * @return unknown
	 */
	protected function entryCompany()
	{
		if( isset($this->data[4]) && $this->data[4] == 'save' && !empty($_POST) )
			$this->saveCompany();
		
		
		/**
		 * Smarty
		 */
		$this->smarty->assign('url','Admin/School/Entries/Company');
		$this->smarty->display('School/addCompany.tpl');
	}
	
	protected function saveCompany()
	{
		 $company = new Company();
		 $company->name 			= $_POST['name_company'];
		 $company->cnpj 			= $_POST['cnpj'];
		 $company->tel				= $_POST['tel'];
		 $company->tel_fax			= $_POST['tel_fax'];
		 $company->email_contact	= $_POST['email_contact'];
		 $company->email_finance	= $_POST['email_finance'];
		 $company->address			= $_POST['address'];
		 $company->district			= $_POST['district'];
		 $company->country_id		= $_POST['country_id'];
		 if(!empty($_POST['state_foreign']))
		 {
			$company->state_foreign	= $_POST['state_foreign'];
			$company->city_foreign 	= $_POST['city_foreign'];
		 } else {
		if(!empty($_POST['state_id']))
			$company->state_id		= $_POST['state_id'];
		if(!empty($_POST['city_id']))
			$company->city_id		= $_POST['city_id'];
		}
		$company->save();
		
		OrionTools_Geral::alert('Empresa salva com sucesso.');
		OrionTools_Geral::redirect(Orion::getAttribute(Orion::ATTR_HOST) . 'Admin/School/Entries/Companies');
		
	}
}