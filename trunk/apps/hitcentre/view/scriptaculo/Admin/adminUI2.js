/**
 * Interface
 * By Tiago Moura
 */

var $j = jQuery.noConflict();
	
$j(document).ready(function() {
	$j('#state_foreign').hide();
	$j('#student_state_foreign').hide();
	$j('#city_foreign').hide();
	$j('#student_city_id').hide();
	
	$j('.seePerfil').hide();
	
	if( $j('#student_tel_res').length > 0 )
		$j('#student_tel_res').mask('(99) 9999-9999');
	if( $j('#student_tel_cel').length > 0 )
		$j('#student_tel_cel').mask('(99) 9999-9999');
});

function populate( why, checked, cond1, cond2, target ) {
	
	checked 	= (checked 	!= null)?checked	:'null';
	cond1 		= (cond1 	!= null)?cond1		:'null';
	cond2 		= (cond2 	!= null)?cond2		:'null';
	target 		= (target 	!= null)?target		: why;
	
	if (why != '') {
		$j('#'+target).easyAjax({
			loaderTarget: $j('#loader_'+target),
			url: 'Admin/Manager/Search/'+why+'/'+checked+'-'+cond1+'-'+cond2+'/Name/Select/Ajax'
		});
	}
}
function trocaDom( obj, id, alias ) {
	alias = (alias != null) ? alias+'_' : '';

	if( id != 76 ) {
		$j('#'+alias+'state_id').hide();
		$j('#'+alias+'state_foreign').show();
		$j('#'+alias+'city_id').hide();
		$j('#'+alias+'city_foreign').show();
	} else {
		$j('#'+alias+'state_foreign').hide();
		$j('#'+alias+'state_id').show();
		$j('#'+alias+'city_foreign').hide();
		$j('#'+alias+'city_id').show();
		if(alias == '')	populate('state', 76);
		else populate('state', 76,alias+'_state');
	}
}

function aguarde() {
	alert('Área ainda em construção');
	return false;
}

/**
 * Evento de visualização de detalhes do usuário
 */
function seePerfil( obj, id ) {
	// obj == Elem DOM a
	$j(obj).parent()
	// td
	.parent()
	// tr
	.next().fadeIn(1000);
}

function closePerfil( obj, id) {
	$j(obj).parent().next().fadeOut(1000);
}
