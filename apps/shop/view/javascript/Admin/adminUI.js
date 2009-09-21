/**
 * Interface
 * By Tiago Moura
 */

$j = jQuery.noConflict();
	
$j(document).ready(function() {
	$j('#state_input').hide();
	$j('#city_input').hide();
	$j('#generatepass').click(function() {
		alert('Protótipo :: Aguarde a versão final');
		$j(this).removeAttr('checked');
	});
	$j('.seePerfil').hide();
});

function populate( why, checked, cond1, cond2, target ) {
	
	checked 	= (checked 	!= null)?checked	:'null';
	cond1 		= (cond1 	!= null)?cond1		:'null';
	cond2 		= (cond2 	!= null)?cond2		:'null';
	target 		= (target 	!= null)?target		: why;
	
	if (why != '') {
		Ajax.prototype.success = function( response ) {
			
			$j('#loader_'+target).html('');
			$j('#'+target).html(response);
		}
		Ajax.prototype.beforeSend = function() {
			$j('#loader_'+target).html('<img src="View/Admin/Hitcentre/templates/img/ajax-loader.gif" />');
		}
	}
		
	var ajax = new Ajax('Admin/Manager/Search/'+why+'/'+checked+'-'+cond1+'-'+cond2+'/Name/Select/Ajax');
	ajax.send();
}
function trocaDom( obj, id, alias ) {
	alias = (alias != null) ? alias+'_' : '';
	
	if( id != 76 ) {
		$j('#'+alias+'state').hide();
		$j('#'+alias+'state_input').show();
		$j('#'+alias+'city').hide();
		$j('#'+alias+'city_input').show();
	} else {
		$j('#'+alias+'state_input').hide();
		$j('#'+alias+'state').show();
		$j('#'+alias+'city_input').hide();
		$j('#'+alias+'city').show();
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
