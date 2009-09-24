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
 * OrionBuilder_DoctrineCli
 * Command Line Interface for communication with the database
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionBuilder_DoctrineCli 
	extends OrionCli
		implements OrionICli
 {
 
 protected $argc = 1;
 protected $argv = array();
 protected $builder;
 protected $configs = array();
 
	public function __construct( $argc, $argv )
	{
		$this->argc = $argc;
		$this->argv = $argv;
		
		$this->builder = new OrionBuilder_ORM_Doctrine();
				
		$this->setConfigs();
		$this->getOption();
	}
	
	private function setConfigs()
	{
		$reader = new OrionBuilder_YAML();
		$reader->readYaml('scripts/scripts.yml');
		$this->configs = $reader->toArray();
		
		for($i=0;$i<count($this->configs);$i++)
			if($this->configs['project_'.$i]['name'] == $this->argv[1])
				$this->configs = $this->configs['project_'.$i];
		
		$this->builder->prepareDoctrine($this->configs);
		
		return $this->configs;
	}
	
	public function getOption()
	{
		if(!empty($this->argv[1]) && !empty($this->argv[2]))
		{
			if( $this->argc < 3 )
			{
				$this->help();
			}
			
			if	(	$this->argv[2] == '--list-databases' 	|| 
					$this->argv[2] == '--list-db'			||
					$this->argv[2] == 'list-db'				||
					$this->argv[2] == '-lb'
			)
				$this->list_databases();
			elseif	( 	$this->argv[2] == '--create-table'	||
						$this->argv[2] == 'create-table'
					)
				$this->createTable();
			
			
		}
		
		
	}
	
	public function help()
	{
		printf("@see %s --help\n", $this->argv[0]);
		exit(1);
	}
	
	private function list_databases()
	{
		
		print_r($this->builder->listDatabases());
		
	}
	
	private function createTable()
	{
		$this->builder->createTable();
	}
 }