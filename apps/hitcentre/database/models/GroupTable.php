<?php

class GroupTable extends Doctrine_Table {
	
	
	public function getGroups() {
		$q = Doctrine_Query::create()
			->select('g.*')
			->from('Group g');
		return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
	}
	
	public function getGroupById( $id, $sql = false ) {
		$q = 	Doctrine_Query::create()
				->select('g.*')
				->from('Group g')
				->where('g.id = ?', array($id));
		if( $sql == true ) {
			return $q->getSql();
		} else {
			return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		}
	}
}