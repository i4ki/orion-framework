var $j = jQuery.noConflict();

$j(document).ready(function() {
	// esconde o segundo nível
	$j('#sidebar li.l2 ul').hide();
	// esconde o primeiro nível
	$j('#sidebar li.l1 ul').hide();
	// evento para o primeiro nível
	
	$j('#sidebar li.l1').find('a:eq(0)').toggle( 
		function() {
			$j(this).parent().parent().find('ul:eq(0)').slideDown(100);
		},
		function() {
			$j(this).parent().parent().find('ul:eq(0)').slideUp(100);
		}
	);
	// evento para o segundo nível
	$j('#sidebar li.l2').find('a:eq(0)').toggle(
		function() {
			$j(this).parent().find('ul').slideDown(100);
		},
		function() {
			$j(this).parent().find('ul').slideUp(100);
		}
	);
	
	/**
	 * TOP PANEL
	 */
	$j('#panel a.item').parent().hide();
	// evento
	$j('#panel a.topmenu').toggle( 
		function() {
			$j(this).parent().find('a.item').parent().fadeIn(500);
		},
		function() {
			$j(this).parent().find('a.item').parent().fadeOut(500);
		}
	);
	
	
});