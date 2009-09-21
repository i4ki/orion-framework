<?php
/**
 * Algorithms.php
 */

class Algorithms 
{
	private function __construct()
	{
		/** Static class */
	}

	public static function getInstance()
	{
		static $instance;
		if( !$instance )
			$instance = new self();
		return $instance;
	}
	
	public static function getNextNrContract()
	{
		/**
		 * Algoritmo básico para a geração de numero de matricula.
		 * Formato: MMYYYYXXXXX
		 * 10 caracteres
		 * MM 	= mês atual
		 * YYYY = ano atual
		 * XXXX = número gerado pelo sistema, N++
		 */
		$q	= 	Doctrine_Query::create()
				->select('u.id')
				->from('CourseStudent u')
				->where('u.id > 0')
				->orderby('u.id DESC')
				->limit(1);
		$id = $q->execute(array(), Doctrine::HYDRATE_ARRAY);
		if(count($id) > 0)
		{
			$id = $id[0];
			$id = $id['id'];
			$id++;
		} else
			$id = 1;
		if($id<10)
			$id = '0000'.$id;
		elseif($id >=10 && $id < 100)
			$id = '000'.$id;
		elseif($id >=100 && $id < 1000)
			$id = '00'.$id;
		elseif($id >= 1000 && $id < 10000)
			$id = '0'.$id;
		elseif($id >= 10000 && $id < 100000)
			$id=$id;
		else
		{
			printf("Estouro de buffer. Número máximo de cadastros atingido. ^ ^<br>");
			printf("Contate o webmaster<br>");
			exit(1);
		}
		
		$nr_contract = date('mY') . $id;
		
		
		return $nr_contract;
	}
}