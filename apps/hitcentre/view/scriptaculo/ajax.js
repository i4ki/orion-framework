/**
 * Classe Ajax
 * ##############################################
 * #  Esta classe não trabalha independemente,  #
 * #  ela utiliza o framework jQuery            #
 * ##############################################
 *
 * Created by Tiago Moura
 */
 var $j = jQuery.noConflict();


 function Ajax( url ) {
 	this.url = url;

 	this.url = (url != null) ? url : 'Admin/Manager';
 	this.setAjax = function() {

	 		$j.ajaxSetup({
	 			async: true,
	 			beforeSend: this.beforeSend,
	 			cache: false,
	 			complete: function(XMLHttpRequest, textStatus) {
	 					// Função chamada quando toda a operação estiver concluída
	 				},
	 			contentType: "application/x-www-form-urlencoded; charset=utf8",
	 			dataType: "html",
	 			error: this.error,
	 			global: true,
	 			ifModified: false,
	 			success: this.success,
	 			type: "POST",
	 			url: this.url
	 		});
	 }
	this.send = function( url, data ) {
		data = data != null ? data : '';
		
 		this.url = (url != null) ? url : this.url;
		
 		$j.ajax({
 			url: this.url,
 			data: data
 		});
 		return true;
 	}

	// Outro método construtor
 	this.setAjax();
 }

 Ajax.prototype.beforeSend = function() {
 		// Setar aqui o comportamento padrão
 		return true;
 }

 Ajax.prototype.error = function(XMLHttpRequest, textStatus) {
 	// erro
 }

 Ajax.prototype.success = function(msg) {
 	// Evento se ao processo foi corretamente concluído
 		alert(msg);
 }
