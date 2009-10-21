<?php
/*
 * Created on 19/05/2009
 *
 * @author Tiago Natel de Moura
 * email: tiago_moura@live.com
 *
 */

 /**
  * Classe estática de ferramentas utilizadas no framework
  *
  * Obs.: Esta classe não deve ser instanciada nem estendida
  */

  final class OrionTools_Geral {

  	public function __construct() {
  		/**
    	 * Nunca coloque um construtor nesta classe
    	 * Pois ela nunca será instaciada
    	 * Ela é uma classe constante, com
    	 * Métodos constantes.
    	 */
  	}


  	/**
	 * Redireciona
	 *
	 * @param string $url
	 * @param string $method
	 * @param integer $time
	 */
	public static function redirect( $url = null, $method = 'javascript', $location = true, $time = 0 ) {
		if ($location == true && !headers_sent()) {
			header("Location: ".$url);
			
		}
		switch ( $method ) 
		{
			case 'javascript':
				print "<script type=\"text/javascript\">\n";
				if($url === null) {
					print "history.go(".$time.");\n";
				} else {				
					print "location.href=\"" . $url . "\";\n";
				}
				print "</script>\n";
				break;
			case 'html':
				print "<meta http-equiv=\"refresh\" content=\"" . $time . "; url=" . $url . "\" />\n";
				break;
		}
	}
	
	public static function alert( $msg ) {
		print "<script type=\"text/javascript\">\n";
		print "alert('" . $msg . "');\n";
		print "</script>\n";
	}
	
	public static function back() {
		print "<script type=\"text/javascript\">\n";
		print "history.back(-1);\n";
		print "</script>\n";
		exit();
	}
	
	public static function call( $callback, $params = '' ) {
		print "<script type=\"text/javascript\">\n";
		print $callback . "(".$params.");\n";
		print "</script>\n";
	}

	public static function setHeader($type = null, $charset = null) {
		if(!headers_sent())
			header( 
				($type == null) ? 
				"Content-Type: text/html; charset=" . 
					(
						$charset == null ? 
						Orion::getAttribute(Orion::ATTR_CHARSET_HTML) : 
						$charset
					) : 
				"Content-Type: ".$type."; charset=".($charset == null ? Orion::getAttribute(Orion::ATTR_CHARSET_HTML) : $charset), true
			);
	}

  }