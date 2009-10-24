<?php

class OrionSecurity_Crypt_RC4
{
	/**
	 * Recomenda-se uma chave de pelo menos 128 bits
	 * RC4 com chave menor que 40 bits são facilmente quebráveis.
	 * @var string 	- Chave usada para cifrar a mensagem
	 */
	private $_key = array();
	
	/**
	 * Array de permutações
	 * @var array 	- Array de permutações
	 */
	private $S = array();
	
	/**
	 * Array com a chave
	 * @var array 	- Chave
	 */
	private $K = array();
	
	private function __construct()
	{
	
	}
	
	public static function getInstance()
	{
		static $instance;
		if(!$instance)
			$instance = new self();
		
		return $instance;
	}
	public function setKey($key = '')
	{
		if(strlen($key) <= 40)
			throw new OrionException("The key length is too small");
		
		$this->_key = array();
		for($i=0;$i<strlen($key);$i++)
			$this->_key[] = ord($key{$i});
		return $this;
	}
	
	public function setKeyHex(array $key)
	{
		$this->_key = array();
		foreach($key as $k)
			$this->_key[] = $k;
		return $this;
	}
	
	public function encrypt($message, $key = false)
	{
		$msg = array();
		if(is_string($message))
			for($i=0;$i<strlen($message);$i++)
				$msg[$i] = ord($message{$i});
		elseif(is_array($message))
			$msg = $message;
		else
			throw new OrionException("Invalid type of message, should be a string");
		
		return implode('', array_map('chr', $this->rawEncrypt($msg, $key)));
	}
	
	/**
	 * Encripta a mensagem com o algoritmo ARCFOUR (RC4)
	 * Não há restrições quanto a base dos valores do array
	 * $message, pois ocorrerá uma permutação cíclica.
	 * Se os valores do array $message forem caracteres, será
	 * utilizado a representação numérica deles (ASCII).
	 * @param 	$message	array			- Mensagem de entrada
	 * @param 	$key 		string | array	- Key
	 * @return 	array
	 */
	public function rawEncrypt(array $message, $key = false)
	{
		if(!empty($key))
			if(is_string($key))
				$this->setKey($key);
			elseif(is_array($key))
				$this->setKeyHex($key);
			else
				throw new OrionException("Invalid Type of key.");
		
		$this->init();
		
		$i = 0;
		$j = 0;
		$output = array();
		for($t = 0; $t<count($message);$t++)
		{
			$i = ($i + 1) % 256;
			$j = ($j + $this->S[$i]) % 256;
			self::swap($this->S[$i], $this->S[$j]);
			$output[$t] = $this->S[($this->S[$i] + $this->S[$j]) % 256] ^ $message[$t];
		}
		
		return $output;
	}
	
	private function init()
	{
		/**
		 * KSA
		 * Inicializa o array a ser permutado
		 */
		$this->S = array(
			0,  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15,
			16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,
			32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47,
			48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63,
			64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79,
			80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95,
			96, 97, 98, 99,100,101,102,103,104,105,106,107,108,109,110,111,
			112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,
			128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,
			144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,
			160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,
			176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,
			192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,
			208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,
			224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,
			240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255
		);
		
		for($i=0;$i < 256;$i++)
			/**
			 * Preenche o array K com a chave
			 */
			$this->K[$i] = $this->_key[$i % count($this->_key)];
		
		/**
		 * Permutação inicial
		 */
		$j = 0;
		for($i=0; $i<256; $i++)
		{
			$j = ($j + $this->S[$i] + $this->K[$i]) % 256;
			self::swap($this->S[$i], $this->S[$j]);
		}
	}
	
	/**
	 * Xor Swap. Trocar valores de duas varíaveis sem usar
	 * armazenamento temporário. :)
	 */
	public static function swap(&$n1, &$n2)
	{
		if(!is_int($n1) && !is_int($n2))
			throw new Exception('ERROR: invalid type.');
		$n1 = $n1 ^ $n2;
		$n2 = $n1 ^ $n2;
		$n1 = $n1 ^ $n2;
		
		return;
	}
	
	public function getS()
	{
		return $this->S;
	}
	
	public function getK()
	{
		return $this->K;
	}
	
	public function getKey()
	{
		return $this->_key;
	}
	
	public function getKeyAsString()
	{
		return (implode('',array_map('chr', array_map('hexdec',$this->_key))));
	}
}