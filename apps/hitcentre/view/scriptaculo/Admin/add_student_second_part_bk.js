	$j = jQuery.noConflict();
$j(document).ready(function() {
	
	if($j('#student_country_id'))
	{
		populate('country', 76, null,null,'student_country_id');
	}
	if($j('#student_state_id'))
	{
		$j('#student_state_input').hide();
		populate('state', 26, null, null, 'student_state_id');
	}
	if($j('#student_city_id'))
	{
		$j('#student_city_input').hide();
		populate('city', 9422, 26, null, 'student_city_id');
	}
	
});
	

function aguarde() {
	alert('Área ainda em construção');
	return false;
}