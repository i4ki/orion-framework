<?php
/**
 * @author Tiago Natel de Moura
 * @version 0.1
 *
 */

/**
 * Classe que Identifica o usuário.
 * Ela pega o máximo de informações possíveis do usuário, se este tiver más 
 * intenções ¬¬
 * Como:
 * :: IP - Endereço IP
 * :: User-Agent - Informações do Browser e do sistema Operacional
 * :: Requisição - Análise da requisição do browser do usuário
 * :: Site anterior - Guarda a informação do site anterior do usuário
 * :: -------------------------------------------------------------
 *
 */

class OrionSecurity_Ident {
 	protected $user;
 	protected $ip;
 	protected $user_agent;
 	protected $recv;
 	protected $country;
 	protected $operadora;
 	protected $varMal;
 	protected $count = 1;
 	protected $info;
 	protected $nivel = 0;

 	public function __construct( $var = null ) 
	{
		if (!isset($_SESSION)) {
			session_start();
		}
 		/*
 		 * Resgata o ip do usuário
 		 */
 		 $this->ip = getenv("REMOTE_ADDR");
 		 $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
 		 $this->info = $this->checkBrowser(true);
 		 
 		 $this->varMal = $var;		
 	}
 	
 	public function setCount( $count ) 
	{
 		$this->count = $count;
 	}

 	public function getIP() 
	{
 		return $this->ip;
 	}

 	public function getUserAgent() 
	{
 		return $this->user_agent;
 	}
 	
 	public function getRequest_Method() 
	{
 		return getenv('REQUEST_METHOD');
 	}
 	
 	public function getRemotePort() 
	{
 		return $_SERVER['REMOTE_PORT'];
 	}
 	
 	public function getHTTP_REFERER() 
	{
 		return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "Acsso direto ao site";
 	}
 	
 	public function getVarMaliciosa() 
	{
 		return $this->varMal;
 	}
 	
 	public function checkBrowser($input = true) 
	{
		$browsers = "mozilla msie gecko firefox ";
		$browsers.= "konqueror safari netscape navigator ";
		$browsers.= "opera mosaic lynx amaya omniweb";
	
		$browsers = split(" ", $browsers);
	
		$userAgent = strToLower( $this->user_agent );  // Converte a string para minusculas
	
		$l = strlen($userAgent);   // Retorna o tamanha da string
		
		for ($i=0; $i<count($browsers); $i++){
	  		$browser = $browsers[$i];
	  		$n = stristr($userAgent, $browser);
		  	if(strlen($n)>0){
		   	 	$version = "";
		    	$navigator = $browser;
		    	$j=strpos($userAgent, $navigator)+$n+strlen($navigator)+1;
		    		for (; $j<=$l; $j++){
			      		$s = substr ($userAgent, $j, 1);
			      		if(is_numeric($version.$s) )
			      		$version .= $s;
			      		else
			      			break;
			    	}
		  	}
		}

	    if (strpos($userAgent, 'linux')) {
	        $platform = 'linux';
	    }
	    else if (strpos($userAgent, 'macintosh') || strpos($userAgent, 'mac platform x')) {
	        $platform = 'mac';
	    }
		else if (strpos($userAgent, 'windows') || strpos($userAgent, 'win32')) {
	        $platform = 'windows';
	    }
	
		if ($input==true) {
	        return array(
	        "browser"      => $navigator,
	        "version"      => $version,
	        "platform"     => $platform,
	        "userAgent"    => $userAgent);
		}else {
	        return "$navigator $version";
		}

	}
 	
 	/**
 	 * Salva os dados do atacante e do ataque em um log
 	 *
 	 */
 	public function saveAtack() 
	{
 		/**
 		 * Cria o nome do arquivo.
 		 * na forma: 30-02-2009--192.168.1.200--2.log
 		 *         : data--ip--nr_ataques.log
 		 */
 		$file = date('d-m-Y') . '--' . $this->ip . '--' . $this->count . '.log';
 		$str = '';
 		if( is_writable( DIR_LOGS ) === true ) {
 			$str .= "###########################################################\r\n";
 			$str .= "#                 POSSIVEL TENTATIVA DE ATAQUE            #\r\n";
 			$str .= "#                                                         #\r\n";
 			$str .= "#  IP: " . $this->ip;
 			$str .= "#  Data: " . date('d-m-Y') . "\r\n";
 			$str .= "#  Hora: " . date('H:i:s') . "\r\n";
 			$str .= "#                  ::Informações técnicas::               #\r\n";
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "# URL: " . $_SERVER['REQUEST_URI'] . "\r\n";
 			
 			$str .= "  Variavel: "; 
 			$str .= var_export($this->varMal, true) . "\r\n";
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "#  REQUEST_METHOD: " . $this->getRequest_Method() . "\r\n";
 			$str .= "#  \$_POST = \r\n";
 					foreach ($_POST as $chave => $valor) {
 						$str .= "#  ".$chave." = ".$valor."\r\n";
 					}
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "#  \$_GET = \r\n";
 					foreach ( $_GET as $chave => $valor ) {
 						$str .= "#  ".$chave." = ".$valor."\r\n";
 					}
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "#  \$_SESSION = \r\n";
 					foreach ( $_SESSION as $chave => $valor ) {
 						$str .= "#  ".$chave." = ".$valor."\r\n";
 					}
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "#  REMOTE_PORT: " . $this->getRemotePort() . "\r\n";
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "#  HTTP_REFERER: " . $this->getHTTP_REFERER() . "\r\n";
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "#  Navegador: ".$this->info['browser'] . " " . $this->info['version'] . "\r\n";
 			$str .= "#  Sistema Operacional: ".$this->info['platform'] . "\r\n";
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= " User-Agent: " . $this->info['userAgent'] . "\r\n";
 			$str .= "#---------------------------------------------------------#\r\n";
 			$str .= "# Ameaça ? -> " . $this->estimarAtack() . ($this->nivel == 0 ? ' Sem muito perigo...' : ' Deve-se analisar os logs...') . "\r\n"; 
 			$str .= "######################  FIM DESTA AÇÂO ####################\r\n";
 		} 
 		
 		$fp = fopen(DIR_LOGS . $file, 'a+');
 		fwrite($fp,$str);
 	}
 	
	/**
	 * TODO : ESBOÇO
	 * FIXME += 1;
	 */
 	public function estimarAtack() 
	{
 		$this->nivel = 0;
 		if( $this->info['platform'] == 'linux' ) {
 			$this->nivel++;
 			if($this->info['browser'] == 'lynx') {
 				$this->nivel++;
 			}
 		}
 		
 		switch ($this->nivel) {
 			case 0:
 				return "ScRiPt KiIdDiE";
 				break;
 			case 1:
 				return "Possível cracker... Nível de ameaça == " .$this->nivel;
 			case 2:
 				return "Possivel cracker... Nível de ameaça == " .$this->nivel;
 			default:
 				break;
 		}
 	}
}