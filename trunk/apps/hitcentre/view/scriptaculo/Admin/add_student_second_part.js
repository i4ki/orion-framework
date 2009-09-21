var $j = jQuery.noConflict();
$j(document).ready(function() {
	
	if($j('#student_country_id'))
	{
		populate('country', 76, null,null,'student_country_id');
	}
	if($j('#student_state_id'))
	{
		$j('#student_state_foreign').hide();
		populate('state', 26, null, null, 'student_state_id');
	}
	if($j('#student_city_id'))
	{
		$j('#student_city_foreign').hide();
		populate('city', 9422, 26, null, 'student_city_id');
	}
	
	/**
	 * Validação
	 */

	var validator = 0;
		
	var container = $j('.erros');
	
	jQuery.validator.addMethod("cpf", function(value, element) {
		return isCpf(value);
	}, 'O CPF não é válido.');
		
	var validator = $j(".form").validate({
		errorContainer		: container,
		errorLabelContainer	: $j("ol", container),
		wrapper				: 'li',
		meta				: "validate"
	});
	
	/** mascaras */
	$j('#t_childrens').hide();
	$j('#childrens').hide();
	$j('#student_cpf').mask('999.999.999-99');
	$j('#student_birthday').mask('99/99/9999');
	$j('#date_pay_material').mask('99/99/9999');
	$j('#date_pay_first_monthly').mask('99/99/9999');
	$j('#date_expire').mask('99/99/9999');
	$j('#student_cep').mask('99.999-99');
	
	$j(	'#value_pay_per, #pays_material, #value_total_pay_month, #value_registration').maskMoney({
		symbol: "R$",
		decimal: ',',
		thousands: '.',
		showSymbol: true
	});		
	

});

function togglechildren(value)
{
	if(value == 0)
	{
		$j('#t_childrens').hide();
		$j('#childrens').hide();
	} else
	{
		$j('#t_childrens').show();
		$j('#childrens').show();
	}
	
	return true;
}

function aguarde() {
	alert('Área ainda em construção');
	return false;
}