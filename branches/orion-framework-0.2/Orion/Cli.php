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

 abstract class OrionCli
 {
	public static $_configs = array();
	
	public function __construct()
	{
		$this->loadConfigScripts();
	}
	
	public function run()
	{
	
	}
	
	public function getOption()
	{
	
	}
	
	public function help()
	{
	
	}
	
	protected function greetings()
	{
		printf("Orion-Framework 0.1. Linha de comando para criação de Commands/Models/Units/Apps\n");
		printf("Uso: scripts/creator [OPÇÂO] ... [PARAMETROS] ...\n");
		printf("Send bugs to: <bugs@orion-framework.org\n");
		return 1;
	}
	
	protected function loadConfigScripts()
	{
		$file = Orion::getPathIndex() . DIRECTORY_SEPARATOR . 'scripts' . DIRECTORY_SEPARATOR . 'scripts.yml';
		if( !file_exists($file) )
		{
			fprintf(STDERR, "\nNão encontrado o arquivo de configuração dos scripts em : %s\n", $file);
			exit(1);
		}
		
		$fp = fopen($file, 'r');
		require_once(Orion::getPath() . DIRECTORY_SEPARATOR . 'Vendor' . DIRECTORY_SEPARATOR . 'Spyc' . DIRECTORY_SEPARATOR . 'spyc.php');
		$configs = array();
		$configs = Spyc::YAMLLoad($file);
		OrionCli::$_configs = $configs;
		return;
	}
 }