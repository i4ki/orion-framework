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
 * OrionBuilder_Command
 * Builder
 *
 * @package     Orion
 * @subpackage	Builder
 * @author      Tiago Moura <tiago_moura@live.com>
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.orion-framework.org
 * @since       1.0
 * @version     $Revision: 1 $
 */

class OrionBuilder_Command 
	extends OrionBuilder
{
	private $interfaces = array();
	private $extends	= false;
	private $force		= false;
	public 	$methods = array();
	
	public function __construct( $opt = array())
	{
		$extends	= false;
		$implements = array();
		$force		= false;
				
		for($i=1;$i<count($opt);$i++)
		{
			if ( $opt[$i] == 'extends' )
				$extends = $opt[$i+1];
			if ( $opt[$i] == 'implements' )
			{
				$imp = $opt[$i+1];
				$implements = explode(',', $imp);
				for($j=0;$j<count($implements);$j++)
					$implements[$j] = str_replace(' ', '', $implements[$j]);
			}
			if ( $opt[$i] == '--yes' )
				$force = true;
		}
		
		$this->interfaces 	= $implements;
		$this->extends		= $extends;
		$this->force		= $force;
		$this->getMethods();
	}
	
	public function getMethods()
	{
		$lines = file(Orion::getPath() . DIRECTORY_SEPARATOR . 'ICommand.php');
		
		foreach($lines as $line)
			if(preg_match('/(public)|(protected)|(private)\ .*?function\ .*?\(.*?\)/',$line))
			{
				$this->methods[]['proto'] 		= $line;
				
				if( preg_match_all('/(\$[a-zA-Z0-9\_]{1,})/', $line, $match) )
				{
					for($i=0;$i<count($match[0]);$i++)
						$this->methods[count($this->methods)-1]['params'][]	= $match[0][$i];
				}
				
				$this->methods[count($this->methods)-1]['comments'][]	= "/**";
				$this->methods[count($this->methods)-1]['comments'][] = " * This is a method of the interface";
				$this->methods[count($this->methods)-1]['comments'][] = " * ICommand.";
			}
			
		if(count($this->interfaces) > 0)
		{
			foreach($this->interfaces as $iface)
			{
				$lines = file($iface);
				foreach($lines as $line)
					if(preg_match('/(public)|(protected)|(private)\ .*?function\ .*?\(.*?\)/',$line))
					{
						$this->methods[]['proto'] = $line;
						
						if( preg_match_all('/(\$[a-zA-Z0-9\_]{1,})/', $line, $match) )
						{
							for($i=0;$i<count($match[0]);$i++)
								$this->methods[count($this->methods)-1]['params'][]	= $match[0][$i];
						}						
						$this->methods[count($this->methods)-1]['comments'][]	= "/**";
						$this->methods[count($this->methods)-1]['comments'][] = " * This is a method of the interface ".basename($iface,".php").".";
					}
			}
		}
		
		for($i=0;$i<count($this->methods);$i++)
		{
			$this->methods[$i]['proto'] 	= str_replace("\n",'',$this->methods[$i]['proto']);
			$this->methods[$i]['proto']	= str_replace(';','',$this->methods[$i]['proto']);
			$this->methods[$i]['proto'] 	= str_replace('{','',$this->methods[$i]['proto']);
			if(preg_match('/^(\ )|(\t)/',$this->methods[$i]['proto']))
				$this->methods[$i]['proto'] = preg_replace('/^(\ )|(\t)/', '', $this->methods[$i]['proto']);
		}
		return $this->methods;
	}
	
	/**
	 * 
	 */
	public function generateProtoCommand( $project, $module, $commands = array() )
	{
		foreach($commands as $file)
		{
			$file = 	preg_match('/\.php$/',$file) ? 
						ucfirst($file) : 
						ucfirst($file) . '.php';
			$file = 'apps' . DIRECTORY_SEPARATOR . 
					$project . DIRECTORY_SEPARATOR . 
					'commands' . DIRECTORY_SEPARATOR . 
					$module . DIRECTORY_SEPARATOR . $file;
			
			if( file_exists($file) && $this->force == true )
				$this->_generateProtoCommand( $file, $extends, $implements );
			elseif( file_exists($file) && $this->force == false )
			{
				printf("\n\tO command %s já existe. Para sobrescrever use scripts/creator command %s --yes\n",basename($file,'.php'),basename($file,'.php'));
			} 
			elseif( file_exists($file) == false && file_exists(dirname($file)) == true )
				$this->_generateProtoCommand($file, $extends, $implements);
			elseif( file_exists(dirname($file)) == false )
			{
				$dir = dirname($file);
				while( file_exists($dir) == false )
				{
					$dir = dirname($dir);
				}
								
				$arrdir = explode(DIRECTORY_SEPARATOR, $dir);
				$arrfile= explode(DIRECTORY_SEPARATOR, $file);
								
				$diff = count($arrfile) - count($dir);
				$nextdir = count($arrdir);

				while($diff > 1 && $nextdir < (count($arrfile)-1))
				{
					$dir .= DIRECTORY_SEPARATOR . $arrfile[$nextdir];
					OrionTools_Functions::mkDir($dir);
					$nextdir++;
					$diff--;
				}
				
				$this->_generateProtoCommand($file);
				
			}
		}
			
			
		return true;
	}
	
	public function _generateProtoCommand( $file )
	{
		$q 		= array();
		$q[]	= "<?php";
		$q[]	= "/**";
		$q[]	= " *";
		$q[]	= " * This file was auto-generated by Orion Framework";
		$q[]	= " *";
		$q[]	= " * ".Orion::SITE;
		$q[]	= " */";
		$q[]	= " class ".
					sprintf(Orion::getAttribute(Orion::ATTR_FORMAT_CLASS_COMMAND),
							basename($file,'.php')
					) . " extends OrionCommand";
		if ( count($this->interfaces) > 0 )
		{
			for($i=0;$i<count($this->interfaces);$i++)
				$q[]	= " \t\t\t\t" . basename($this->interfaces[$i],".php") . ( $i < (count($this->interfaces)-1) ? "," : "" ); 
		}
		$q[]	= " {";
		foreach( $this->methods as $method )
		{
			for($i=0;$i<count($method['comments']);$i++)
				$q[]	= " \t".$method['comments'][$i];
			for($i=0;$i<count($method['params']);$i++)
			{
				if($i == 0) $q[]	= " \t *";
				$q[]	= " \t * @var\tunknown type\t" . $method['params'][$i];
			}
			$q[]	= "  \t */";
			$q[]	= " \t".$method['proto'];
			$q[]	= " \t{";
			$q[]	= " \t\treturn \$this;";
			$q[]	= " \t}";
			$q[]	= " ";
		}
		$q[]	= " }";
		$q[]	= " ";
		
		$content = implode("\n",$q);
		
		chmod(dirname($file), 0777);
				
		$fp = fopen($file, "w");
		if( !fwrite($fp, $content) )
		{
			printf("Não é possivel gravar no arquivo %s.",$file);
			exit(1);
		} else {
			printf("\tCommand created: %s\n", basename($file, '.php')); 
		}
			
		fclose($fp);
		return true;
	}
}