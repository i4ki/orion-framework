<?php

class RoleResource extends Doctrine_Record {
	public function setTableDefinition() {
		$this->option('charset', 'utf8');
		$this->option('collate', 'utf8_general_ci');
		
		$this->hasColumn('role_id', 'integer', null, array(
						'primary' => true
						)
		);
		
		$this->hasColumn('resource_id', 'integer', null, array(
						'primary' => true
						)
		);
		
		/**
		 * Os campos abaixo, na prática, são campos
		 * do tipo BOOLEAN, mas que estão como integers de 
		 * tamanho 1 para compatibilidade.
		 * Deverá aceitar somente 0 ou 1.
		 */
		$this->hasColumn('op_create', 'integer', 1);
		
		$this->hasColumn('op_update', 'integer', 1);
		
		$this->hasColumn('op_delete', 'integer', 1);
		
		$this->hasColumn('op_see', 'integer', 1);
	}
	
	
}