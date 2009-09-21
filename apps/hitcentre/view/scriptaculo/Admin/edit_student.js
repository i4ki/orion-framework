var $j = jQuery.noConflict();

$j(document).ready(function() {
	$j('#cpf').mask('999.999.999-99');
	$j('#tel_res').mask('(99) 9999-9999');
	$j('#tel_cel').mask('(99) 9999-9999');
	$j('#birthday').mask('99/99/9999');
	$j('#cep').mask('99.999-999');
});