<?php

require_once("configure_tests.php");


class testOrion extends UnitTestCase
{
	protected $instance;
	protected $projeto = "Test";
	
	public function setUp()
	{
		$this->instance = Orion::getInstance();
		Orion::setAttribute(Orion::ATTR_ENV, Orion::ATTR_ENV_TEST);
	}
	
	public function testIf__SimpleTest__IsNotCrazy()
	{
		$this->assertTrue(true);
		
		$this->assertFalse(false);
	}
	
	public function testIf__ClassOrion__Exists()
	{
		$this->assertTrue(class_exists('Orion', false));
	}
	
	public function testIf__MethodGetInstance__Exists()
	{
		$this->assertTrue(method_exists('Orion', 'getInstance'));
	}
	
	public function testIf__PatternSingleton__Works()
	{
		$instance2 = Orion::getInstance();
		$this->assertTrue(	$this->instance === $instance2, 
							"Testa se o pattern Singleton está funcionando."
		);
	}
	
	public function testIf__ClassOrion__IsNotClonable()
	{
		try {
			$instance2 = clone $this->instance;			
			$this->assertFalse(	$instance2, 
								"Se a classe permitir a clonagem esse assertFalse será chamado e falhará o teste"
			);
		} catch(OrionException $e)
		{
			$instance2 = false;
			$this->assertFalse(	$instance2, 
								"Somente será chamado se a classe não permitir clonagem"
			);
		}
		
	}
	
	public function testIf__MethodAutoload__Exists()
	{
		$this->assertTrue('Orion', 'autoload');
	}
	
	public function testIf__Method___init_getInstanceOfOrionKernel()
	{
		$configs = array();
		$configs['path_project'] = dirname(__FILE__) . Orion::DIR_SEP . 'project_test';
		$configs['project'] = 'project_test';
		
		try {
			$this->instance->init($configs);
		} catch(OrionException $e) { }
		
		$this->assertTrue(isset(Orion::$_kern));
		$this->assertTrue(is_object(Orion::$_kern));
		$this->assertEqual(get_class(Orion::$_kern), 'OrionKernel');
		$kern = clone Orion::$_kern;
		$this->assertEqual(get_class($kern::$_env), 'OrionCommand_Settings_Environment');
		$this->assertEqual(get_class($kern::$organizer), 'OrionOrganizer');
	}
	
	public function testIf__Method___Init_setDefaultsConfigs_Works()
	{
		$df = OrionCommand_Settings::getDfConfiguration();
		foreach($df as $key => $value)
			Orion::setAttribute($key, $value);
			
		foreach($df as $key => $value)
			$this->assertEqual($value, Orion::getAttribute($key));
	}
	
	public function testIf__setAttribute__Works()
	{
		Orion::setAttribute(2000, 'testando');
		$this->assertEqual('testando', Orion::getAttribute(2000));
		Orion::setAttribute(2001, 20);
		$this->assertEqual(20, Orion::getAttribute(2001));
		Orion::setAttribute(2002, array('teste1', 'teste2', 'teste3'));
		$this->assertEqual(array('teste1', 'teste2', 'teste3'), Orion::getAttribute(2002));
		
		/**
		 * TODO :: NÃO SE DEVE AJUSTAR UMA STRING COMO
		 * CHAVE DE ATRIBUTO.
		 * AS CONFIGURAÇÕES DO ORION NÃO FUNCIONARÃO COM
		 * ARRAY ASSOCIATIVO
		 */
		Orion::setAttribute("Tentanto setar um array associativo", "isto não vai gravar :)");
		$this->assertNotEqual("isto não vai gravar :)", Orion::getAttribute("Tentanto setar um array associativo"));
	}
	
	/**
	 * Deverá lançar uma exception, pois não encontrará
	 * o arquivo YAML de configuração do projeto
	 */
	public function testIf__Init__Works_WithoutArrayOfConfigs()
	{
		try {
			$return = $this->instance->init($this->projeto);
			/** deverá falhar */
			$this->assertFalse(	true, 
								"Deverá falhar, pois o Orion deverá lançar uma exception se não for encontrado o arquivo YAML de configuração"
			);
		} catch(OrionException $e)
		{
			$this->assertTrue(!isset($return));
			$this->assertFalse(false);
		}
	}
	
	public function testIf__Init__Works_WithArrayOfConfigs_Case_1()
	{
		$configs 					= array();
		$configs['project'] 		= 'project_test';
		
		try {
			$this->instance->init($configs);
			/** deverá falhar */
			$this->assertFalse(	true, 
								"Deverá falhar, pois o Orion deverá lançar uma exception se não for encontrado o arquivo YAML de configuração"
			);
		} catch(OrionException $e)
		{
			$this->assertTrue(true);
		}
	}
	
	public function testIf__Init__Works_WithArrayOfConfigs_Case_2()
	{
		$configs 					= array();
		$configs['path_project'] 	= TESTS_PATH . SEP . 'project_test';
		$configs['project'] 		= 'project_test';
		
		try {
			$this->instance->init($configs);
			$this->assertTrue(true);
		} catch(OrionException $e)
		{
			$this->assertFalse(false);
		}
	}
	
	public function testIf__Init__Works__PATH_PROJECT_InArray()
	{
		$configs = array();
		$configs['path_project'] = 'teste';
		try {
			$this->instance->init($configs);
			$this->assertEqual(Orion::ATTR_DIR_PROJECT, 'teste');
		} catch(OrionException $e) { }
	}
	
	public function testIf__Init__Works__PATH_PROJECT_InString()
	{
		$configs = "teste";
		try {
			$this->instance->init($configs);
			$this->assertEqual(Orion::ATTR_DIR_PROJECT, $configs);
		} catch(OrionException $e) { }
	}
	
	public function testIf__MethodSetAttribute__ByArrayOfConfigsWorks()
	{
		$configs = array();
		$configs['path_project'] = "/teste/project_test";
		$configs['project']	= 'project_test';
		$configs[Orion::ATTR_DIR_COMMANDS] = "command_test";
		$configs[Orion::ATTR_DIR_DATABASE] = "database_test";
		
		try {
			$this->instance->init($configs);
			$this->assertEqual(Orion::getAttribute(Orion::ATTR_DIR_COMMANDS), "command_test");
			$this->assertEqual(Orion::getAttribute(Orion::ATTR_DIR_DATABASE), "database_test");
			$this->assertEqual(Orion::getAttribute(Orion::ATTR_DIR_PROJECT), "/teste/project_test");
			$this->assertEqual(Orion::getAttribute(Orion::ATTR_PROJECT), "project_test");
		} catch(OrionException $e) { }
	}
	
	public function testIf__Init__Throw__Where_FileConfigYAMLNotExists()
	{
		$configs = array();
		$configs['path_project'] = "/um/local/desconhecido";
		$configs['project'] = "projeto_inexistente";
		
		try {
			$this->instance->init($configs);
			
		} catch(OrionException $e)
		{
			$this->assertEqual($e->getCode(), OrionError::PAGE_NOT_FOUND);
		}
	}
	
	public function testIf__Init__ConfigurationOtherLibraries__Works__withPathWrong()
	{
		$configs = array();
		$configs['path_project'] = dirname(__FILE__) . Orion::DIR_SEP . 'project_test';
		$configs['project'] = 'project_test';
		$configs['library'] = array(
			'/algum/lugar/apontando/para/outra/biblioteca',
			'NomeDaClasseDaBiblioteca',
			'nome_da_funcao_autoload'
		);
		
		try {
			$this->instance->init($configs);
			$this->fail();
		} catch (OrionException $e)
		{
			$this->assertEqual($e->getCode(), OrionError::SET_LIBRARY);
		}
	}
	
	public function testIf__Init__ConfigurationOtherLibraries__Works__withClassWrong()
	{
		$configs = array();
		$configs['path_project'] = dirname(__FILE__) . Orion::DIR_SEP . 'project_test';
		$configs['project'] = 'project_test';
		$configs['library'] = array(
			dirname(__FILE__) . Orion::DIR_SEP . 'Orion/Vendor/LibraryTest.php',
			'NameLibraryWrong',
			'nome_da_funcao_autoload'
		);
		
		try {
			$this->instance->init($configs);
			$this->fail();
		} catch (LogicException $e)
		{
			$this->assertTrue(preg_match('/Passed array does not specify an existing static method/', $e->getMessage()));
		}
	}
	
	public function testIf__Init__ConfigurationOtherLibraries__Works__withAutoloadWrong()
	{
		$configs = array();
		$configs['path_project'] = dirname(__FILE__) . Orion::DIR_SEP . 'project_test';
		$configs['project'] = 'project_test';
		$configs['library'] = array(
			dirname(__FILE__) . Orion::DIR_SEP . 'Orion/Vendor/LibraryTest.php',
			'LibraryTest',
			'nome_da_funcao_autoload_wrong'
		);
		
		try {
			$this->instance->init($configs);
			$this->fail();
		} catch (LogicException $e)
		{
			$this->assertTrue(preg_match('/Passed array does not specify an existing static method/', $e->getMessage()));
		}
	}
	
	public function testIf__Init__ConfigurationOtherLibraries__Works__withLibrariesCorrects()
	{
		$configs = array();
		$configs['path_project'] = dirname(__FILE__) . Orion::DIR_SEP . 'project_test';
		$configs['project'] = 'project_test';
		$configs['library'] = array(
			dirname(__FILE__) . Orion::DIR_SEP . 'Orion/Vendor/LibraryTest.php',
			'LibraryTest',
			'autoload'
		);
		
		try {
			$this->instance->init($configs);
			$this->pass();
		} catch (LogicException $e)
		{
			$this->fail();
		} catch (OrionException $e) { 
			$this->assertEqual(OrionError::PAGE_NOT_FOUND, $e->getCode());
		}
		
		$passClass 	= false;
		$passMethod = false;
		foreach(spl_autoload_functions() as $classes)
			if($classes[0] == 'LibraryTest')
				$passClass = true;
			elseif($classes[1] == 'autoload')
				$passMethod = true;
		$this->assertTrue($passClass);
		$this->assertTrue($passMethod);
	}
	
	public function testIf__Init__IsRegisterOrionAutoload__Correctly()
	{
		$configs = array();
		$configs['path_project'] = dirname(__FILE__) . Orion::DIR_SEP . 'project_test';
		$configs['project'] = 'project_test';

		foreach(spl_autoload_functions() as $spl)
			if($spl[0] == 'Orion')
			{
				$pass = true;
				if($spl[1] == 'autoload')
					$this->pass();
				else
					$this->fail();
			}
		if(!isset($pass))
			$this->fail();
	}
	
	public function testIf__MethodAutoload__Works()
	{
		$configs = array();
		$configs['path_project'] = dirname(__FILE__) . Orion::DIR_SEP . 'project_test';
		$configs['project'] = 'project_test';
		$configs[Orion::ATTR_DIR_PROJECT] = dirname(__FILE__) . Orion::DIR_SEP . $configs['project'];
		$configs[Orion::ATTR_DIR_UNIVERSE] = 'libs/universal';
		
		try {
			$this->instance->init($configs);
		} catch(OrionException $e)
		{
			//OrionTools_Debug::debugArray(OrionKernel::$organizer->paths);
			$this->assertEqual(OrionError::PAGE_NOT_FOUND, $e->getCode());
		}
		$this->assertTrue(is_object(new OrionBuilder_Cli(1, 'teste')));
		$this->assertTrue(is_object(new OrionBuilder_Interactive_Cli()));
		$this->assertFalse(class_exists('Builder_Cli'));
		$this->assertTrue(is_object(new MinhaClasse()));
		$this->assertTrue(is_object(new MinhaUniversalClass()));
	}
	
	public function testIf__GetAttribute__Works()
	{
		Orion::setAttribute(1500, 'teste');
		Orion::setAttribute(1501, 'outroteste');
		$this->assertEqual('teste', Orion::getAttribute(1500));
		$this->assertEqual('outroteste', Orion::getAttribute(1501));
		
		/** teste se sobrescreve attributo */
		Orion::setAttribute(1500, 'teste sobrescrito');
		$this->assertEqual('teste sobrescrito', Orion::getAttribute(1500));
	}
	
	public function testIf__MethodGetAttrEnvironment__Works()
	{
		Orion::setAttribute(Orion::ATTR_ENV, Orion::ATTR_ENV_DEV);
		$this->assertEqual('development', Orion::getAttrEnvironment(true));
		$this->assertEqual(Orion::ATTR_ENV_DEV, Orion::getAttrEnvironment());
		Orion::setAttribute(Orion::ATTR_ENV, Orion::ATTR_ENV_PROD);
		$this->assertEqual(Orion::ATTR_ENV_PROD, Orion::getAttrEnvironment());
		$this->assertEqual('production', Orion::getAttrEnvironment(true));
		Orion::setAttribute(Orion::ATTR_ENV, Orion::ATTR_ENV_TEST);
		$this->assertEqual('test', Orion::getAttrEnvironment(true));
		Orion::setAttribute(Orion::ATTR_ENV, 'WRONG');
		try {
			$this->assertNotEqual('WRONG', Orion::getAttrEnvironment(true));
		} catch(OrionException $e)
		{
			$this->pass();
		}
	}
	
	public function testIf__MethodGetDfPathProjects__Works()
	{
		$this->assertTrue(Orion::getDfPathProjects());
		Orion::$_SERVER['DOCUMENT_ROOT'] = FALSE;
		$this->assertEqual(FALSE, Orion::getDfPathProjects());
		Orion::$_SERVER['DOCUMENT_ROOT'] = '/var/www';
		$this->assertEqual('/var', Orion::getDfPathProjects());
	}
	
	public function testIf__MethodGetProjectURL__Works()
	{
		/** FIXME */
	}
	
	public function testIf__MethodGetFormattedClassCommand()
	{
		$this->assertEqual('UserCommand', Orion::getFormatedClassCommand('User'));
		Orion::setAttribute(Orion::ATTR_FORMAT_CLASS_COMMAND, '%sTeste');
		$this->assertEqual('UserTeste', Orion::getFormatedClassCommand('User'));
		Orion::setAttribute(Orion::ATTR_FORMAT_CLASS_COMMAND, '%sClassTestando');
		$this->assertEqual('testeClassTestando', Orion::getFormatedClassCommand('teste'));
		
		Orion::setAttribute(Orion::ATTR_FORMAT_CLASS_COMMAND, '%sController');
		$this->assertEqual('NoticiasController', Orion::getFormatedClassCommand('Noticias'));
	}
	
	public function testIf__Method__Clone__NotWorks()
	{
		try {
			$this->instance2 = clone $this->instance;
			$this->fail();
		} catch(OrionException $e)
		{
			$this->pass();
		}
	}
}