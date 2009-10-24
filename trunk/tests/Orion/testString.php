<?php

class testString extends UnitTestCase
{
	protected $orion;
	
	public function setUp()
	{
		$this->orion = Orion::getInstance();
	}
	
	public function testIf__ClassString__Exists()
	{
		$this->assertTrue(class_exists('OrionString'));
	}
	
	public function testIf__String_Has_Constructor()
	{
		$this->assertTrue(method_exists('OrionString', '__construct'));
	}
	
	public function test_GettingInstanceOfString__Without_Args()
	{
		try {
			$string = new OrionString();
			$this->assertEqual($string->value, '');
		} catch(OrionException $e)
		{
			$this->fail();
		}
	}
	
	public function test_GettingInstanceOfString__With_ArrayInArg()
	{
		try {
			$string = new OrionString(array(1,2,3));
			$this->fail();
		} catch(OrionException $e)
		{
			$this->assertEqual($e->getCode(), OrionError::TYPE_STRING);
		}
	}
	
	public function test_GettingInstanceOfString__With_IntegerInArg()
	{
		try {
			$string = new OrionString(1);
		} catch(OrionException $e)
		{
			$this->assertEqual($e->getCode(), OrionError::TYPE_STRING);
		}
	}
	
	public function test_GettingInstanceOfString__With_ObjectsInArgs()
	{
		try {
			$string = new OrionString(new ArrayIterator());
		} catch(OrionException $e) {
			$this->assertEqual($e->getCode(), OrionError::TYPE_STRING);
		}
	}
	
	public function test_GettingInstanceOfString__With_StringInArgs()
	{
		try {
			$string = new OrionString("inicializando novo objeto do tipo String");
			$this->assertTrue(is_object($string));
		} catch(OrionException $e)
		{
			$this->fail();
		}
	}
	
	public function test_GettingInstanceOfString__With_ObjectOrionStringInArgs()
	{
		try {
			$string = new OrionString(new OrionString('new String'));
			$this->assertTrue(isset($string));
			$this->assertEqual($string->value, 'new String');
			$this->assertEqual($string->length, 10);
		} catch(OrionException $e)
		{
			$this->fail();
		}
	}
	
	public function test__MethodLength__WithManyForms()
	{
		try {
			$string1 = new OrionString("T");
			$this->assertEqual($string1->length(), 1);
			$string2 = new OrionString("\x41\x42");
			$this->assertEqual($string2->length(), 2);
			
			$string3 = new OrionString;
			$string3->append($string1);
			$this->assertEqual(1, $string3->length());
		} catch(OrionException $e)
		{
			$this->fail();
		}
	}
	
	public function testIf__MethodChomp__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'chomp'));
	}
	
	public function testIf__MethodChomp__Works()
	{
		try {
			$str = "Uma string com caracteres em branco no final          \n\n\n\t\t\n";
			$string = new OrionString($str);
			$this->assertEqual($string->chomp(), "Uma string com caracteres em branco no final");
			
			$string2 = new OrionString($str);
			$this->assertNotEqual($string2->chomp("\t"), "Uma string com caracteres em branco no final");
			
		} catch(OrionException $e)
		{
			$this->fail();
		}
	}
	
	public function testIf__MethodMatch__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'match'));
	}
	
	public function testIf__MethodMatch__Works()
	{
		$string = new OrionString("Che Guevara");
		$this->assertTrue($string->match('/Guevara$/'));
		$this->assertTrue($string->match('/^Che/'));
		$this->assertTrue($string->match('/^Che\s+/'));
		$this->assertTrue($string->match('/^Che\s+(Guevara)|(Guevaca)$/'));
		$string = new OrionString("tiago_moura@live.com");
		$this->assertTrue($string->match('/[0-9a-zA-Z\_\.\-]*?\@[0-9a-zA-Z]*?\.[0-9a-zA-Z]{3}[0-9a-zA-Z]{0,2}$/'));
		$this->assertFalse($string->match('/\@LIVE.COM/'));
	}
	
	public function testIf__MethodMatchAll__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'matchAll'));
	}
	
	public function testIf__MethodMatchAll__Works()
	{
		$string = new OrionString("abcabcdabceabcf");
		$string->matchAll('/(abcd)|(abcf)/');
		$this->assertEqual(2, $string->countMatchs);
	}
	
	public function testIf__MethodReplaceAll__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'replaceAll'));
	}
	
	public function testIf__MethodReplaceAll__Works()
	{
		$string = new OrionString("Não moro no Brasil, o Tiago Moura.");
		$this->assertEqual($string->replaceAll('/^N\ão/', 'Eu'), 'Eu moro no Brasil, o Tiago Moura.');
		
		$str = 'Os poderosos podem matar uma, duas ou três rosas, mas nunca conseguirão deter a primavera.';
		$string = new OrionString($str);
		$this->assertEqual(
			$string->replaceAll(array('/uma/', '/duas/', '/três/'), array('um milhão', 'dois milhões', 'três milhões de')),
			'Os poderosos podem matar um milhão, dois milhões ou três milhões de rosas, mas nunca conseguirão deter a primavera.');
	}
	
	public function testIf__MethodCharAt__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'charAt'));
	}
	
	public function testIf__MethodCharAt__Works()
	{
		$string = new OrionString("123456789");
		$this->assertEqual('1', $string->charAt(0));
		$this->assertEqual('2', $string->charAt(1));
		$this->assertEqual('3', $string->charAt(2));
		$this->assertEqual('9', $string->charAt(8));
		
		try {
			$this->assertEqual('4', $string->charAt('s'));
			$this->fail();
		} catch(OrionException $e)
		{
			$this->assertEqual($e->getCode(), OrionError::TYPE_STRING);
		}
	}
	
	public function testIf__MethodCharCodeAt__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'charCodeAt'));
	}
	
	public function testIf__MethodCharCodeAt__Works()
	{
		$string = new OrionString("LINUS TORVALDS");
		$this->assertEqual(41, $string->charCodeAt(10));
		$this->assertEqual(43, OrionString::__s("CCC")->charCodeAt(0));
	}
	
	public function testIf__MethodFromCharCode__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'fromCharCode'));
	}
	
	public function testIf__MethodFromCharCode__Works()
	{
		$this->assertEqual(	'AAA', 			OrionString::__s()
											->fromCharCode(65,65,65)
						);
		$this->assertEqual('Tiago Moura',OrionString::__s()->fromCharCode(84,105,97,103,111,32,77,111,117,114,97));
	}
	
	public function testIf__MethodFromCharCodeHex__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'fromCharCodeHex'));
	}
	
	public function testIf__MethodFromCharCodeHex__Works()
	{
		$this->assertEqual('AAA', OrionString::__s()->fromCharCodeHex('0x41','0x41','0x41'));
		$this->assertEqual('Tiago Moura', OrionString::__s()->fromCharCodeHex('0x54','0x69','0x61','0x67','0x6F','0x20','0x4D','0x6F','0x75','0x72','0x61'));
	}
	
	public function testIf__MethodIndexOf__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'indexOf'));
	}
	
	public function testIf__MethodIndexOf__Works()
	{
		$this->assertEqual(5, OrionString::__s("Isto é um teste.")->indexOf("é"));
		
		$string = new OrionString("Portando métodos do Javascript para o PHP ;)");
		$this->assertEqual(0, $string->indexOf("Portando"));
		$this->assertEqual(1, $string->indexOf("ortando"));
		$this->assertEqual(9, $string->indexOf("métodos"));
		$this->assertEqual(44, $string->indexOf(")"));
		$this->assertEqual(9, $string->indexOf("métodos", 2));
	}
	
	public function testIf__MethodToLowerCase__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'toLowerCase'));
	}
	
	public function testIf__MethodToLowerCase__Works()
	{
		$this->assertEqual("tiago moura", OrionString::__s("Tiago Moura")->toLowerCase());
		$upper = OrionString::__s("tEsTaNdO sE eStA fUnFaNdO");
		$lower = $upper->toLowerCase(true);
		$this->assertEqual("testando se esta funfando", $lower);
		$this->assertEqual("testando se esta funfando", $upper->value);
	}
	
	public function testIf__MethodEquals__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'equals'));
	}
	
	public function testIf__MethodEquals__Works()
	{
		$string1 = new OrionString("LINUX TORVALDS");
		$string2 = new OrionString("BILL GATES");
		
		$this->assertNotEqual($string1->value, $string2->value);
		$this->assertFalse($string1->equals($string2));
		
		$string1 = new OrionString("ORION-FRAMEWORK");
		$string2 = new OrionString("ORION-FRAMEWORK");
		$this->assertTrue($string1->equals($string2));
		
		$string1 = "teste";
		$string2 = new OrionString("teste");
		$this->assertTrue($string2->equals($string1));
	}
	
	public function testIf__methodSubstring__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'substring'));
	}
	
	public function testIf__methodSubstring__Works()
	{
		$this->assertEqual('Moura', OrionString::__s("Tiago Moura")->substring(6));
		$this->assertEqual('Moura', OrionString::__s("Tiago Moura")->substring(6,5));
		$this->assertEqual('Mour', OrionString::__s("Tiago Moura")->substring(6,4));
		$this->assertEqual('M', OrionString::__s("Tiago Moura")->substring(6,1));
		$this->assertEqual('Mour', OrionString::__s("Tiago Moura")->substring(6,-1));
		$this->assertEqual('Tiago', OrionString::__s("Tiago Moura")->substring(0,-6));
		try {
			$this->assertEqual('Tiago', OrionString::__s("Tiago Moura")->substring('a',-6));
			$this->fail();
		} catch(OrionException $e)
		{
			$this->pass();
		}
	}
	
	public function testIf__MethodHtmlEntities()
	{
		$this->assertTrue(method_exists('OrionString', 'htmlEntities'));
	}
	
	public function testIf__MethodHtmlEntities__Works()
	{
		$string = new OrionString("<htm><head><title>Teste</title></head><body>Orion test</body></html>");
		$this->assertEqual($string->htmlEntities(), "&lt;htm&gt;&lt;head&gt;&lt;title&gt;Teste&lt;/title&gt;&lt;/head&gt;&lt;body&gt;Orion test&lt;/body&gt;&lt;/html&gt;");
		$this->assertEqual(OrionString::__s("<")->htmlEntities(), "&lt;");
		$this->assertEqual(OrionString::__s("'")->htmlEntities(), "&#039;");
		$this->assertEqual(OrionString::__s('"')->htmlEntities(), "&quot;");
		$this->assertEqual(OrionString::__s('"')->htmlEntities(ENT_NOQUOTES), '"');
		$this->assertEqual(OrionString::__s("'")->htmlEntities(ENT_NOQUOTES), "'");
		$this->assertEqual(OrionString::__s("número")->htmlEntities(ENT_QUOTES), "n&uacute;mero");
		$this->assertNotEqual(OrionString::__s("número")->htmlEntities(ENT_QUOTES, "ISO-8859-1"), "n&uacute;mero");
	}
	
	public function testIf__MethodToBin__Exists()
	{
		$this->assertTrue(method_exists('OrionString', 'toBin'));
	}
	
	public function testIf__MethodToBin__Works()
	{
		$this->assertEqual('01000001', OrionString::__s("A")->toBin());
		$this->assertEqual('01000010', OrionString::__s("B")->toBin());
		$this->assertEqual('0100000101000010', OrionString::__s("AB")->toBin());
		$this->assertEqual(		"0101010101101101001000000111010001100101011110000111010001101111001000000110010101101101001000000110001001101001011011101100001110100001011100100110100101101111001000000011101000101001", 
		OrionString::__s("Um texto em binário :)")->toBin());
	}
}