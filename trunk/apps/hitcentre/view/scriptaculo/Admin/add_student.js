$j = jQuery.noConflict();

$j(document).ready(function() {
	
	toggleResp(1);
	
});
	
	function toggleResp( val ) {
		/**
		 * FORM_ENTRY_STUDANT
		 */
		Ajax.prototype.beforeSend = function() {
			$j('#form_entry').html('<br><br><br><center><img src="<?js:$pathAdmin?>img/ajax-loader.gif" /></center>');
			
		}
		Ajax.prototype.success = function(response) {
			var country_id 	= <?js:$country_id?>;
			var state_id	= <?js:$state_id?>;
			var city_id		= <?js:$city_id?>;
			
			$j('#form_entry').html(response);
			
			populate('country', <?js:$country_id?>,null,null,'student_country_id');
				
			if($j('#company_state')) {
				populate('country',<?js:$country_id?>,null,null,'company_country');
			}
			if($j('#student_country')) {
				populate('country',<?js:$country_id?>,null,null,'student_country');
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
			if($j('#state')) { 
				populate('state', state_id, country_id);	
			}
			if($j('#student_state')) { 
				populate('state',state_id,null,null,'student_state_id');	
			}
			if($j('#city')) { 
				populate('city', city_id, state_id);	
			}
			if($j('#student_city')) { 
				populate('city', city_id, state_id, null, 'student_city_id');	
			}
			
			getCompany(0);
			
					
		}
		var ajax = new Ajax();
		ajax.send('Admin/Manager/School/Entry/Student/toggleResp/'+val+'/Ajax');
	}
	
	function getCompany( id ) {
		id = id != null ? id : 0;
		
		Ajax.prototype.beforeSend = function() {
			$j('#company_box').html('<br /><br /><center><img src="<?js:$pathAdmin?>img/ajax-loader.gif" /></center>');
		}
		Ajax.prototype.success = function( response ) {
			$j('#company_box').html(response);
			$j('#company_city_input')	.hide();
			$j('#company_state_input')	.hide();			
			
			if(id == 0)
			{
				populate('country',76,null,null, 'company_country_id');
				populate('state', 26, null,null, 'company_state_id');
				populate('city',9422,26,null, 'company_city_id');
			}
			
			
		}
		var ajax = new Ajax();
		ajax.send('Admin/Manager/School/Entry/Student/getCompany/'+id+'/Ajax');
	}
	
	function aguarde() {
		alert('Área ainda em construção');
		return false;
	}