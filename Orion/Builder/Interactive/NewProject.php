<?php
/*
    This library is free software; you can redistribute it and/or
    modify it under the terms of the GNU Library General Public
    License version 2 as published by the Free Software Foundation.

    This library is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    Library General Public License for more details.

    You should have received a copy of the GNU Library General Public License
    along with this library; see the file COPYING.LIB.  If not, write to
    the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
    Boston, MA 02110-1301, USA.

    ---
    Copyright (C) 2009, Tiago Natel de Moura tiago_moura@live.com
*/

/**
 * Orion
 * {info}
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class OrionBuilder_Interactive_NewProject
	extends OrionBuilder_Interactive
{
	public $project;
	protected $step = 0;
	protected $steps = array(
		0 	=> 'Commands',
		1 	=> 'Models',
		2 	=> 'Fixtures',
		3 	=> 'Unit Tests',
		4 	=> 'Scripts'
	);
	
	public function __construct()
	{
	
	}
	
	public function mainMenu()
	{
		$this->inputProjectName();
		$this->createProject();		
	}
	
	protected function inputProjectName()
	{
		printf("\n\tNome do projeto: ");
		$project = fscanf(STDIN, "%s");
		
		$this->validNameProject($project[0]);
	}
	
	protected function validNameProject( $name )
	{
		if( $name == '')
		{
			printf("\tVocê deve dar um nome ao seu projeto...\n");
			$this->inputProjectName();
		} else {
			$this->project = $name;
		}
	}
	
	public function createProject()
	{
		$this->presents();
		printf("\t...: \n");
		printf("\tOs seguintes diretórios serão criados: ");
		printf("\t\n");
		$dirs = array();
		
		$dirs[0] = getcwd() . '/apps';
		$dirs[1] = $dirs[0] . '/' . $this->project;
		$dirs[] = $dirs[1] . '/' . OrionCli::$_configs['directories']['dir_commands'];
		$dirs[] = $dirs[1] . '/' . OrionCli::$_configs['directories']['database']['dir_database'];
		$dirs[] = $dirs[count($dirs)-1] . '/' . OrionCli::$_configs['directories']['database']['dir_fixtures'];
		$dirs[] = $dirs[count($dirs)-2] . '/' . OrionCli::$_configs['directories']['database']['dir_models'];
		$dirs[] = $dirs[count($dirs)-3] . '/' . OrionCli::$_configs['directories']['database']['dir_sql'];
		$dirs[] = $dirs[1] . '/' . OrionCli::$_configs['directories']['libs']['dir_libs'];
		$dirs[] = $dirs[count($dirs)-1] . '/' . OrionCli::$_configs['directories']['libs']['dir_universal'];
		$dirs[] = $dirs[1] . '/' . OrionCli::$_configs['directories']['dir_scripts'];
		$dirs[] = $dirs[1] . '/' . OrionCli::$_configs['directories']['dir_view'];
		
		foreach($dirs as $dir)
			if(!file_exists($dir))
				printf("\t\t%s\n", $dir);
		if(count($dirs) == 0)
			printf("\t\tDiretórios já existem!!!");
		
		printf("\n\tTem certeza que deseja criar um novo projeto de nome: %s.[y/n] : ", $this->project);
		$o = '0';
		while($o != 'y' && $o != 'n')
			$o = $this->getSTDIN("%c");
		
		if($o == 'n')
			$this->mainMenu();
		else {
			$this->_createProject($dirs);
		}
	}
	
	private function _createProject( $dirs )
	{
		foreach($dirs as $dir)
			$this->makeDir($dir, $dir);
		
		printf("\n\t\tDiretórios criados com sucesso.\n");
		sleep(2);
		$o = '0';
		while( $o != 'q' && $o != '8')
		{
			$this->mainMenu_l2();
			
			$o = $this->getSTDIN("%c");
		
			switch($o)
			{
				case '1':
					$this->generateAllApps();
					break;
				case '2':
					$this->generateNextStep();
					break;
				case '3':
					$this->generateConfigFiles();
					break;
				case '4':
					$this->generateCommands();
					break;
				case '5':
					$this->generateModels();
					break;
				case '6':
					$this->generateFixtures();
					break;
				case '7':
					$this->generateUnitTests();
					break;
				case '8':
					$this->generateScripts();
				case '9':
					{
						$this->mainMenu();
						exit();
					}
					break;
				case 'q':
					exit();
			}
		}
	}
	
	private function mainMenu_l2()
	{
		$this->presents();
		printf("\tArquivos de Projeto:\n");
		printf("\t1 - Criar todos os arquivos default do projeto.\n");
		printf("\t2 - Próximo passo: " . $this->steps[$this->step] . ".\n");
		printf("\t3 - Criar arquivos de configuração.\n");
		printf("\t4 - Criar Commands.\n");
		printf("\t5 - Criar Models.\n");
		printf("\t6 - Criar Fixtures.\n");
		printf("\t7 - Criar default Unit tests.\n");
		printf("\t8 - Criar default scripts.\n");
		printf("\t9 - Voltar ao Menu Principal\n");
		printf("\tq - Sair.\n");
		printf("\tEscolha: ");
	}
	
	private function generateAllApps()
	{
		$this->generateConfigFiles();
		$this->generateCommands();
		$this->generateModels();
		$this->generateFixtures();
		$this->generateUnitTests();
		$this->generateScripts();
	}
	
	private function generateConfigFiles()
	{
		$build = new OrionBuilder_Files( array('', '', $this->project) );
		$build->generateConfigFile( 'Orion/Templates/config.yml' );
		$build->generateFile( 	'Orion/Templates/scripts_configs_proj.yml', 
								Orion::getPathIndex() . DIRECTORY_SEPARATOR . 
								'scripts' . DIRECTORY_SEPARATOR . 
								'projects' . DIRECTORY_SEPARATOR . 
								$this->project . '.yml' 
							);
	}
	
	private function generateCommands()
	{
		$this->presents();
		
		$build = new OrionBuilder_Command();
		$build->generateProtoCommand(
					$this->project,
					'Index',
					array('Index','Manager')
		);
		$this->step++;
		sleep(1);
		print ".";
		sleep(1);
		print ".";
		sleep(1);
		print ".\n";
		sleep(1);
	}
	
	private function generateModels()
	{
		$this->presents();
		
		$dirTemplates = Orion::getPath() . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'ObjectModels';
		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirTemplates), RecursiveIteratorIterator::LEAVES_ONLY);
		foreach($files as $file)
			$templates[] = $file;
		$o = '0';
		while($o != 'q')
		{
			printf("\n\tLista de Template ObjectModels existente:\n\n");
			$i = 0;

			foreach($files as $file)
			{	
				printf("\t%d\t%s\n", $i, basename($file, 'Template.php'));
				
				$i++;
			}
			printf("\tDigite 'q' quando terminar.\n");
			printf("\tEscolha um Model: ");
			$o = $this->getSTDIN("%c");
			$this->_generateModels($templates[$o]);
		}
	}
	
	private function _generateModels( $file )
	{
		if(file_exists($file))
		{
			$impl = array();
			$this->presents();
			printf("\tPor favor, dê um nome para esse Model: [%s] ", basename($file, "Template.php"));
			$name = $this->getSTDIN("%s");
			$build = new OrionBuilder_Models($this->project);
			$impl = $build->generateOrionTemplateModel($file, $name, $this->project);
			
			if(is_array($impl) && count($impl) > 0)
				foreach( $impl as $template => $model )
					$build->registerImpl( $template, $model );
		}
		return;
	}
	
	private function generateFixtures()
	{
		$this->presents();
		printf("\tGerando Fixtures...\n\n");
		sleep(2);
	}
	
	private function generateUnitTests()
	{
		$this->presents();
		printf("\n\tGerando Unit Tests\n\n");
		sleep(2);
	}
	
	private function generateScripts()
	{
		$this->presents();
		printf("\n\tGerando Scripts...\n");
		$this->generateScriptsDfCommands();
		$this->generateScriptsDfDatabase();
		$this->generateScriptsDfView();
	}
	
	private function generateScriptsDfCommands()
	{
	
	}
	
	private function generateScriptsDfDatabase()
	{
		$build = new OrionBuilder_Files();
		return;
	}
	
	private function generateScriptsDfView()
	{
		return;
	}
	
}