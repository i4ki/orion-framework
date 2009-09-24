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

class OrionBuilder_Interactive_Normal 
	extends 
		OrionBuilder_Interactive
{
	
	public function __construct()
	{
		
	}
	
	public function mainMenu()
	{
		printf("\tMenu Principal:\n");
		$this->getMenu();
		printf("\t\n");
		printf("\tEscolha uma das opções: ");
		$opcao = fscanf(STDIN, "%c\n");
		
		switch( $opcao[0] )
		{
			case '1':
				$this->newProject();
				break;
			case '2':
				$this->workIn();
				break;
			case '3':
			case 'q':
				$this->end();
				break;
		}
	}
	
	protected function getMenu()
	{
		printf("\t1 - Criar novo projeto Orion.\n");
		printf("\t2 - Trabalhar em um projeto existente.\n");
		printf("\t3 - Ainda não sei\n");
		printf("\tq - Sair.");
		
		return;
	}
	
	protected function end()
	{
		printf("\n\nSaindo...\n");
		exit();
	}
	
	protected function newProject()
	{
		$this->clear();
		$this->presents();
		printf("\t\t# Novo projeto Orion\n");
		printf("\t\t# Crie um projeto Orion em poucos passos...\n");
		$newProject = new OrionBuilder_Interactive_NewProject();
		$newProject->mainMenu();
	}
}