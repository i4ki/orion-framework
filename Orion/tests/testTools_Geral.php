<?php
/*
 * Created on 31/05/2009
 *
 * @author Tiago Natel de Moura
 */
 require_once("Command.php");

 /**
  * A classe Tools_Geral é estática então não deverá ser instanciada
  */
 class testTools_Geral extends PHPUnit_Framework_TestCase {
 	protected $tools;
 	protected $arr;

	public function testIfPHPUnitWorksTrueTrue() {
		$this->assertTrue(true);
	}
	public function testIfPHPUnitWirksFalseFalse() {
		$this->assertFalse(false);
	}
 	public function setUp() {
 		$this->tools = new Tools_Geral();
 		$this->arr = array(2,4,6,8,10);
 	}

 	public function testIfMethodArray_map_rExists() {
 		$this->assertTrue(method_exists($this->tools,'array_map_r'));
 	}
 	public function testIfReturnOfMethodArray_map_rIsArray() {
 		$this->assertType('array',$this->tools->array_map_r('dobra',$this->arr));
 	}
 	public function testIfReturnIsEspectedOfMethodArray_Map_R() {
 		$this->assertEquals(array(4,8,12,16,20),$this->tools->array_map_r('dobra',$this->arr));
 	}

 }

 function dobra($valor) {
 	return $valor*2;
 }


?>
