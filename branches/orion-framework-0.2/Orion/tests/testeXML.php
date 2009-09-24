<?php

$xml = file_get_contents('teste.xml');

preg_match_all("/\<cliente\>(.*?)\<\/cliente\>/s",$xml,$casa);
echo "<pre>";
print_r($casa);


?>