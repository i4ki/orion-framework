<?php

class ServiceTable extends Doctrine_Table {
	public function getServices( $sql = false ) {
		$q = 	Doctrine_Query::create()
				->select('s.*')
				->from('Service s');
		if( $sql == true ) {
			return $q->getSql();
		} else {
			return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		}
	}
}