<?php
/**
 * @author Tiago Natel de Moura
 * 
 * Biblioteca para integração com outras linguagens de programação
 * interpretadas, que necessitem de informações geradas noutra linguagem, no
 * caso PHP, mas escalável.
 */

class DynamicLang {
	
	/**
	 * Path do DynamicLang
	 *
	 * @var string
	 */
	public static $_path;
	
	
	public function __construct( ) {
		throw new Exception('DynamicLang é uma classe estática. Nenhuma instancia pode ser acessada');
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
	 * des-serializa a string num array
	 *
	 * @param string $str
	 * @return array
	 */
	public static function des_serialize( $str ) {
		return explode(DynamicLang_Manager::$_separator,$str);
	}
	
	public static function hash( $var ) {
		if ( is_array($var) ) {
			return md5(DynamicLang::serialize($var));
		} else {
			return md5($var);
		}
	}
}
