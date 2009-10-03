<?php
/*
    This library is free software; you can redistribute it and/or
    modify it under the terms of the GNU Library General Public
    License version 2 as published by the Free Software Foundation.

    This library is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    Library General Public License for more details.

    You should have received a copy of the GNU Library General Public License
    along with this library; see the file COPYING.LIB.  If not, write to
    the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
    Boston, MA 02110-1301, USA.

    ---
    Copyright (C) 2009, Tiago Natel de Moura tiago_moura@live.com
*/

/**
 * Orion
 * {info}
 *
 * @package     Orion
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class OrionException extends Exception
{
	public $message;
 	public $code;
 	public $erro;

	public function __construct($message, $code = 0) {
		$this->message = $message;
		$this->code = $code;

		parent::__construct($this->message,$this->code);
		$this->tabelaMensagem();
	}

	public function tabelaMensagem() {
		print "<html>\n";
		print "<head>\n";
		print "<title>Error</title>\n";
		print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>\n";
		print "<script type=\"text/javascript\" src=\"".self::getPath() . "Orion/Exception/View/jquery.js\"></script>\n";
		print "<script type=\"text/javascript\">\n";
		print "\$(document).ready(function() {\n";
		print "\$(\"#trace\").hide();\n";
		print "\$('#btnTrace').click(function() {\n";
		print "\$('#trace').toggle(); });\n";
		print "});\n";
		print "function trace() { \$(\"#trace\").show(1000);\n }";
		print "</script>";
		print "<style type=\"text/css\" media=\"all\">\n";
		print "<!--";
		print "table { margin:0 auto;}";
		print "table td { background-color:red; }";
		print "table td { color:white;font-weight:bold; }";
		print "table th.code {  }";
		print "table th.msg { width:500px; }";
		print "table th.solucao { width:300px; }";
		print "#trace { position:relative; margin:0 auto; border:1px solid #ccc; width:800px; color:#FFF; }";
		print ".tbTrace td { color:#FFF;font-weight:bold; background-color:green; height:20px; }";
		print ".tbTrace th.linha { width:30px; }";
		print ".tbTrace th.arquivo { width:500px; }";
		print ".tbTrace th.classe { width:300px; }";
		print ".tbTrace th.funcao { width:300px; }";
		print ".tbTrace th.type { width:100px; }";
		print ".tbTrace th.param { width:300px; }";
		print "table.tbTrace { margin:0 auto; text-align:center; }";
		print "-->";
		print "</style>";
		print "</head>\n";
		print "<body>";
		print "<hr /><hr />";
		print "<div style=\"border:2px solid red;min-height:300px;\">\n";
		print "<table style=\"text-align:center;padding:5px;\">\n";
		print "<tr>\n";
		print "<th class=\"code\">Cod. Erro</th><th class=\"msg\">Mensagem</th><th class=\"solucao\">Possivel solu&ccedil;&atilde;o</th>";
		print "</tr>\n";
		print "<tr>\n";
		print "<td style=\"padding-left:5px;padding-right:5px;\">".$this->code."</td><td style=\"padding-left:5px;padding-right:5px;\">".$this->message."</td><td style=\"padding-left:5px;padding-right:5px;\">".$this->solucao($this->code)."</td>\n";
		print "</tr>\n";
		print "</table>\n";
		print "<br />";
		print "<center><a href=\"javascript:void(0);\" name=\"btnTrace\" id=\"btnTrace\" onclick=\"trace();\">Trace</a></center>\n";
		print "<div id=\"trace\" name=\"trace\">\n";
		print "<pre>";
		print "<table class=\"tbTrace\" id=\"tbTrace\">\n";
			print "<tr><th class=\"linha\">Linha</th><th class=\"arquivo\">Arquivo</th><th class=\"classe\">Classe</th><th class=\"funcao\">fun&ccedil;&atilde;o</th><th class=\"type\">Type</th><th class=\"param\">Parametros</th></tr>";

			$trace = array();
			$trace = $this->getTrace();
			for($i=0;$i<count($trace);$i++) {

			$param = "";
			for($j = 0;$j < count($trace[$i]['args']);$j++) $param .= $trace[$i]['args'][$j] . ", ";

			print "<tr><td>".$trace[$i]['line']."</td><td>".$trace[$i]['file']."</td><td>".$trace[$i]['class']."</td><td>".$trace[$i]['function']."</td><td>".$trace[$i]['type']."</td><td>".$param."</td></tr>";
			}
		print "</table>\n";
		print "</pre>";
		print "</div>";
		print "</div>\n";
		print "</body>\n";
		print "</html>\n";
	}

	public function solucao($code) {
		$this->erro = new OrionException_Erros($this->code);
		$this->erro->lerXML();
		return utf8_encode($this->erro->getMsg($code));
	}
	
	public static function getPath()
	{
		return 	'http://' . $_SERVER['HTTP_HOST'] . 
				dirname(str_replace($_SERVER['DOCUMENT_ROOT'],'', $_SERVER['SCRIPT_FILENAME'])) . DIRECTORY_SEPARATOR;
	}
}