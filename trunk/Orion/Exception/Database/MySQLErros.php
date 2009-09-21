<?php
/*
 * Created on 01/06/2009
 *
 * @author Tiago Natel de Moura
 */

 class Exception_Database_MySQLErros {
 	public $erro;
 	public $msg;
 	private $xml;
 	private $file = "MySQLErros.xml";

 	public function __construct($erro = NULL) {
 		$this->erro = $erro;
 		$this->file = dirname(__FILE__) . '/' . $this->file;
 	}

 	public function lerXML() {
 		$this->xml = file_get_contents($this->file);
 	}
	/**
	 * Método que recupera todos os erros do XML
	 * O XML tem o seguinte formato:
	 * #########################################
	 * <erro>
	 * 		<codigo>600</codigo>
	 * 		<msg>Esta é a mensagem</msg>
	 * </erro>
	 * #########################################
	 * @return array Retorna um Array do tipó 0 => (codigo => 600, msg => 'Mensagem')
	 */
 	public function getErros() {
		$erros = $this->getNode('erro');
		return $this->msg;
 	}

 	/**
	 * Método que retorna o conteudo de um Nó do XML
	 */
 	public function getNode( $node, $xml = NULL, $attr = NULL,$value = NULL, $child = NULL ) {

 		$pattern = !empty($attr) ? "/\<".$node." ".$attr."=(\'|\")".$value."(\'|\")\>(.*?)\<\/".$node."\>/s" : "/\<".$node."(.*?)\>(.*?)\<\/".$node."\>/s";
 		$xml = !empty($xml) ? $xml : $this->xml;
 		$n = preg_match_all($pattern,$xml,$nodeContent);
 		$i = count($nodeContent[2]);

		if( $attr == NULL ) {
			return $nodeContent[0];
		} elseif( !empty($attr) and empty($child)) {
			return $nodeContent[0][0];
		} elseif( !empty($attr) and !empty($child)) {
			return $nodeContent[4][0];
		}
 	}

 	public function getMsg( $code ) {
 		$erro = $this->getNode('erro',NULL, 'codigo',$code);
 		$this->msg = $this->getNode('msg',$erro);
 		return utf8_decode($this->msg[0]);
 	}

 }
?>
