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
 * Builder for Doctrine ORM
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orionframework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

 class OrionBuilder_ORM_Doctrine extends OrionBuilder_ORM
 {
	protected $manager = 0;
	protected $conn;
	
	public function __construct()
	{
	
	}
	
	public function listDatabases()
	{
		$databases = $this->conn->import->listDatabases();
		return $databases;
	}
	
	public function models()
	{
	
	}
	
	public function fixtures()
	{
		print_r($this->configs);
		if($this->configs['orm'] != 'doctrine')
		{
			printf("Orion Scripts atualmente só dá suporte ao Doctrine como ORM.");
			exit();
		}
		
		if( $this->argv[3] == 'load' || $this->argv[3] == 'loadData' )
			$this->_loadData();
		elseif( $this->argv[3] == 'dump' || $this->argv[3] == 'dumpData' )
			$this->_dumpData();
			
	}
		
	private function _loadData()
	{
		$dir = $this->configs['path'] . DIRECTORY_SEPARATOR . $this->configs['fixtures'];
		if( !empty($this->data[4]) && file_exists($dir . DIRECTORY_SEPARATOR . $this->argv[4]) )
			Doctrine::loadData( $dir . DIRECTORY_SEPARATOR . $this->argv[4], $this->argv[5] == '--yes' ? true : false);
		elseif( (empty($this->data[4]) || $this->data[4] == '--yes') && file_exists($dir) )
			Doctrine::loadData( $dir, $this->data[4] == '--yes' ? true : false );
		
		return $this;
	}
	
	private function _dumpData()
	{
		$dir = $this->configs['path'] . DIRECTORY_SEPARATOR . $this->configs['fixtures'];
		print $dir;
		if( !empty($this->data[4]) && $this->data[4] != '--yes' )
			Doctrine::dumpData( $dir . DIRECTORY_SEPARATOR . $this->data[4], $this->data[5] == '--yes' ? true : false);
		elseif( empty($this->data[4]) || $this->data[4] == '--yes' )
			Doctrine::dumpData( $dir, $this->data[4] == '--yes' ? true : false );
		
		return $this;
	}
	
	public function createTable()
	{
		$definition = array(
			'id' => array(
				'type'			=> 'integer',
				'primary'		=> true,
				'autoincrement'	=> true
			),
			'name'	=> array(
				'type'		=> 'string',
				'lenght'	=> 255
			)
		);
		
		$this->conn->export->createTable('course', $definition);
	}	
	
	public function prepareDoctrine( $configs )
	{
		require_once($configs['path_orm']);
		
		spl_autoload_register(array('Doctrine', 'autoload'));

		$this->manager = Doctrine_Manager::getInstance();

		$this->manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);

		$this->manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);

		$this->conn = Doctrine_Manager::connection(	$configs['driver'] . '://' . 
													$configs['user_db'] . ':' . 
													$configs['pass_db'] . '@' . 
													$configs['host_db'] . '/' . 
													$configs['database'],
												'MainConn'
											);

		$this->conn->setCharset($configs['charset_db']);
		$this->conn->setCollate($configs['collate_db']);
		
		$this->manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
		
		 Doctrine::loadModels($configs['path'] . DIRECTORY_SEPARATOR . $configs['models']);
		
		return true;
	}
 }