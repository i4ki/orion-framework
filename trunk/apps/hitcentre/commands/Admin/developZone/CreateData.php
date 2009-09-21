<?php
if (!defined("DIR_ROOT")) {
	define("DIR_ROOT","../../../");
}
require_once("../../../Libs/Config.php");

/**
 * @author Tiago Natel de Moura
 * Classe que gera os dados para testes para automatizar as refatorações \
 * ou alteraçoes das tabelas do banco de dados.
 * necessita ENV_DEVELOPENT
 */

class CreateData {
	protected $domain;
	protected $data;
	protected $path;
	protected $sock;
	protected $method;
	
	public function __construct( $path, $method, $data ) {
		$this->domain 	= Config::DOMAIN;
		$this->path 	= $path;
		$this->data 	= $data;
		$this->method 	= $method;
		$this->getCookie();
	}
	
	public function createData( $cookies = array()) {
		$str2 = "";
		if  (is_array($this->data)) {
			foreach ($this->data as $key => $value) {
				$str2 .= $key."=".$value."&";
			}
		} else {
			$str2 = $this->data;	
		}
		
		
		$this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or dir(socket_last_error());
		
		socket_connect($this->sock,$this->domain,80) or die(socket_last_error());
				
		$str =  $this->method . " ".str_replace('http://'.Config::DOMAIN,'',Config::URL).$this->path." HTTP 1.1\n";
		$str .= "Host: ".Config::DOMAIN.":80\n";
		$str .= "user-agent: mozilla\n";
		$str .= "Content-type: application/x-www-form-urlencoded\n"; 
		$str .= "Content-length: ".strlen($str2)."\n";
		$str .= "Accept: text/xml,text/html;q=0.9,text/plain;";
		$str .= "q=0.8,image/png,*/*;q=0.5\n";
		$str .= "Accept-Language: en-us,en;q=0.5\n";
		$str .= "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\n";
		$str .= "Keep-Alive: 300\n";
		if (count($cookies) > 0) {
			$str .= "Cookie: ";
			
				$str .= str_replace('path=/','',$cookies[2]);
						
		}
		$str .= "\n";
		$str .= "Connection: keep-alive\n";
		$str .= "\n";
		$str .= 'csrf='.
			substr(md5(date('Y-m-d H:i:s') . Config::SECRET_KEY),0,9).
			substr(md5('anonymous'.Config::SECRET_KEY),0,9).
			md5('mozilla'.Config::SECRET_KEY);
		$str .= "&amp;".$str2;
		
		$str .= "\n";
		
		print "<pre>";
		print $str;
		
		
				
		socket_send($this->sock,$str,strlen($str),0) or die(socket_last_error());
		
		
		
		$recv = '';
		print "<pre>";
		print htmlentities(socket_read($this->sock,10000));
		
	}
	
	public function getCookie() {
		print "#####################################################<br>";
		print "Conectando com /admin/login e pegando os cookies de seção.<br>";
		$str = "";
		$str1 =  "GET ".str_replace('http://'.Config::DOMAIN,'',Config::URL)."Admin/Login HTTP 1.0\n";
		$str1 .= "Host: ".Config::DOMAIN.":80\n";
		$str1 .= "user-agent: mozilla\n";
		$str1 .= "Content-type: application/x-www-form-urlencoded\n";
		$str  .= $str1 . "\n";
		print "<pre>";
		print $str;
		print "<br>";
		print "#####################################################<br>";		
		
		$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or dir(socket_last_error());
		socket_connect($sock, Config::DOMAIN, 80) or die(socket_last_error());
			
		
		socket_send($sock,$str,strlen($str),0) or die(socket_last_error());

		$recv = socket_read($sock,10000);
		
		print "<br>";
		print "resposta do servidor<br>";
		print $recv;
		print "#####################################################<br>";
		
		
		preg_match_all("/Set-Cookie: (.*)/",$recv,$cookies);
		$cookies = $cookies[1];
		
		$this->createData($cookies);
			
	}
}

$config = new Config();

if (Config::getEnvironment() == Config::ENV_DEVELOPMENT) {
	$d = array();
	$path 	= isset($_GET['path'])		? $_GET['path']		: '/';
	$method = isset($_GET['method']) 	? $_GET['method'] 	: "POST";
	$data 	= isset($_GET['data'])		? $_GET['data']		: "";
	$data = explode('*',$data);
	for ($i=0;$i<count($data);$i++) {
		$data[$i] = explode('-',$data[$i]);
		$d[$data[$i][0]] = $data[$i][1];
	}
	$data = $d;
	$con = new CreateData( $path, $method, $data );
	//$con->createData();
} else {
	print "<h2>Sem permiss&otilde;es para acessar esse arquivo.</h2>";
}