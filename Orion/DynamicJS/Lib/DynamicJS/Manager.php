<?php

/**
 * @author Tiago Natel de Moura
 * 
 * Classe principal de manipulação de JS
 */

class DynamicJS_Manager {
	/**
	 * Filename of the JS
	 *
	 * @var string
	 */
	public $filename;
	public $filename_compiled;
	
	/**
	 * Handle of JS file
	 *
	 * @var resource
	 */
	protected $js;
	
	/**
	 * Handle of JS file compiled
	 * 
	 * @var resource
	 */
	protected $js_c;
	
	/**
	 * Define a área de trabalho
	 * O repositório de arquivos JS
	 *
	 * @var string
	 */
	public static $_desktop;
	
	public static $_compiledJS = 'DynamicJS/CompiledJS';
	public static $_URL_compiledJS = 'Libs/DynamicJS/CompiledJS';
	
	/**
	 * Array das variaveis à ser substituidas no JS
	 *
	 * @var array
	 */
	protected $variables = array();
	
	public static $_separator = '-';	
	
	public function __construct() {
		
	}
	
	public function setJS( $filename ) {
		
		$this->filename = $filename;
		$this->js = $this->openJS($this->filename);
		return $this->js;
	}
	
	/**
	 * Cria um novo arquivo Javascript
	 *
	 * @param string $filename
	 * @param BOOLEAN $workgroup
	 * @return resource_handler
	 */
	public function createJS( $filename, $desktop = true ) {
		if ($desktop == true) {
			$filename = $this->getDesktop() . DIRECTORY_SEPARATOR . $filename;
		}
		
		$js	= fopen($filename,'a+');
		if (!$js) {
			print "\n<br>Não foi possivel criar o arquivo, verifique as permissões do diretório " . dirname($filename . "<br>");
			exit();
		}
		
		return $js;	
	}
	
	/**
	 * Abre um arquivo javascript
	 *
	 * @param string $filename
	 * @return resource_handler
	 */
	public function openJS( $filename = false, $desktop = true, $modo = 'r' ) {
		/**
		 * Se ajustar um nome para o arquivo, altera a variavel interna
		 * filename, do contrário, fica na mesma
		 */ 
						
		if (isset($filename) && $desktop == true) {
			$filename = $this->getDesktop() .  $filename;
		} elseif (!isset($filename) && $desktop == true) {
			$filename = $this->getDesktop() . $this->filename;
		}
		
		$js	= fopen($filename, $modo);
		
		if (!$js) {
			print "\n<br>Não foi possivel abrir o arquivo, verifique se o arquivo existe e as permissõs do diretório";
			exit();
		}
		
		return $js;
		
	}
	
	/**
	 * Get the filename JS
	 *
	 * @return string
	 */
	public function getFilename() {
		return $this->filename;
	}
	
	/**
	 * Ajusta o path da área de trabalho
	 *
	 * @param string $path
	 */
	public function setDesktop( $path = false ) {
		
		if ($path == false) {
			$path = DynamicJS::getPath();
		}
		self::$_desktop = $path;
	}
	
	/**
	 * Retorna o path da área de trabalho
	 *
	 * @return string
	 */
	public function getDesktop() {
		return self::$_desktop;
	}
	
	/**
	 * Ajusta o path dos arquivos compilados
	 *
	 * @param string $path
	 */
	public function setCompiledJS( $path = false ) {
		if ($path == false) {
			self::$_compiledJS = 	file_exists(self::$_compiledJS) 
									? self::$_compiledJS
									: DynamicJS::getPath() . DIRECTORY_SEPARATOR . self::$_compiledJS; 
		} else {
			self::$_compiledJS = 	file_exists($path) ? $path : self::$_compiledJS;
		}
		return true;
	}
	
	public function setURLCompiledJS( $path = false ) {
		if ($path == false) {
			self::$_URL_compiledJS = 	file_exists(self::$_URL_compiledJS)
										? self::$_URL_compiledJS
										: DynamicJS::getPath() . DIRECTORY_SEPARATOR . self::$_URL_compiledJS;	
		} else {
			self::$_URL_compiledJS = $path;
		}
		return true;
	}
	
	public function getFilenameCompiled() {
		return DynamicJS_Manager::$_compiledJS . DIRECTORY_SEPARATOR . $this->filename_compiled;
	}
	
	public function getURLFilenameCompiled() {
		return DynamicJS_Manager::$_URL_compiledJS . DIRECTORY_SEPARATOR . $this->filename_compiled;
	}

	/**
	 * Adiciona uma variável às variaveis do JS
	 *
	 * @param string $variable
	 * @param mixer $value
	 * @return BOOL
	 */
	public function assign( $variable, $value ) {
		$this->variables[$variable] = $value;
		return true;
	}
	
	/**
	 * Adiciona um array ás variáveis do JS
	 *
	 * @param array $variables
	 * @return BOOL
	 */
	public function assignArray( $variables ) {
		foreach ($variables as $key => $value) {
			$this->variables[$key] = $value;
		}
		
		return true;
	}
	
	public function printJSInBrowser( $str = false ) {
		if ($str == false) {
			
			while (!feof($this->js)) {
				$str = fread($this->js,1024);
				$str = nl2br($str);
				print $str;
			}
		} else {
			print nl2br($str);
		}
	}
	
	public function processJS() {
		
		$this->filename_compiled = str_replace(
									'/',
									'_',
									preg_replace(
											"/\..*?$/",
											'',
											$this->filename
											)) . 
									'-' . 
									DynamicJS::hash($this->variables) .
									'.js';
							
		$this->js_c = $this->openJS(	DynamicJS_Manager::$_compiledJS . 
										DIRECTORY_SEPARATOR . 
										$this->filename_compiled, 
										false,
										'w'
									);
		$str = $this->replaceAll();
		
		fwrite($this->js_c,$str);
		
	}
	
	public function replaceAll() {		
		$js = $this->getJSInString( $this->js );
		
		/**
		 * Substitui as variáveis
		 */
		foreach ($this->variables as $key => $value) {
			$js = str_replace('<?js:$'.$key.'?>',$value,$js);	
		}
		
		$js = preg_replace('/\<\?js\:\$.*?\?\>/','',$js);

		return $js;
	}
	
	protected function getJSInString( $fp ) {
		fseek($fp,0);
		$str = '';
		while (!feof($fp)) {
			$str .= fgets($fp,1024);
		}
		
		return $str;
	}
	
	/**
	 * Retorna o separador dos arquivos compilados
	 *
	 * @return string
	 */
	public static function getSeparator() {
		return self::$_separator;
	}
	
	/**
	 * Configura o separador, nas serialições dos arquivos compilados
	 *
	 * @param char $sep
	 */
	public static function setSeparator( $sep ) {
		self::$_separator = $sep;
	}
	
}