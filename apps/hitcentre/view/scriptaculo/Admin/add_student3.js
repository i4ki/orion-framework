var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	toggleResp(1);
	
});
	countries 	= '';
	states 		= '';
	cities		= '';
	
	function loadCountries( elem )
	{
		$j('#'+target).easyAjax({
			loaderTarget: $j('#loader_'+target),
			url: 'Admin/Manager/Search/'+why+'/'+checked+'-'+cond1+'-'+cond2+'/Name/Select/Ajax'
		});i
	}
	
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
					
					populate('country', country_id,null,null,'student_country_id');
				
					if($j('#company_state')) 
					{
						populate('country',country_id,null,null,'company_country');
					}
					if($j('#student_country')) 
					{
						populate('country',country_id,null,null,'student_country');
					}
					
					if( country_id == 76 )
					{
						if( state_id == '' )
							state_id = 26;
					} else
						trocaDom(null, country_id);
								
					$j('#city_input').hide();
					$j('#state_input').hide();
					$j('#student_city_input').hide();
					$j('#student_state_input').hide();
					
					if($j('#country'))
					{
						populate('country', country_id);
					}
					if($j('#state')) 
					{ 
						populate('state', state_id, country_id);	
					}
					if($j('#student_state')) 
					{ 
						populate('state',state_id,null,null,'student_state_id');	
					}
					if($j('#city')) 
					{ 
						populate('city', city_id, state_id);	
					}
					if($j('#student_city')) 
					{ 
						populate('city', city_id, state_id, null, 'student_city_id');
					}
					
					setNrContract();
					
					getCompany(0);					
					
					/**
					 * Validação de campos
					 */
					 var validator = 0;
					 
					var container = $j('.erros');
						
					var validator = $j(".form").validate({
						errorContainer		: container,
						errorLabelContainer	: $j("ol", container),
						wrapper				: 'li',
						meta				: "validate"
					});
					
					/**
					 * DatePicker's
					 */
					$j('#date_contract').datePicker({
						clickInput	: true,
						createButton: false
					});
					
					if( $j('#student_birthday') )
						$j('#student_birthday').datePicker({clickInput:true, createButton: false});
					
					if( $j('#resp_birthday') )
						$j('#resp_birthday').datePicker({clickInput:true, createButton: false});

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
				$j('#company_city_input')	.hide();
				$j('#company_state_input')	.hide();
				
				if(id == 0)
				{
					populate('country',76,null,null, 'company_country_id');
					populate('state', 26, null,null, 'company_state_id');
					populate('city',9422,26,null, 'company_city_id');
				}			
			},
			url : 'Admin/Manager/School/Entry/Student/getCompany/'+id+'/Ajax'
		});
	}
	
	function setNrContract()
	{
		var n = '<?js:$nr_contract?>';
		$j('#nr_contract').value = n;
		$j('#nr_contrato').html(n);
		return n;
	}
	
	function aguarde() {
		alert('Área ainda em construção');
		return false;
	}