<?php
/*
 * Created on 17/05/2009
 *
 * @author Tiago Natel de Moura
 * @email tiago_moura@live.com
 */

/**
 * Classe de Configuração
 *
 */
 class Config {
	
	/**
	 * Configurações do sistema de templates
	 * O framework Orion dispoe a faixa [1000,2000] de 
	 * constantes para uso do desenvolvedor.
	 * Pode-se usar a o método Orion::setAttribute( CONSTANTE, VALOR ) 
	 * para o Orion armazenar essa configuração internamente.
	 * Para recuperar use: Orion::getAttribute( CONSTANTE );
	 * ^ ^
	 */
	const ATTR_DIR_TEMPLATES_ADMIN	= 1001;
	const ATTR_DIR_TEMPLATES_FRONT 	= 1002;
 	/*
 	 * Constantes de apresentação
 	 */
 	const LANG 				= 'pt_BR';
 	const SYSTEM_NAME 		= "ESCOLA DE IDIOMAS";
 	const FRAMEWORK_NAME 	= "Orion Framework";
 	const CLIENTE 			= "Hitcentre";
 	
 	/**
 	 * String para a geração da chave única --> uniqueKEY
 	 */
 	const SECRET_KEY 		= 'universe';
	
 	/**
 	 * Define o dominio onde se encontra hospedado o site
 	 * Essa variável é utilizada somente no ambiente de produção
 	 *
 	 */
 	const DOMAIN			= 'localhost'; 
 	/*
 	 * Define a URL do site
 	 */
	 
	 static private $blockeds;

	public function __construct() {
		
		/**
		 * Define a exibição de todos os tipos de erros por padrão.
		 * Se o sistema estiver m produção, ajustar error_reporting para 0
		 */
		error_reporting(E_ALL | E_STRICT);
		
		/**
		 * Ajusta o Time-Zone para evitar erros E_STRICT do smarty ¬¬
		 */
		date_default_timezone_set('America/Sao_Paulo');
		
		$this->setBlockedsURLs( array(
									/*'Admin/Manager'*/
								)
							);
		
		$this->getPermissionsDir();
		
		/**
		 * Ajusta os diretórios dos templates 
		 */
		Orion::setAttribute( self::ATTR_DIR_TEMPLATES_ADMIN, 'Admin/Hitcentre' );
		Orion::setAttribute( self::ATTR_DIR_TEMPLATES_FRONT, 'Front/Hitcentre' );
	}
 	
 	/**
 	 * Fixa um algoritmo para a encriptação das senhas
 	 */
 	public static function encryptPass( ) {
 		return Config::SECRET_KEY;
 	}
 	
 	 	
 	public function getPermissionsDir() {
 		if( is_writable( Orion::getAttribute(Orion::ATTR_DIR_LOGS) ) === false) {
 			print "##<br />";
 			print "## Configure as permissões dos arquivos do servidor:<br />";
 			print "## " . Orion::getAttribute(Orion::ATTR_DIR_LOGS) . " não possui permissoes de escrita!! ajuste para chmod -R 777.<br />";
 			exit();
 		}
 	}
  	
 	/**
 	 * Ajusta às áreas do sistema que
 	 * não poderão ser acessadas diretamente
 	 * pela url.
 	 * 
 	 * Motivo:: Segurança
 	 *
 	 * @param array $block
 	 * @return array
 	 */
 	protected function setBlockedsURLs( $block ) {
 		Config::$blockeds = $block;
 		return Config::$blockeds;
 	}
 	
 	/**
 	 * Retorna às áreas do sistema que
 	 * não poderão ser acessadas diretamente pela
 	 * url
 	 * 
 	 * Motivo:: Segurança
 	 *
 	 * @return array
 	 */
 	static public function getBlockedsURLs() {
 		return Config::$blockeds;
 	}
 }