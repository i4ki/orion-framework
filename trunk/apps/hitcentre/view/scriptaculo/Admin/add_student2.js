var $j = jQuery.noConflict();

$j(document).ready(function() {
	toggleResp(1);
	
});
	
	function toggleResp( val ) {
		/**
		 * FORM_ENTRY_STUDANT
		 */
		
		$j('.erros').css('display', 'none');
		
		$j('#form_entry').easyAjax(
		{
			complete : function()
				{
					var country_id 	= <?js:$country_id?>;
					var state_id	= <?js:$state_id?>;
					var city_id		= <?js:$city_id?>;
					
					if($j('#student_country_id').length > 0)
						populate('country', country_id,null,null,'student_country_id');
				
					if($j('#student_country').length > 0) 
					{
						populate('country',country_id,null,null,'student_country');
					}
					
					if( country_id == 76 )
					{
						if( state_id == '' )
							state_id = 26;
					} else
						trocaDom(null, country_id);
								
					$j('#city_foreign').hide();
					$j('#state_foreign').hide();
					$j('#student_city_foreign').hide();
					$j('#student_state_foreign').hide();
					
					if($j('#country').length > 0)
					{
						populate('country', country_id);
					}
					if($j('#country_id').length > 0)
					{
						populate('country', country_id, null, null, 'country_id');
					}
					if($j('#state').length > 0) 
					{ 
						populate('state', state_id, country_id);	
					}
					if($j('#state_id').length > 0) 
					{ 
						populate('state', state_id, country_id, null, 'state_id');	
					}
					if($j('#student_state').length > 0) 
					{ 
						populate('state',state_id,null,null,'student_state_id');	
					}
					if($j('#student_state_id').length > 0) 
					{ 
						populate('state',state_id,null,null,'student_state_id');	
					}
					if($j('#city').length > 0) 
					{ 
						populate('city', city_id, state_id);	
					}
					if($j('#city_id').length > 0) 
					{ 
						populate('city', city_id, state_id, null, 'city_id');	
					}
					if($j('#student_city').length > 0) 
					{ 
						populate('city', city_id, state_id, null, 'student_city_id');
					}
					if($j('#student_city_id').length > 0) 
					{ 
						populate('city', city_id, state_id, null, 'student_city_id');
					}
					
					setNrContract();
					
					getCompany(0);
					
					var date = new Date();
					var day = date.getDate();
					var month = date.getMonth()+1;
					var year = date.getFullYear();
					if(day < 10) day = '0'+day;
					if(month < 10) month = '0'+month;
					$j('#date_contract').val(day+'/'+month+'/'+year);
					
					/**
					 * Validação de campos
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
					
					
					if( $j('#date_contract').length > 0 )
						$j('#date_contract').mask('99/99/9999');
					if( $j('#student_birthday').length > 0 )
						$j('#student_birthday').mask('99/99/9999');
					if( $j('#resp_birthday').length > 0 )
						$j('#resp_birthday').mask('99/99/9999');
					if( $j('#cep').length > 0 )
						$j('#cep').mask('99.999-999');
					if( $j('#student_cep').length > 0 )
						$j('#student_cep').mask('99.999-999');
					if( $j('#resp_cep').length > 0 )
						$j('#resp_cep').mask('99.999-999');
					if( $j('#zip').length > 0 )
						$j('#zip').mask('99.999-999');
					if( $j('#cnpj').length > 0 )
						$j('#cnpj').mask('999.999.999/9999-99');
					if( $j('#company_cnpj').length > 0 )
						$j('#company_cnpj').mask('999.999.999/9999-99');
					if( $j('#student_cpf').length > 0 )
						$j('#student_cpf').mask('999.999.999-99');
					if( $j('#resp_cpf').length > 0 )
						$j('#resp_cpf').mask('999.999.999-99');
					if( $j('#resp_tel_res').length > 0 )
						$j('#resp_tel_res').mask('(99) 9999-9999');
					if( $j('#resp_tel_cel').length > 0 )
						$j('#resp_tel_cel').mask('(99) 9999-9999');
					if( $j('#student_tel_res').length > 0 )
						$j('#student_tel_res').mask('(99) 9999-9999');
					if( $j('#student_tel_cel').length > 0 )
						$j('#student_tel_cel').mask('(99) 9999-9999');
					
					if( $j('#company_id').length > 0 )
						$j('#company_id').easyAjax({
							url: 'Admin/Manager/getCompanies',
							loader: false
						});
					
					if( val == 1 )
					{
						$j('label.notresp').removeClass('error').parent().hide();
						$j('label.resp').addClass('error').parent().show();
					} else {
						$j('label.resp').removeClass('error').parent().hide();
						$j('label.notresp').addClass('error').parent().show();
					}

				},
			url : 'Admin/Manager/School/Entry/Student/toggleResp/'+val+'/Ajax',
			imageLoader: 'http://localhost/Orion/apps/hitcentre/view/scriptaculo/jQuery/ajax-loader.gif'
		});
		
		
	}
	
	function getCompany( id ) 
	{		
		id = id != null ? id : 0;
		
		$j('#company_box').easyAjax({
			complete : function() {
				$j('#company_city_foreign').hide();
				$j('#company_state_foreign').hide();
				
				if(id == 0)
				{
					populate('country',76,null,null, 'company_country_id');
					populate('state', 26, null,null, 'company_state_id');
					populate('city',9422,26,null, 'company_city_id');
				}
				if( $j('#company_cep').length > 0 )
					$j('#company_cep').mask('99.999-999');
			},
			url : 'Admin/Manager/School/Entry/Student/getCompany/'+id+'/Ajax'
		});
		
		if( id != 0 )
		{
			// popula o país
			$j('#company_country_id').easyAjax({
				success: function(response) {
					populate('country', parseInt(response), null, null, 'company_country_id');
					if( parseInt(response) != 76 )
						trocaDom(null, parseInt(response), 'company');
				},
				url: 'Admin/Manager/getCompanies/'+id+'/country_id'
			});
			// popula o estado e a cidade
			$j('#company_state_id').easyAjax({
				success: function(response) {
					if($j('#company_state_id:visible').length > 0)
					{
						populate('state', parseInt(response), null, null, 'company_state_id');
						// popula a cidade
						$j('#company_city_id').easyAjax({
							success: function(resp) {
								populate('city', parseInt(resp), parseInt(response), null, 'company_city_id');
							},
							url: 'Admin/Manager/getCompanies/'+id+'/city_id'
						});
					} else {
						$j('#company_state_foreign').val(response);
						
						$j('#company_city_foreign').easyAjax({
							success: function(resp) {
								$j('#company_city_foreign').val(resp);
							},
							url: 'Admin/Manager/getCompanies/'+id+'/city_id'
						});
					}
						
				},
				url: 'Admin/Manager/getCompanies/'+id+'/state_id',
				loader: false
			});
		}
	}
	
	function setNrContract()
	{
		var n = '<?js:$nr_contract?>';
		$j('#nr_contract').val(n);
		$j('#nr_contrato').html(n);
		return n;
	}
	
	function aguarde() {      
		alert('Área ainda em construção');
		return false;
	}