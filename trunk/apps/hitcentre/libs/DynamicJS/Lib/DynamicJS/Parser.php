<?php

class DynamicJS_Parser
{
	public 	$_tokens_sign;
	private $_inside = 0;
	public 	$_src = '';
	public	$size;
	public static $x = 0;
	public $line = 1;
	private $variables = array();
	
	/**
	 * Pilhas
	 */
	private $_stack_block 	= 0;
	private $_stack_par		= 0;
	private $_stack_if		= 0;
	private $_stack_for		= 0;
	private $_stack_while	= 0;
	
	/**
	 * Operadores condicionais
	 */
	public $_op_cond = array(
		DynamicJS::OP_COND_EQ 	=> '==', 
		DynamicJS::OP_COND_NEQ	=> '!=', 
		DynamicJS::OP_COND_LT	=> '<', 
		DynamicJS::OP_COND_GT	=> '>', 
		DynamicJS::OP_COND_LTEQ	=> '<=', 
		DynamicJS::OP_COND_GTEQ	=> '>='
	);
	
	public function __construct()
	{
		$this->setDfTokensSigns();
	}
	
	private function setDfTokensSigns()
	{
		$this->_tokens_sign = array(
				DynamicJS::TAG_INIT			=> '<@',
				DynamicJS::TAG_END			=> '@>',
				DynamicJS::DELIM			=> ';',
				DynamicJS::OP_LOG_AND		=> '&&',
				DynamicJS::OP_LOG_AND_ALPHA	=> 'and',
				DynamicJS::OP_LOG_OR		=> '||',
				DynamicJS::OP_LOG_OR_ALPHA	=> 'or',
				DynamicJS::OP_COND_EQ		=> '==',
				DynamicJS::OP_COND_GT		=> '>',
				DynamicJS::OP_COND_GTEQ		=> '>=',
				DynamicJS::OP_COND_LT		=> '<',
				DynamicJS::OP_COND_LTEQ		=> '<=',
				DynamicJS::OP_COND_NEQ		=> '!=',
				DynamicJS::OP_ARITH_EQ		=> '=',
				DynamicJS::OP_ARITH_ADD		=> '+',
				DynamicJS::OP_ARITH_SUB		=> '-',
				DynamicJS::OP_ARITH_DIV		=> '/',
				DynamicJS::OP_ARITH_MOD		=> '%',
				DynamicJS::EXP_IF 			=> 'if',
				DynamicJS::EXP_ELSE			=> 'else',
				DynamicJS::EXP_FOR			=> 'for',
				DynamicJS::EXP_WHILE		=> 'while',
				DynamicJS::EXP_DO			=> 'do'
		);
	}
	
	public function parse( $string )
	{
		$this->_src = $string;
		$this->size = strlen($this->_src);
				
		for( self::$x = 0;self::$x < strlen($this->_src); self::$x++ )
		{
			/**
			 * retira espaços e tabulações
			 */
			if( $this->_src[self::$x] == ' ' || 
				$this->_src[self::$x] == "\t")
				continue;
			if( $this->_src[self::$x] == "\n" )
			{
				$this->line++;
				continue;
			}
				
			//print $this->_src[$x];
			
			if ( $this->_stack_block == 1 )
			{
				if( $this->parseVar( self::$x ) )
					$this->_var();
				elseif ( $this->parseIF( self::$x ) )
					$this->_if();
				elseif ( $this->parseFor( self::$x ) )
					$this->_inside = DynamicJS::INS_FOR;
							
			} else
				$this->parseBlock( self::$x );
		}
	}
	
	public function parseIF( $x )
	{
		$match = 0;
		
		for( $i=0, $x; $i < strlen($this->_tokens_sign[DynamicJS::EXP_IF]) && $x < strlen($this->_src); $i++, $x++)
			if( $this->_src[$x] == $this->_tokens_sign[DynamicJS::EXP_IF][$i] )
				$match = 1;
			else 
				$match = 0;
		
		if($match == 1)
		{
			$this->addStackIF();
			return true;
		} else
			return false;		
	}
	
	private function parseVar( $x )
	{
		if( $this->_src[$x] != '_' )
			return false;
		else
			return true;
	}
	
	private function _var()
	{
		self::$x++;
		$var = $this->getVarName();
		
		/**
		 * FIXME : pelo amor de deus ^ ^
		 * funfa mas ridiculamente
		 */
		for( ; self::$x < $this->size; self::$x++ )
		{
			/**
			 * retira espaços e tabulações
			 */
			if( $this->_src[self::$x] == ' ' || 
				$this->_src[self::$x] == "\t")
				continue;
			if( $this->_src[self::$x] == "\n" )
			{
				$this->line++;
				continue;
			}
			
			$op = $this->getOP_ARITH();
			if ( $op != DynamicJS::OP_ARITH_EQ)
			{
				printf("DynamicJS ERROR: Inesperado '%s' na linha %d.", $this->_tokens_sign[$op], $this->line);
				exit(1);
			} else
				break;
		}
		self::$x++;
		
		$this->jumpSpaces();
		
		if( $this->_src[self::$x] == '"' || $this->_src[self::$x] == '\'' )
		{
			$value = $this->getString();
			$this->variables[$var] = $value;
		} elseif( ctype_digit( $this->_src[self::$x]) )
		{
			$value = $this->getNumber();
			$this->variables[$var] = $value;
		} else {
			printf("DynamicJS ERROR: Sintaxe incorreta na linha <b>%d</b>", $this->line);
			exit(1);
		}
		
	}
	
	private function _if()
	{
		$this->addStackIF();
		$var 	= array();
		$value 	= array();
		$cond 	= array();
		$exp 	= array();
		$op 	= array();
		
		/**
		 * É possivel agrupar expressões em parentesis,
		 * as expressões agrupadas dessa maneira são avaliadas
		 * internamente ao parentesis, depois com as expressões 
		 * externas.
		 * ( 2 > 1 ) || ( 2 == 2 && 3 > 2 )
		 * Na expressão acima será avaliado primeiro ( 2 > 1 )
		 * depois será avaliado ( 2 == 2 && 3 > 2 ), o resultado 
		 * das duas expressões serão avaliados entre si. ^ ^
		 * @var array	$exp_par	
		 */
		$exp_par = new DynamicJS_Par();
		
		/**
		 * Encontra o primeiro parentesis
		 */
		for (; self::$x < strlen($this->_src); self::$x++ )
		{
			/**
			 * retira espaços e tabulações
			 */
			if( $this->_src[self::$x] == ' ' || 
				$this->_src[self::$x] == "\t")
				continue;
			if( $this->_src[self::$x] == "\n" )
			{
				$this->line++;
				continue;
			}
			
			if ( $this->_src[self::$x] == '(' )
			{
				/**
				 * Esse é o primeiro '(', obrigatório a todo IF
				 */
				$exp_par->createParent()
						->upLevel();
				$this->addStackPar();
				break;
			}
			/** Se não encontrou nenhum parentesis até o fim do arquivo, erro... */	
			elseif( self::$x == ( strlen($this->_src) - 1) )
			{
				printf("Há um erro na sintaxe. Esperado '(' na linha <b>%s</b>.", $this->line);
				exit(1);
			}			
		}
		
		/**
		 * _src[$x] está sobre o parentesis
		 */
		self::$x++;
		
		$this->jumpSpaces();
		
		if( $this->_src[self::$x] == ')' )
			throw new Exception("DynamicJS::ERROR: Nenhuma condição no IF da linha <b>".$this->line."</b>");
		
		/**
		 * pega as condições até o fechamento do parentesis
		 */
		for ( ; self::$x < strlen($this->_src); self::$x++ )
		{
			print "#### ".self::$x."####".$this->_src[self::$x]."###<br>";
			/**
			 * retira espaços e tabulações
			 */
			if( $this->_src[self::$x] == ' ' || 
				$this->_src[self::$x] == "\t")
				continue;
			elseif( $this->_src[self::$x] == "\n" )
			{
				$this->line++;
				continue;
			} elseif( $this->_src[self::$x] == ')' )
			{
				$exp_par->downLevel();
				$this->remStackPar();
				
				if ($this->_stack_par > 0)
					continue;
				else
					break;
			} elseif( $this->_src[self::$x] == '(' )
			{
				$exp_par->upLevel();
				$this->addStackPar();
				continue;
			}
			elseif ( $this->_src[self::$x] == '_' )
			{
				self::$x++;
				$var[]	= $this->getVarName();
								
				if( !isset($this->variables[$var[count($var)-1]]) )
				{
					printf("DynamicJS ERROR: Variavel _%s_ ainda não definida na linha <b>%d</b>.\n",$var[count($var)-1], $this->line);
					exit(1);
				}
				self::$x++;
				$this->jumpSpaces();
				
				$op[count($var)-1] = $this->getOP_COND( self::$x );
				if(!$op[count($var)-1])
				{
					printf("DynamicJS ERROR: Sintaxe incorreta na linha %s .", $this->line);
					exit(1);
				}
				$this->jumpFor( strlen( $this->_tokens_sign[$op[count($var)-1]] ) );
				
				$this->jumpSpaces();
				
				if( $this->_src[self::$x] == '"' || $this->_src[self::$x] == '\'' )
				{
					$value[count($var)-1] = $this->getString();
					
				} elseif( ctype_digit( $this->_src[self::$x]) )
				{
					$value[count($var)-1] = $this->getNumber();
					self::$x--;
				} elseif( $this->_src[self::$x] == '_' )
				{
					/**
					 * pular o primeiro '_' da variavel
					 */
					self::$x++;
					$var_value = $this->getVarName();
					if( !isset($this->variables[$var[count($var)-1]]) )
					{
						printf("DynamicJS ERROR: Variavel _%s_ ainda não definida na linha <b>%d</b>.\n",$var[count($var)-1], $this->line);
						exit(1);
					}
					$value[count($var)-1] = $this->variables[$var_value];
					/**
					 * pular o segundo '_'.
					 * 	variaveis ==   _*_
					 */
					self::$x;
				}
				else {
					printf("DynamicJS ERROR: Sintaxe incorreta na linha <b>%d</b>", $this->line);
					exit(1);
				}
				
				$exp_par->createParRelational( $var[count($var)-1], $value[count($var)-1], $op[count($op)-1])
						->showNode();
								
				$cond[count($var)-1] = $this->opConditional( $op, $var[count($var)-1], $value[count($var)-1] );
				Tools_Debug::debugArray($cond);
				print "<br>";
				
			} elseif ( $this->getOP_LOG( self::$x ) )
			{
				/**
				 * Operador lógico && ou ||
				 */
				$exp[] = $this->getOP_LOG( self::$x );
				$this->jumpFor( strlen($this->_tokens_sign[$exp[count($exp)-1]]) );
				printf("Encontrado um operador lógico<br>");
				print_r($exp);
			} elseif( self::$x == (strlen($this->_src)-1) )
			{
				printf("DynamicJS::ERROR: Não foi encontrado o fechamento do parentesis do IF na linha <b>%d</b>", $this->line);
				exit(1);
			}
			print "<b>".$this->_stack_par . "</b><br>";
			
		}
		
		if( $this->_stack_par > 0 )
		{
			printf("DynamicJS::ERROR: Sintaxe incorreta na linha <b>%d</b>",$this->line);
			exit(1);
		}
		
		self::$x++;
		print "<b>".$this->_stack_par . "</b><br>";
		$this->jumpSpaces();
		if ($this->_src[self::$x] == ')')
			throw new Exception("DynamicJS::ERROR: Sintaxe incorreta na linha <b>".$this->line."</b>");
		
		print "<br>#################################################<br>";
		print "Fim da condição do IF<br>";
		print "<br>variaveis<br>";
		print_r($var);
		print "<br>valores<br>";
		print_r($value);
		print "<br>expressoes<br>";
		print_r($exp);
		print "<br>";
		for($i=0;$i<count($var);$i++)
		{
			print $var[$i] . " " . $this->_tokens_sign[$op[$i]] . " " . $value[$i] . "<br>";
		}
		/**
		 * Body
		 */
		print "<br>corpo do IF";
		print "<br><pre>";
		
		/**
		 * armazena o resultado da condição
		 */
		$res_cond = array();
		
		$nodes = $exp_par->getNode();
		$gt = $exp_par->getGreaterLevel();
		
		while( $gt > 0 )
		{
			$node = $exp_par->getArrayOfNodesInLevel( $gt );
			
			foreach( $node as $n )
			{
				$res_cond[] = $this->opConditional( $n['op'], $n['var1'], $n['var2'] );
				$exp_par->setResultExpInNode( $n['n'], $res_cond[count($res_cond)-1]);
				print "<br>(".$n['var1'] ." " . $this->_tokens_sign[$n['op']] . " " . $n['var2'] . ") = ";
				if( $res_cond[count($res_cond)-1] == false )
					print "FALSO<br>";
				else
					print "TRUE<br>";
				$i++;
			}
			$gt--;
		}
		
		$node = $exp_par->getNode();
		print_r($node);
		
		$cond = false;
		
		$cond = $this->opLogical( $node[0]['result'], $node[1]['result'], $exp[0]);
		$cond = $this->opLogical( $cond, $node[2]['result'], $exp[1]);
		
		
		
		if($cond == true)
			print "TRUE";
		else
			print "FALSE";
	
		print "<br>";
	}
	
	private function opConditional( $op, $var, $value )
	{
		switch($op)
		{
			case DynamicJS::OP_COND_EQ:
				if ( $this->variables[$var] == $value )
					return true;
				else
					return false;
				break;
			case DynamicJS::OP_COND_NEQ:
				if ( $this->variables[$var] != $value )
					return true;
				else
					return false;
				break;
			case DynamicJS::OP_COND_LT:
				if ( $this->variables[$var] < $value )
					return true;
				else
					return false;
				break;
			case DynamicJS::OP_COND_GT:
				if ( $this->variables[$var] > $value )
					return true;
				else 
					return false;
				break;
			case DynamicJS::OP_COND_GTEQ:
				if ($this->variables[$var] >= $value)
					return true;
				else
					return false;
				break;
			case DynamicJS::OP_COND_LTEQ:
				if ( $this->variables[$var] <= $value )
					return true;
				else 
					return false;
				break;
			default:
				return false;
		}
	}
	
	private function opLogical( $bool1, $bool2, $op )
	{
		switch( $op )
		{
			case DynamicJS::OP_LOG_AND:
			case DynamicJS::OP_LOG_AND_ALPHA:
				if ( $bool1 && $bool2 )
					return true;
				else	
					return false;
				break;
			case DynamicJS::OP_LOG_OR:
			case DynamicJS::OP_LOG_OR_ALPHA:
				if( $bool1 || $bool2 )
					return true;
				else
					return false;
		}
	}
	
	private function jumpFor( $n )
	{
		for($i=0;$i<$n;$i++)
			self::$x++;
	}
	
	private function getVarName()
	{
		$var = " ";
		$i = 0;
		while( $this->_src[self::$x] != '_' && self::$x < strlen($this->_src) )
		{
			if( $this->_src[self::$x] == ')' )
			{
				printf("DynamicJS ERROR: Esperado '_' para uma variavel na linha <b>%s</b>", $this->line);
				exit(1);
			}
			/**
			 * retira espaços e tabulações
			 */
			if( $this->_src[self::$x] == ' ' || 
				$this->_src[self::$x] == "\t")
			{
				self::$x++;
				continue;
			}
			if( $this->_src[self::$x] == "\n" )
			{
				$this->line++;
				self::$x++;
				continue;
			}
			
			if ( self::$x == ( strlen($this->_src) -1 ) )
			{
				printf("DynamicJS ERROR: Erro de sintaxe. Esperado '_' para uma variável na linha <b>%s</b>.",$this->line);
				exit(1);
			}
			
			$var[$i] = $this->_src[self::$x];
			$i++;
			self::$x++;
		}
		printf("Encontrado a variavel _%s_ na linha <b>%d</b><br>", $var, $this->line);
		return $var;
	}
	
	private function getNumber()
	{
		$temp = " ";
		$num = 0;
		$unique = 0;
		
		for( $i=0;self::$x < $this->size; $i++, self::$x++ )
		{
			
			if ( ctype_digit( $this->_src[self::$x] ) || $this->_src[self::$x] == '.' )
			{
				
				if( $this->_src[self::$x] == '.' && $unique == 0)
					$unique = 1;
				elseif( $this->_src[self::$x] == '.' && $unique == 1 )
				{
					printf("DynamicJS ERROR: Inesperado '.' na linha <b>%d</b>\n",$this->line);
					exit(1);
				}
				
				$temp[$i] = $this->_src[self::$x];
			}
			elseif( self::$x == ($this->size - 1) )
				return false;
			else 
				return $temp;
		}
	}
	
	private function getString()
	{
		$temp = " ";
		$str = '';
		self::$x++;
		for( $i=0;self::$x < $this->size && $this->_src[self::$x] != '"'; $i++, self::$x++ )
		{
			$temp[$i] = $this->_src[self::$x];
			
			if( self::$x == ($this->size - 1) )
				return false;
		}
		
		return $temp;
	}
	
	private function getOP_ARITH()
	{
		$i = 0;
		$op = "";
		while( 	self::$x < strlen($this->_src) )
		{
			if( $this->_src[self::$x] == $this->_tokens_sign[DynamicJS::DELIM] )
			{
				printf("DynamicJS ERROR: Inesperado '%s'na linha <b>%s</b>", $this->_tokens_sign[DynamicJS::DELIM], $this->line);
				exit(1);
			}
			/**
			 * retira espaços e tabulações
			 */
			if( $this->_src[self::$x] == ' ' || 
				$this->_src[self::$x] == "\t")
			{
				self::$x++;
				continue;
			}
			if( $this->_src[self::$x] == "\n" )
			{
				$this->line++;
				self::$x++;
				continue;
			}
			
			if ( $this->_src[self::$x] == $this->_tokens_sign[DynamicJS::OP_ARITH_EQ] )
				return DynamicJS::OP_ARITH_EQ;
			elseif ($this->_src[self::$x] == $this->_tokens_sign[DynamicJS::OP_ARITH_ADD] )
				return DynamicJS::OP_ARITH_ADD;
			elseif ($this->_src[self::$x] == $this->_tokens_sign[DynamicJS::OP_ARITH_SUB] )
				return DynamicJS::OP_ARITH_SUB;
			elseif ($this->_src[self::$x] == $this->_tokens_sign[DynamicJS::OP_ARITH_DIV] )
				return DynamicJS::OP_ARITH_DIV;
			elseif ($this->_src[self::$x] == $this->_tokens_sign[DynamicJS::OP_ARITH_MOD] )
				return DynamicJS::OP_ARITH_MOD;
				
			self::$x++;
			
			if ( self::$x == ( strlen($this->_src) -1 ) )
			{
				printf("DynamicJS ERROR: Erro de sintaxe. Esperado OP_ARITH na linha <b>%s</b>.",$this->line);
				exit(1);
			}			
		}
	}
	
	/**
	 * Verifica se é um expressão lógica
	 * && ou and ou || ou or
	 */
	private function getOP_LOG( $x )
	{
		$match = 0;
		$temp = " ";
		$pos = $x;
		for( $i=0; $i < strlen($this->_tokens_sign[DynamicJS::OP_LOG_AND]); $i++, $x++ )
			if( $this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_LOG_AND][$i] )
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_LOG_AND;
		$x = $pos;
		
		for( $i=0; $i < strlen($this->_tokens_sign[DynamicJS::OP_LOG_AND_ALPHA]); $i++, $x++ )
			if( $this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_LOG_AND_ALPHA][$i] )
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_LOG_AND_ALPHA;
		
		$x = $pos;
		
		for( $i=0; $i < strlen($this->_tokens_sign[DynamicJS::OP_LOG_OR]); $i++, $x++ )
			if( $this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_LOG_OR][$i] )
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1)
			return DynamicJS::OP_LOG_OR;
		
		$x = $pos;
		
		for( $i = 0; $i<strlen($this->_tokens_sign[DynamicJS::OP_LOG_OR_ALPHA]); $i++, $x++)
			if($this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_LOG_OR_ALPHA][$i])
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_LOG_OR_ALPHA;		
		else
			return false;
	}
	
	private function getOP_COND( $x )
	{
		$match = 0;
		$temp = " ";
		$pos = $x;
		for( $i=0; $i < strlen($this->_tokens_sign[DynamicJS::OP_COND_EQ]); $i++, $x++ )
			if( $this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_COND_EQ][$i] )
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_COND_EQ;
		$x = $pos;
		
		for( $i=0; $i < strlen($this->_tokens_sign[DynamicJS::OP_COND_NEQ]); $i++, $x++ )
			if( $this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_COND_NEQ][$i] )
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_COND_NEQ;
		
		$x = $pos;
		
		for( $i=0; $i < strlen($this->_tokens_sign[DynamicJS::OP_COND_LT]); $i++, $x++ )
			if( $this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_COND_LT][$i] )
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1)
			return DynamicJS::OP_COND_LT;
		
		$x = $pos;
		
		for( $i = 0; $i<strlen($this->_tokens_sign[DynamicJS::OP_COND_GT]); $i++, $x++)
			if($this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_COND_GT][$i])
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_COND_GT; 
		
		$x = $pos;
		
		for ($i=0;$i<strlen($this->_tokens_sign[DynamicJS::OP_COND_GTEQ]); $i++, $x++)
			if($this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_COND_GTEQ][$i])
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_COND_GTEQ;
		
		$x = $pos;
		
		for ($i=0;$i < strlen($this->_tokens_sign[DynamicJS::OP_COND_LTEQ]); $i++, $x++)
			if($this->_src[$x] == $this->_tokens_sign[DynamicJS::OP_COND_LTEQ][$i])
				$match = 1;
			else {
				$match = 0;
				break;
			}
		
		if($match == 1) return DynamicJS::OP_COND_LTEQ;
		else {
			printf("DynamicJS ERROR: Sintaxe incorreta na linha <b>%d</b>", $this->line);
			exit(1);
		}
		
	}
	
	public function jumpSpaces()
	{
		while( ( $this->_src[self::$x] == ' ' || $this->_src[self::$x] == "\t" || $this->_src[self::$x] == "\n" ) && self::$x < $this->size )
		{
			if ( $this->_src[self::$x] == "\n" )
				$this->line++;
			
			self::$x++;
		}
		return;
	}
	
	private function parseBlock( $x )
	{
		$match = 0;
		
		/**
		 * Incrementa a posição do source e do delimitador,
		 * para casar elas tem que ser sempre iguais _src == TAG_INIT
		 */
		for ( $i = 0, $x ; $i < strlen($this->_tokens_sign[DynamicJS::TAG_INIT]); $i++, $x++)
			if ( $this->_src[$x] == $this->_tokens_sign[DynamicJS::TAG_INIT][$i] )
				$match = 1;
			else	
				$match = 0;
		
		if ($match == 1)
		{
			$this->_stack_block = 1;
			$this->_inside = DynamicJS::TAG_INIT;
			return true;
		} else
			return false;
	}
	
	private function parseFor( $x )
	{
	
	}
	
	private function parsePar( $x )
	{
		
	}
	
	public function remStackBlock()
	{
		$this->_stack_block--;
		if ( $this->_stack_block < 0 )
			throw 
				new 
					Exception("DynamicJS::ERROR: Encontrado inesperado ". $this->_tokens_sign[DynamicJS::TAG_END] . " na linha <b>".$this->line."</b>");
		return $this;
	}
	
	public function addStackPar()
	{
		$this->_stack_par++;
		return $this;
	}
	
	public function remStackPar()
	{
		$this->_stack_par--;
		if ($this->_stack_par < 0)
			throw 
				new 
					Exception("DynamicJS::ERROR: Encontrado inesperado ')' na linha <b>".$this->line."</b>");
		return $this;
	}
	
	public function addStackIF()
	{
		$this->_stack_if++;
		return $this;
	}
	
	public function remStackIF()
	{
		$this->_stack_if--;
		return $this;
	}
	
	public function addStackWhile()
	{
		$this->_stack_while++;
		return $this;
	}
	
	public function remStackWhile()
	{
		$this->_stack_while--;
		return $this;
	}
}