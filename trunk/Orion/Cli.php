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
	
	public static $colors = array(
		'gray'          => 30,
        'black'         => 30,
        'red'           => 31,
        'green'         => 32,
        'yellow'        => 33,
        'blue'          => 34,
        'magenta'       => 35,
        'cyan'          => 36,
        'white'         => 37,
        'default'       => 39
	);
	
	public static $bgcolor = array(
		'gray'       => 40,
        'black'      => 40,
        'red'        => 41,
        'green'      => 42,
        'yellow'     => 43,
        'blue'       => 44,
        'magenta'    => 45,
        'cyan'       => 46,
        'white'      => 47,
        'default'    => 49,
	);
	
	public static $style = array( 
        'default'           => '0',    
        'bold'              => 1,
        'faint'             => 2,
        'normal'            => 22,        
        'italic'            => 3,
        'notitalic'         => 23,        
        'underlined'        => 4,
        'doubleunderlined'  => 21,
        'notunderlined'     => 24,        
        'blink'             => 5,
        'blinkfast'         => 6,
        'noblink'           => 25,        
        'negative'          => 7,
        'positive'          => 27,
    );
	
	public $text = "";
	
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
	
	public function print_f($text='')
    {
        echo $this->text.$text;
        $this->text = '';
        return $this;
    }
    
    // Input
    public function readNumeric()
    {
        $stdin = fopen('php://stdin', 'r');
        $line = trim(fgets($stdin));
        fscanf($stdin, "%d\n", $number);
          return $number;
    }
    public function readString()
    {
        $stdin = fopen('php://stdin', 'r');
        $line = trim(fgets($stdin));
          fscanf($stdin, "%s\n", $string);
          return $string;
    }
    
    // Sound
    public function beep() { 
		echo "\007"; 
		return $this; 
	}
	
    public function setSoundHerz($herz=100) 
	{ 
		echo "\033[10;{$herz}]"; 
		return $this; 
	}
	
    public function setSoundLong($milliseconds=500)    
	{ 
		echo "'033[11;{$milliseconds}]"; 
		return $this; 
	}
	
    // Cursor position
    public function toPos( $row = 1, $column = 1 )
	{ 
		echo "\033[{$row};{$column}H"; 
		return $this; 
	}
	
    public function cursorUp($lines=1)
	{
		echo "\033[{$lines}A"; 
		return $this; 
	}
	
    public function cursorDown($lines=1)
	{
		echo "\033[{$lines}B"; 
		return $this; 
	}
	
    public function cursorRight($columns=1)
	{ 
		echo "\033[{$columns}C"; 
		return $this; 
	}
	
    public function cursorLeft($columns=1)
	{
		echo "\033[{$columns}D"; 
		return $this; 
	}
	
    // Text colors
    public function setStyle($style='default')
	{ 
		$this->text .= "\033[".self::$style[$style]."m"; 
		return $this; 
	}
	
    public function setColor($color='default')
	{
		$this->text .= "\033[1;".self::$color[$color]."m"; 
		return $this; 
	}
	
    public function setBgColor($color='default')
	{
		$this->text .= "\033[".self::$bgcolor[$color]."m"; 
		return $this; 
	}
    
    // Application
    public function setAppName($name='')
	{
		echo "\033]0;{$name}\007"; 
		return $this;
	}
	
    public function setTitle($name='')
	{
		echo "\033]2;{$name}\007"; 
		return $this; 
	}
	
    public function setIcon($name='')
	{ 
		echo "\033]1;{$name}\007"; 
		return $this; 
	}
	
    // Other
    public function clear()
	{
		echo "\033c"; 
		return $this; 
	}
	
    public function console($num=1)
	{
		echo "\033[12;{$num}]"; 
		return $this; 
	}
 }