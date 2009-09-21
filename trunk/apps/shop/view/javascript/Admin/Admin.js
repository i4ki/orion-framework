/**
 * @author Tiago Natel de Moura
 * 
 */

var layout;

$(document).ready( function() {

	layout = $('body').layout( {
		applyDefaultStyles : false,
		north__togglerLength_open : 30,
		north__size : 100,
		east__togglerLength_open : 50,
		east__size : 200,
		west__togglerLength_open : 50,
		west__size : 230,
		south__togglerLength_open : 50,
		south__size : 100
	});

	//layout.allowOverflow('.ui-layout-center');

	var menu = $('#menu').menu( {
		content : $('#menu').next().html(),
		backLink : false,
		ajaxRequest : true,
		ajaxCallback : ajaxCallback
	});

	function ajaxCallback(item) {
		$('.ui-layout-center').easyAjax({
			url: item.href,
			loader: true,
			highlightTarget: true
		});
	}

	// BOTÕES
	$('.fg-button').hover(function() {
		$(this).removeClass('ui-state-default').addClass('ui-state-focus');
	}, function(){
		$(this).removeClass('ui-state-focus').addClass('ui-state-default');
	});
	
});
