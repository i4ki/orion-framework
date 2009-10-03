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
 * OrionORM_Doctrine  - Classe de configuração do ORM Doctrine
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */
class OrionORM_Doctrine {
	/**
	 * Instancia da classe Doctrine_Manager: manipula todas as conexões ao banco
	 */
	public $manager;
	
	/**
	 * Connect
	 */
	protected $conn;
	
	/**
	 * Construtor
	 */
	public function __construct() 
	{
		$this->setConfiguration();
	}
	
	/**
	 * Método que ajustará as configurações iniciais do ORM
	 * @param null
	 */
	protected function setConfiguration() {
		
		$this->manager = Doctrine_Manager::getInstance();
		
		/**
		 * ATTR_AUTO_ACCESSOR_OVERRIDE == true para poder modificar o funcionamento
		 * dos models, com o uso de _set(), por exemplo.
		 */
		$this->manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
		$this->manager->setAttribute(	Doctrine::ATTR_MODEL_LOADING,
										Doctrine::MODEL_LOADING_CONSERVATIVE
									);
		
		/**
		 * ATTR_AUTOLOAD_TABLE_CLASSES == true para carregar métodos de usuário da
		 * classe Doctrine_Table::
		 */
		$this->manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);
		$impl = $this->getImpl();
		foreach($impl as $template => $model)
			$this->manager->setImpl($template, $model);
		
		$this->connectByDoctrine( true );
	}
	
	/**
	 * Conecta ao Banco de Dados
	 * @param null
	 */
	protected function connectByDoctrine( $opt = true ) {
		/** ex.: $dsn = mysql://root:123456@mysql.google.com/mainDB */
		$env = Orion::getAttribute(Orion::ATTR_ENV);
		
		if( $env == Orion::ATTR_ENV_DEV )
			$dsn = 	Orion::getAttribute(Orion::ATTR_ADAPTER_DEV).	'://'. 
					Orion::getAttribute(Orion::ATTR_USER_DB_DEV).	':'	. 
					Orion::getAttribute(Orion::ATTR_PASS_DB_DEV).	'@' . 
					Orion::getAttribute(Orion::ATTR_HOST_DB_DEV).	'/' . 
					Orion::getAttribute(Orion::ATTR_DATABASE_DEV);
		elseif( $env == Orion::ATTR_ENV_TEST )
			$dsn = 	Orion::getAttribute(Orion::ATTR_ADAPTER_TEST).	'://'. 
					Orion::getAttribute(Orion::ATTR_USER_DB_TEST).	':'	. 
					Orion::getAttribute(Orion::ATTR_PASS_DB_TEST).	'@' . 
					Orion::getAttribute(Orion::ATTR_HOST_DB_TEST).	'/' . 
					Orion::getAttribute(Orion::ATTR_DATABASE_TEST);
		elseif( $env == Orion::ATTR_ENV_PROD )
			$dsn = 	Orion::getAttribute(Orion::ATTR_ADAPTER_PROD).	'://'. 
					Orion::getAttribute(Orion::ATTR_USER_DB_PROD).	':'	. 
					Orion::getAttribute(Orion::ATTR_PASS_DB_PROD).	'@' . 
					Orion::getAttribute(Orion::ATTR_HOST_DB_PROD).	'/' . 
					Orion::getAttribute(Orion::ATTR_DATABASE_PROD);
		else
			throw new Exception("Configure corretamente o ambiente da aplicação. Error");
		
		try {
		
			$this->conn = Doctrine_Manager::connection($dsn, 'MainConn');
			
			if( $env == Orion::ATTR_ENV_PROD )
			{
				$this->conn->setCharset( Orion::getAttribute(Orion::ATTR_CHARSET_DB_PROD) );
				$this->conn->setCollate( Orion::getAttribute(Orion::ATTR_COLLATE_DB_PROD) );
			}
			elseif( $env == Orion::ATTR_ENV_DEV )
			{
				
				$this->conn->setCharset( Orion::getAttribute(Orion::ATTR_CHARSET_DB_DEV) );
				$this->conn->setCollate( Orion::getAttribute(Orion::ATTR_COLLATE_DB_DEV) );
			} elseif( $env == Orion::ATTR_ENV_TEST )
			{
				$this->conn->setCharset( Orion::getAttribute(Orion::ATTR_CHARSET_DB_TEST) );
				$this->conn->setCollate( Orion::getAttribute(Orion::ATTR_COLLATE_DB_TEST) );
			}
			
			$this->manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
			
		} catch (Exception $e) {
			print 'Codigo: ' . $e->getCode() . '<br />';
			print 'Message: ' . $e->getMessage() . '<br />';
		}
		
		if( $opt == true ) {
			Doctrine::loadModels( 	OrionKernel::$organizer->getPathModels(), Doctrine::MODEL_LOADING_CONSERVATIVE);
		}
	}
	
	protected function getImpl( $implFile = false )
	{
		if( $implFile == false )
			$implFile = 	Orion::getPathProject() . 
							Orion::getAttribute(Orion::ATTR_DIR_DATABASE) . DIRECTORY_SEPARATOR .
							'impl.yml';
		
		require_once(Orion::getPathVendor() . DIRECTORY_SEPARATOR . 'Spyc' . DIRECTORY_SEPARATOR . 'spyc.php');
		$impl = Spyc::YAMLLoad($implFile);
		
		return $impl;
	}
}