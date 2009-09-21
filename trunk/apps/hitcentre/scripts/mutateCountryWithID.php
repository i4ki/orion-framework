<?php

$fp = fopen("../database/fixtures/data_models/country.yml", 'r');

$str = "";

while(!feof($fp))
	$str .= fgets($fp, 1024);
	
$arr = explode("\n", $str);

for($i=0;$i<count($arr);$i++)
{
	if( preg_match('/\s+Country\_(\d+):/', $arr[$i], $match1) )
		if( !preg_match('/\s+id\:\s(\d+)$/', $arr[$i+1], $match2) )
		{
			$newarr1 = array_slice($arr, 0, $i+1);
			if(isset($arr[$i+2]))
				$newarr2 = array_slice($arr, $i+1);
			
			$newarr1[] = "    id: ".$match1[1];
			$arr = array_merge($newarr1, $newarr2);			
		}
}

$str = "";
$str = implode("\n", $arr);
$fp = fopen("../database/fixtures/data_models/country2.yml", "w");
if(!$fp)
	die("não pode abrir arquivo");
fwrite($fp, $str);
fclose($fp);