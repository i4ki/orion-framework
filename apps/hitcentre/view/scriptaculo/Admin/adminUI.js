/**
 * Interface
 * By Tiago Moura
 */

var $j = jQuery.noConflict();
	
$j(document).ready(function() {
	$j('.divAddUserError').css('display','none');
	
	if( $j('input#form').val() == 'edituser' )
	{
		$j(".form").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				pass: {
					required: false,
					minlength: 5
				},
				pass_2: {
					required: false,
					minlength: 5,
					equalTo: "#pass"
				},
				email: {
					required: true,
					email: true
				},
				group: {
					required: true
				}
			},
			messages: {
				firstname: "Por favor, insira seu nome.",
				lastname: "Por favor, insira seu sobrenome.",
				pass: {
					minlength: "Sua senha deve ter no mínimo 5 caracteres."
				},
				pass_2: {
					minlength: "Sua senha deve ter no mínimo 5 caracteres.",
					equalTo: "Entre com a mesma senha usada acima."
				},
				email: "Insira um email válido.",
				group: "Selecione um grupo."
			}
		});
	} else {
		$j(".form").validate({
			rules: {
				username: {
					required: true,
					minlength: 3
				},
				firstname: "required",
				lastname: "required",
				pass: {
					required: true,
					minlength: 5
				},
				pass_2: {
					required: true,
					minlength: 5,
					equalTo: "#pass"
				},
				email: {
					required: true,
					email: true
				},
				group: {
					required: true
				}
			},
			messages: {
				firstname: "Por favor, insira seu nome.",
				lastname: "Por favor, insira seu sobrenome.",
				username: {
					required: "Por favor, entre com um nome de usuário.",
					minlength: "O username deve conter no mínimo 3 caracteres."
				},
				pass: {
					required: "Por favor, insira uma senha.",
					minlength: "Sua senha deve ter no mínimo 5 caracteres."
				},
				pass_2: {
					required: "Por favor, confirme a senha.",
					minlength: "Sua senha deve ter no mínimo 5 caracteres.",
					equalTo: "Entre com a mesma senha usada acima."
				},
				email: "Insira um email válido.",
				group: "Selecione um grupo."
			}
		});
	}
	
	$j("#username").focus(function() {
		var firstname = $j("#firstname").val();
		var lastname = $j("#lastname").val();
		if(firstname && lastname && !this.value) {
			this.value = firstname.toLowerCase() + "." + lastname.toLowerCase();
		}
	});
	
	$j('#cep').mask('99999-999');

	
	
	$j('#state_input').hide();
	$j('#city_input').hide();
	$j('#generatepass').click(function() {
		var pass = new String(Math.random()*100000000000000000).substr(0,8);
		$j('#pass').val(pass);
		$j('#pass_2').val(pass);
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
			$j('#loader_'+target).html('<img src="apps/hitcentre/view/Admin/Hitcentre/templates/img/ajax-loader.gif" />');
		}
		Ajax.prototype.error = function(XmlHttpRequest, textStatus) {
			//  populate(why, checked, cond1, cond2, target);	
		}
	}
	//alert('Admin/Manager/Search/'+why+'/'+checked+'-'+cond1+'-'+cond2+'/Name/Select/Ajax/'+target);
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
