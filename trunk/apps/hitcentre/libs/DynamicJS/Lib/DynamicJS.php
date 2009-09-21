<?php
/**
 * @author Tiago Natel de Moura
 * 
 * Biblioteca para manipulação de JS dinâmico em arquivos externos.
 * Para manipulação direta de javascript incluso no arquivo,
 * utilize uma das variadas bibliotecas para isso, PAjax, XAjax, etc.
 */

class DynamicJS {
	/**
	 * Constantes do PARSER
	 */
	const EXP_IF		= 1;
	const EXP_ELSE		= 2;
	const EXP_ELSEIF	= 3;
	const EXP_FOR		= 4;
	const EXP_WHILE		= 5;
	const EXP_DO		= 6;
	const EXP_DO_WHILE	= 7;
	const EXP_SWITCH	= 8;
	
	/**
	 * delimitadores
	 */
	const TAG_INIT		= 10;
	const TAG_END		= 11;
	const DELIM			= 12;
	
	/**
	 * inside
	 */
	const INS_IF		= 100;
	const INS_PAR		= 101;
	const INS_ELSE		= 102;
	const INS_ELSEIF	= 103;
	const INS_FOR		= 104;
	const INS_FOR_INI	= 105;
	const INS_FOR_COND	= 106;
	const INS_FOR_INC	= 107;
	const INS_WHILE		= 108;
	const INS_FOREACH	= 109;
	const INS_VAR		= 110;
	 
	 /**
	  * Operadores lógicos
	  */
	const OP_LOG_AND		= 120;
	const OP_LOG_AND_ALPHA	= 121;
	const OP_LOG_OR		= 122;
	const OP_LOG_OR_ALPHA	= 123;
	 
	 /**
	  * Operadores Condicionais
	  */
	const OP_COND_EQ		= 124;
	const OP_COND_NEQ		= 125;
	const OP_COND_LT		= 126;
	const OP_COND_GT		= 127;
	const OP_COND_LTEQ		= 128;
	const OP_COND_GTEQ		= 129;
	
	/**
	 * Operadores aritméticos
	 */
	const OP_ARITH_EQ		= 200;
	const OP_ARITH_NEQ		= 201;
	const OP_ARITH_ADD		= 202;
	const OP_ARITH_SUB		= 203;
	const OP_ARITH_DIV		= 204;
	const OP_ARITH_MOD		= 205;
	 
	/**
	 * Path do DynamicJS
	 *
	 * @var string
	 */
	public static $_path;
	
	
	public function __construct( ) {
		throw new Exception('DynamicJS é uma classe estática. Nenhuma instancia pode ser acessada');
	}
	
	public static function autoload( $classname ) {
		if (class_exists($classname,false) || interface_exists($classname, false)) {
			return false;
		}
		
		$class = self::getPath() . DIRECTORY_SEPARATOR . str_replace('_',DIRECTORY_SEPARATOR,$classname) . '.php';
		
		if (file_exists($class)) {
			require_once($class);
		}
		
		return true;			
	}
	
	/**
	 * Get the path of directory
	 *
	 * @return string
	 */
	public static function getPath() {
		
		if (empty( self::$_path )) {
			self::$_path = dirname(__FILE__);
		}
		
		return self::$_path;
	}	
	
	/**
	 * Serializa o array
	 *
	 * @param array $arr
	 * @return string
	 */
	public static function serialize( $arr ) {
		return implode('-',$arr);
	}
	
	/**
	 * desserializa a string num array
	 *
	 * @param string $str
	 * @return array
	 */
	public static function des_serialize( $str ) {
		return explode(DynamicJS_Manager::$_separator,$str);
	}
	
	public static function hash( $var ) {
		if ( is_array($var) ) {
			return md5(DynamicJS::serialize($var));
		} else {
			return md5($var);
		}
	}
}
