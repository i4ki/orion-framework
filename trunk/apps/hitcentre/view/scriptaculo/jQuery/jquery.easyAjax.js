/**
 * 	jQuery.easyAjax.js
 *
 * 	Plugin para o framework jQuery para rápidas implementações de ajax,
 * 	jQuery já possue um método muito rápido para requisições ajax,
 * 	mas faz-se necessário configurar cada vez as opções de $.ajax() ou
 * 	$.ajaxSetup(), ajustando o callback para beforeSend, success e complete.
 *
 * 	Utilização:
 * 	$('#target').easyAjax({
 *		url: 'http://www.tiagomoura-design.com.br',
 *		data: 'q=desenvolvimento+web+facil&cat=php+javascript',
 *		type: 'POST'
 *	});
 * 	Dessa forma será realizada uma requisição Ajax na url descrita, um loader
 *  será automaticamente carregado no seletor (no caso '#target'). Após o 
 *  envio da requisição, a resposta do servidor alvo, também será automaticamente
 * 	carregada no seletor. Por default, a resposta sobrescreve o conteudo html do
 * 	seletor (servirá na maioria dos casos), caso necessite que o conteudo seja
 * 	anexado ao final do seletor, ajuste a opção typeResponse para 'append' (veja
 * 	as opções disponíveis no fonte).
 *  Por default, realiza uma requisição em "html", pode-se usar xml ou qualquer outro
 *  marcador, ajuste o callback como desejar.
 *
 * 	Created by Tiago Moura
 * 	tiago_moura@live.com
 */

(function($) {
	$.fn.easyAjax = function(options) {
		var caller 	= this;
		var content_temp;
		var ajax = new Ajax(caller, options);
	}

	/**
	 * Classe principal
	 */
	function Ajax( caller, options ) {

		this.caller = $(caller);

		/**
		* Extende as opções padrões
		*/
		options = jQuery.extend({
			/**
			* Opções do jQuery.ajax()
			*/
			async: true,
			beforeSend: function() {
					if(options.loader == true) {
							
						options.loaderTarget.html('<center><img id="easyajax-loader" src="'+options.imageLoader+'" /></center>');
					}
					if(options.highlightTarget == true) {
						caller.css('border','2px solid #FFEDB0');
					}

					return true;
				},
			cache: false,
			complete: function(XMLHttpRequest, textStatus) {
					// Função chamada quando toda a operação estiver concluída
				},
			contentType: "application/x-www-form-urlencoded; charset=utf8",
			dataType: "html",
			error: function(XMLHttpRequest, textStatus) {
					if(options.showMsgError == true)
						alert(options.msgError+': '+textStatus);
				},
			global: true,
			ifModified: false,
			success: function(resp) {
					options.loaderTarget.html('');
					if(options.typeResponse == 'fill')
						caller.html(resp);
					else
					if(options.typeResponse == 'append') {
						$('#easyajax-loader').hide();
						caller.append(resp);
					}
					else
					if(options.typeResponse == 'prepend') {
						$('#easyajax-loader').hide();
						caller.prepend(resp);
					}
					if(options.highlightTarget === true) {
						caller.css('border', '0');
					}
				},
			type: "POST",
			url: location.href,
			data: "",
			/**
			* Opções do jQuery.easyAjax()
			*/
			loader: true,
			imageLoader: 'http://localhost/hitcentre/View/scriptaculo/jQuery/ajax-loader.gif',
			loaderTarget: caller,
			target: true,
			highlightTarget: false,
			typeResponse: 'fill',
				/**
				 * typeResponse indica como a resposta do
				 * server afetará o seletor:
				 * 'fill' 	=> prenche completamente $().html(),
				 * 'append'	=> anexa a resposta ao final do seletor,
				 * 'prepend'=> anexa a resposta no início do seletor.
				 *  Se usar 'append' ou 'prepend' com loader == true,
				 * o loader também é automaticamente retirado do DOM
				 */					
			showMsgError: false,  /** exibir mensagens de erro em caso de problemas 
									* na requisição. Desaconselhado! */
			msgError: 'Houve um erro na requisição do ajax!'
		}, options);

		this.setAjax = function() {
			$.ajaxSetup(options);
		}

		this.send = function() {
			$.ajax();
			return true;
		}

		this.setAjax();
		this.send();
	}

})(jQuery);