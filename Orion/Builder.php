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

 abstract class OrionBuilder
 {
	public function makeDir($dirname, $name, $mod = 0777)
	{
		if(!file_exists($dirname))
			if(mkdir($dirname) !== FALSE)
				printf("\t\t\033[31;33;40mDirectory created:\033[0m %s\n",$name);
		chmod($dirname, $mod);
		return $dirname;
	}
	
	public function saveFile( $filename, $content, $overwrite = false )
	{
		if(file_exists($filename) && $overwrite == false)
		{
			fprintf(STDERR, "\nArquivo já existe. \n");
			exit(1);
		} elseif(!file_exists($filename) || (file_exists($filename) && $overwrite == true))
		{
			$fp = fopen($filename, "w");
			if(!$fp)
			{
				fprintf(STDERR, "Não foi possivel abrir o arquivo: %s.\n", $filename);
				exit(1);
			}
		} 
		
		if(fwrite($fp, $content) == FALSE)
		{
			fprintf(STDERR, "Não foi possivel gravar no arquivo: %s.\n", $filename);
			exit(1);
		}
		
		return true;
	}
	
 }