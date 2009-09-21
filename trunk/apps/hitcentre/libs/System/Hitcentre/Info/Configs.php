<?php

/**
 * @author Tiago Natel de Moura
 * 
 */

class System_Hitcentre_Info_Configs 
	extends System_Monitor 
		implements System_iInfo {
		
	private $_conf = array();
	private $portal_conf;
	private $school_conf;
	private $admin_conf;
	private $promotions_conf;
	
	public function __construct() {
		$this->configureSystemInfo();
	}
	
	public function configureSystemInfo() {
		$this->getConfigPortal();
		$this->getConfigSchool();
		$this->getConfigAdmin();
		
		$this->portal_conf 		= $this->portal_conf[0];
		$this->school_conf 		= $this->school_conf[0];
		$this->admin_conf 		= $this->admin_conf[0];

		$this->_conf['portal'] 	= $this->portal_conf;
		$this->_conf['school'] 	= $this->school_conf;
		$this->_conf['admin']	= $this->admin_conf;
		
		return $this->_conf;
	}
	
	
	public function getConfigPortal() {
		$q = 	Doctrine_Query::create()
				->select('p.*')
				->from('ConfigPortal p')
				->where('p.id = ?',array(1));
		$this->portal_conf = $q->execute(array(),Doctrine::HYDRATE_ARRAY);
		
		return count($this->portal_conf) == 1 ? true : false;	
	}
	
	public function getConfigSchool() {
		$q = 	Doctrine_Query::create()
				->select('s.*')
				->from('ConfigSchool s')
				->where('s.id = ?',array(1));
		
		$this->school_conf = $q->execute(array(),Doctrine::HYDRATE_ARRAY);	
		
		return count($this->school_conf) == 1 ? true : false;
	}
	
	public function getConfigAdmin() {
		$q = 	Doctrine_Query::create()
				->select('a.*')
				->from('Admin a');
		$this->admin_conf = $q->execute(array(),Doctrine::HYDRATE_ARRAY);
		
		return count($this->admin_conf) > 0 ? true : false;
	}
	
	public function getInfo() {
		return $this->_conf;
	}
	
	public function getInfoPortal() {
		return $this->portal_conf;
	}
	
	public function getInfoSchool() {
		return $this->school_conf;
	}
	
	public function getInfoAdmin() {
		return $this->admin_conf;
	}
	
	/**
	 * Objeto doctrine
	 *
	 * @param object $object
	 * @return array
	 */
	public function getArray( $object ) {
		$arr = $object->toArray();
		return $arr[0];
	}
}