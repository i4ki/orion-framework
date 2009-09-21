<?php
/**
 * Controle de cadeia de parentesis
 * Os parenthesis são tratados num sistema de
 * pais e filhos semelhante à XML.
 * Isso:
 * <par>
 * 		<par> $var1 == 2 </par>
 * 		<par> $var2 !== FALSE </par>
 * </par>
 * Equivale à isso:
 * ( ( $var1 == 2 ) || ( $var2 !== FALSE ) )
 * Esqueça o operador lógico ^ ^
 *
 * Os nodes são arrays da forma:
 * $node = array(
 * 			'0' => array(
 *					'var1'		=> 'variavel1',
 *					'var2'		=> 'variavel2',
 *					'level'		=> 'nivel em que o parentesis se encontra, quanto mais aninhado maior o level'
 *				);
 *
 */
 
class DynamicJS_Par
{
	public $node = array();
	public $level = 0;
	
	public function __construct()
	{
		
	}
	
	public function upLevel()
	{
		$this->level++;
		return $this;
	}
	
	public function downLevel()
	{
		$this->level--;
		return $this;
	}
	
	public function createParent()
	{
		$this->node = array();
		return $this;
	}
	
	public function createParRelational( $var1, $var2, $op )
	{
		$this->node[]['var1']	= $var1;
		$this->node[count($this->node)-1]['var2']	= $var2;
		$this->node[count($this->node)-1]['op']		= $op;
		$this->node[count($this->node)-1]['level']	= $this->level;
		$this->node[count($this->node)-1]['n']		= count($this->node)-1;
		return $this;
	}
	
	public function showNode()
	{
		Tools_Debug::debugArray($this->node);
	}
	
	public function getGreaterLevel()
	{
		$gt = 0;
		foreach( $this->node as $node )
		{
			if ( $node['level'] > $gt )
				$gt = $node['level'];
		}
		return $gt;
	}
	
	public function getNode( $i = false )
	{
		if ($i !== FALSE)
			return $this->node[$i];
		else
			return $this->node;
	}
	
	public function getArrayOfNodesInLevel( $level )
	{
		$node = array();
		foreach( $this->node as $n )
		{
			if( $n['level'] == $level )
				$node[] = $n;
		}
		
		return $node;
	}
	
	public function setResultExpInNode( $n, $res )
	{
		$this->node[$n]['result']	= $res;
		return $this;
	}
}