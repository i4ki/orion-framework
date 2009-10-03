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
 * OrionBuilder_Cli
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionBuilder_Cli 
	extends OrionCli
		implements OrionICli
 {
	protected $_argc = 0;
	protected $_argv = array();
	
	public function __construct( $argc, $argv )
	{
		$this->_argc = $argc;
		$this->_argv = $argv;
		parent::__construct();
		
	}
	
	public function run()
	{
		$this->getOption();
	}
	
	public function getOption()
	{
		if(isset($this->_argv[1]))
			if( ($this->_argv[1] == 'apps') || ($this->_argv[1] == '-a') )
				$this->generateApps();
			elseif( $this->_argv[1] == 'command' || $this->_argv[1] == '-c')
				$this->generateCommand( $this->_argv[2] );
			elseif( $this->_argv[1] == 'library' || $this->_argv[1] == '-l' )
				$this->generateLibrary( $this->argv[2] );
			elseif( $this->_argv[1] == 'models' || $this->_argv[1] == '-m' )
				$this->generateModels( $this->_argv[2] );
			elseif( $this->_argv[1] == 'fixtures' || $this->_argv[1] == '-f' )
				$this->fixtures();
			elseif( $this->_argv[1] == '--version' || $this->_argv[1] == '-v' )
				$this->showVersion();
			elseif( $this->_argv[1] == '--interactive' || $this->_argv[1] == '-i' )
				$this->interactiveCli();
			elseif( $this->_argv[1] == '--help' || $this->_argv[1] == '-h')
				$this->help();
			else
				$this->help();
		else
			$this->help();
	}
	
	public function help()
	{
		$this->greetings();
		
		if( isset($this->_argv[1]) && $this->_argv[1] == 'help' && $this->_argc > 2 )
		{
			if ( isset($this->_argv[2]) && $this->_argv[2] == 'apps' || $this->_argv[2] == '-a' )
			{
				printf("\n");
				print "\033[31;33;40m@see help apps:\033[0m\n";
				printf("'scripts/creator apps' gera toda a estrutura de um projeto Orion, isto inclui os diretórios:\n\n");
				printf("apps/\t\tDiretório raiz do projeto.\n");
				printf("apps/commands\tOnde estará os Commands (ou Controllers) do projeto.\n");
				printf("apps/database\tOnde estará os models e os arquivos de configuração do banco de dados.\n");
				printf("apps/scripts\tDiretório de scripts úteis.\n");
				printf("apps/tests\tOnde estará os testes unitários da aplicação.\n");
				printf("apps/view\tDiretório que conterá todo o front do projeto. ( [x]html, css, js, .*? )\n");
				printf("\n");
				printf("Também será automaticamente gerado os esqueletos dos Commands, models, tests, configurações, etc.\n");
			}
		} else {
			if(is_writable(getcwd()))
				copy(	Orion::getPathOrion() . DIRECTORY_SEPARATOR .
						'scripts' . DIRECTORY_SEPARATOR .
						'creator', 
						getcwd() . DIRECTORY_SEPARATOR . 'creator'
				);
			chmod(getcwd().DIRECTORY_SEPARATOR.'creator', 0777);
			
			printf("\n");
			print "\033[31;33;40mInformações:\033[0m\n";
			printf(" -v, --version\t\tExibir a versão do Orion\n");
			printf(" -h, --help\t\tExibir essa ajuda\n");
			printf(" -i, --interative\tRodar interativamente.\n");
			printf("\n");
			printf("\033[31;33;40mBerçário:\033[0m\n");
			printf(" -a, apps\t\tCria toda a estrutura de um projeto Orion. @see help apps\n"); 
			printf(" -c, command\t\tCria um novo Command. @see help command\n");
			printf(" -l, library\t\tCria uma nova biblioteca de classes.\n");
			printf(" -m, models\t\tCria os models. @see help models\n");
			printf("\n");
			exit();
		}
	}
	
	private function generateApps()
	{
		if( empty($this->_argv[2]) )
		{
			printf("Você deve dar um nome ao novo projeto.\n");
			printf("Use: scripts/creator apps meu_projeto\n");
			exit(1);
		} else
			$project = $this->_argv[2];
			
		if (!file_exists('apps'))
			if( mkdir('apps') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/\n"); 
		chmod('apps',0777);
		
		if(! file_exists('apps/' . $project) )
			if( mkdir('apps/'.$project) !== FALSE )
				printf("\033[31;33;40mproject created:\033[0m %s\n",$project);
		chmod('apps/'.$project, 0777);
		
		$dir = 'apps/'.$project.'/modules';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
		chmod($dir, 0777);
		
		$dir = 'apps/' . $project . '/modules/commands';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
		chmod($dir, 0777);
		
		$dir .= '/Index';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
		chmod($dir, 0777);
		
		$dir = 'apps/'.$project.'/modules/models';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
			else
				printf("\033[31;33;40mDiretório já existe ou não pode ser criado: %s\n", $dir);
		chmod($dir, 0777);
		
		$dir = 'apps/'.$project.'/modules/view';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
			else
				printf("\033[31;33;40mO diretório já existe ou não pode ser criado: %s\033[0m %s\n", $dir);
		chmod($dir, 0777);
		
		$dir = 'apps/' . $project . '/modules/view/javascript';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
		chmod($dir, 0777);
		
		$dir = 'apps/'.$project.'/modules/view/images';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
		chmod($dir, 0777);
		
		$dir = 'apps/'.$project.'/modules/view/stylesheets';
		$dir = str_replace('/', DIRECTORY_SEPARATOR, $dir);
		if(! file_exists($dir) )
			if( mkdir($dir) !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m %s\n", $dir);
		chmod($dir, 0777);		
		
		if(! file_exists('apps/' . $project . '/database') )
			if( mkdir('apps/' . $project . '/database') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/database\n", $project);
		chmod('apps/' . $project . '/database', 0777);
		
		if(! file_exists('apps/' . $project . '/database/models') )
			if( mkdir('apps/' . $project . '/database/models') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/database/models\n", $project);
		chmod('apps/' . $project . '/database/models', 0777);
		
		if(! file_exists('apps/' . $project . '/database/fixtures') )
			if( mkdir('apps/' . $project . '/database/fixtures') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/database/fixtures\n", $project);
		chmod('apps/' . $project . '/database/fixtures', 0777);
		
		if(! file_exists('apps/' . $project . '/database/sql') )
			if( mkdir('apps/' . $project . '/database/sql') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/database/sql\n", $project);
		chmod('apps/' . $project . '/database/sql', 0777);
		
		if(! file_exists('apps/' . $project . '/libs') )
			if( mkdir('apps/' . $project . '/libs') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/libs\n", $project);
		chmod('apps/' . $project . '/libs', 0777);
		
		if(! file_exists('apps/' . $project . '/libs/universal') )
			if( mkdir('apps/' . $project . '/libs/universal') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/libs/universal\n", $project);
		chmod('apps/' . $project . '/libs/universal', 0777);
		
		if(! file_exists('apps/' . $project . '/scripts') )
			if( mkdir('apps/' . $project . '/scripts') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/scripts\n", $project);
		chmod('apps/' . $project . '/scripts', 0777);
		
		if(! file_exists('apps/' . $project . '/tests') )
			if( mkdir('apps/' . $project . '/tests') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/tests\n", $project);
		chmod('apps/' . $project . '/tests', 0777);

		if(! file_exists('apps/' . $project . '/tests/fixtures') )
			if( mkdir('apps/' . $project . '/tests/fixtures') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/tests/fixtures\n", $project);
		chmod('apps/' . $project . '/tests/fixtures', 0777);

		if(! file_exists('apps/' . $project . '/tests/mocks') )
			if( mkdir('apps/' . $project . '/tests/mocks') !== FALSE )
				printf("\033[31;33;40mdirectory created:\033[0m apps/%s/tests/mocks\n", $project);
		chmod('apps/' . $project . '/tests/mocks', 0777);
		
		$this->generateDfCommands();
		$this->generateDfUnitTests();
		$this->generateDfConfigFiles();
		
		return $this;
	}
	
	private function generateDfCommands()
	{
		$build = new OrionBuilder_Command();
		$build->generateProtoCommand(
					$this->_argv[2],
					'Index',
					array('Index','Manager'), 
					$this->_argv
		);
	}
	
	private function generateDfUnitTests()
	{
		$build	= new OrionBuilder_UnitTests( $this->_argv );
		$build->generateTest(	'apps' . DIRECTORY_SEPARATOR . 
								$this->_argv[2] . DIRECTORY_SEPARATOR . 
								'commands' . DIRECTORY_SEPARATOR . 
								'Index' . DIRECTORY_SEPARATOR . 
								'Index.php'
							);
	}
	
	private function generateDfConfigFiles()
	{
		$build = new OrionBuilder_Files( $this->_argv );
		
		$build->generateConfigFile( 'Orion/Templates/config.yml' );
	}
	
	private function generateCommand( $command )
	{
		$build = new OrionBuilder_Command( $this->_argv );
		$build->generateProtoCommand( $this->_argv[2], array($command) );
		
		return $this;
	}
	
	private function generateHtaccess( $path )
	{
		$build = new OrionBuilder_Files( $this->_argv );
		$build->generateHtaccess( $path );
	}
	
	private function fixtures()
	{
		$fix = new OrionBuilder_ORM_Doctrine( $this->_argv );
		$fix->fixtures();
	}
	
	private function interactiveCli()
	{
		$iCli = new OrionBuilder_Interactive_Cli();
		$iCli->init();
	}
	
	
 }