<?php

/**
 * @author Tiago Natel de Moura
 * 
 * Classe principal de integração de linguagens
 */

class DynamicLang_Manager {
	
	const DYN_ENGINE_FILE 	= 0;
	const DYN_ENGINE_STRING = 1;
	/**
	 * Filename
	 *
	 * @var string
	 */
	public $filename;
	public $filename_compiled;
	
	/**
	 * Handle of subject file
	 *
	 * @var resource
	 */
	protected $target;
	
	/**
	 * String alvo
	 *
	 * @var string
	 */
	protected $strTarget;
	
	/**
	 * Handle of file compiled
	 * 
	 * @var resource
	 */
	protected $target_c;
	
	/**
	 * Define a área de trabalho
	 *
	 * @var string
	 */
	public static $_desktop;
	
	public static $_compiled = 'DynamicLang/Compiled';
	public static $_URL_compiled = 'Libs/DynamicLang/Compiled';
	
	protected $_engine = DynamicLang_Manager::DYN_ENGINE_FILE;
	
	/**
	 * Tags de identificação
	 *
	 * @var unknown_type
	 */
	protected $_tagOpen 	= '@#>';
	protected $_tagClose	= '<#@';
	
	protected $_sign_var = '$';
	
	protected $_pattern;
	protected $_patternTagOpen;
	protected $_patternTagClose;
	
	/**
	 * Array das variaveis à ser substituidas no alvo
	 *
	 * @var array
	 */
	protected $variables = array();
	
	public static $_separator = '-';	
	
	/**
	 * Caso $str for ajustado, o alvo será essa
	 * string
	 *
	 * @param string $str
	 */
	public function __construct( $strTarget = false ) {
		if ($strTarget != false) {
			$this->strTarget = $strTarget;
		} else {
			$this->strTarget = false;
		}
		
		$this->setEngine();
		$this->createPatternForTags();
	}
	
	protected function setEngine( $engine = false ) {
		if ($engine == false ) {
			if ($this->strTarget != false) {
				$this->_engine = DynamicLang_Manager::DYN_ENGINE_STRING;
			} else {
				$this->_engine = DynamicLang_Manager::DYN_ENGINE_FILE;
			}
		}
		
	}
	
	public function setTag( $open, $close ) {
		$this->_tagOpen 	= $open;
		$this->_tagClose 	= $close;
	}
	
	protected function setSignVar( $sign ) {
		$this->_sign_var = $sign;
	}
	
	protected function createPatternForTags() {
		$charSpecials = array(
			'!','@','#','$','%','&','*','(',')','_','-',
			'+','=','§','£','|','<','>',':',';','?',
			'/','[',']','{','}','.',',','\'','\"'
		);
		$this->_patternTagOpen 	= $this->_tagOpen;
		$this->_patternTagClose = $this->_tagClose;
		
		foreach ($charSpecials as $sign) {
			$this->_patternTagOpen 	= str_replace(
											$sign,
											'\\'.$sign,
											$this->_patternTagOpen
										);
			$this->_patternTagClose = str_replace(
											$sign,
											'\\'.$sign,
											$this->_patternTagClose
										); 	
		}
		$this->_patternTagOpen 	= '/' . $this->_patternTagOpen;
		$this->_patternTagClose	= $this->_patternTagClose . '/';
		
	}
	
	public function process() {
		
		if ($this->_engine == DynamicLang_Manager::DYN_ENGINE_STRING) {
			$this->target_c = $this->strTarget;	
		} else {
			$this->target_c = '';
			$this->target_c = $this->getFileInString( $this->target );
		}
		
		foreach ($this->variables as $key => $value) {
			
			$this->target_c = str_replace(
				
				$this->_tagOpen . $this->_sign_var . $key . $this->_tagClose,
				$value,
				$this->target_c
			);
		}
			
			$this->target_c = preg_replace(
			$this->_patternTagOpen . $this->_sign_var . '.*?' . $this->_patternTagClose,
			'', 
			$this->target_c
			);
			
			return $this->target_c;
	}
	
	
	public function setTarget( $filename, $string = false ) {
		if ($string == false) {
			$this->_engine = DynamicLang_Manager::DYN_ENGINE_FILE;
			$this->filename = $filename;
			$this->target = $this->openTarget($this->filename);	
		} 
		
		return $this->target;
	}
	
	/**
	 * Cria um novo arquivo
	 *
	 * @param string $filename
	 * @param BOOLEAN $workgroup
	 * @return resource_handler
	 */
	public function createTarget( $filename, $desktop = true ) {
		if ($desktop == true) {
			$filename = $this->getDesktop() . DIRECTORY_SEPARATOR . $filename;
		}
		
		$handle	= fopen($filename,'a+');
		if (!$handle) {
			print "\n<br>Não foi possivel criar o arquivo, verifique as permissões do diretório " . dirname($filename . "<br>");
			exit();
		}
		
		return $handle;	
	}
	
	/**
	 * Abre um arquivo
	 *
	 * @param string $filename
	 * @return resource_handler
	 */
	public function openTarget( $filename = false, $modo = 'r' ) {
		/**
		 * Se ajustar um nome para o arquivo, altera a variavel interna
		 * filename, do contrário, fica na mesma
		 */ 
						
		$handle	= fopen($filename, $modo);
		
		if (!$handle) {
			print "\n<br>Não foi possivel abrir o arquivo, verifique se o arquivo existe e as permissõs do diretório";
			exit();
		}
		
		return $handle;
		
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
			$path = DynamicLang::getPath();
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
	public function setCompiledTarget( $path = false ) {
		if ($path == false) {
			self::$_compiled = 	file_exists(self::$_compiled) 
									? self::$_compiled
									: DynamicLang::getPath() . DIRECTORY_SEPARATOR . self::$_compiled; 
		} else {
			self::$_compiled = 	file_exists($path) ? $path : self::$_compiled;
		}
		return true;
	}
	
	public function setURLCompiledTarget( $path = false ) {
		if ($path == false) {
			self::$_URL_compiled = 	file_exists(self::$_URL_compiled)
										? self::$_URL_compiled
										: DynamicLang::getPath() . DIRECTORY_SEPARATOR . self::$_URL_compiled;	
		} else {
			self::$_URL_compiled = $path;
		}
		return true;
	}
	
	public function getFilenameCompiled() {
		return DynamicLang_Manager::$_compiled . DIRECTORY_SEPARATOR . $this->filename_compiled;
	}
	
	public function getURLFilenameCompiled() {
		return DynamicLang_Manager::$_URL_compiled . DIRECTORY_SEPARATOR . $this->filename_compiled;
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
	
	public function getVariablesArray() {
		return $this->variables;
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
									DynamicLang::hash($this->variables) .
									'.js';
							
		$this->js_c = $this->openJS(	DynamicLang_Manager::$_compiled . 
										DIRECTORY_SEPARATOR . 
										$this->filename_compiled, 
										false,
										'w'
									);
		$str = $this->replaceAll();
		
		fwrite($this->js_c,$str);
		
	}
	
	public function replaceAll() {		
		$handle = $this->getJSInString( $this->js );
		
		/**
		 * Substitui as variáveis
		 */
		foreach ($this->variables as $key => $value) {
			$handle = str_replace('<?js:$'.$key.'?>',$value,$handle);	
		}
		
		$handle = preg_replace( '/\<\?js\:\$.*?\?\>/','',$handle);
								

		return $handle;
	}
	
	protected function getFileInString( $fp ) {
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