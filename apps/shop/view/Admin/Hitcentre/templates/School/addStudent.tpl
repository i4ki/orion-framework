{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="View/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="View/scriptaculo/Admin/adminUI.js"></script>
<script type="text/javascript">
{literal}

	$j = jQuery.noConflict();
	$j(document).ready(function() {
	
	
{/literal}

	{if $school.country_id != ''}
		populate('country', {$school.country_id});
	{else}
		{$school.country_id = 76}
		populate('country', {$school.country_id});
	{/if}

	{if $school.country_id == 76}
		{if $school.state_id == ''}
			{$school.state_id = 26}
		{/if}		
	{else}
		trocaDom(null, {$school.country_id});
	{/if}
	populate('state', {$school.state_id}, {$school.country_id});
	populate('city', {$school.city_id}, {$school.state_id});
{literal}
	
	toggleResp(0);
		
		
	});
	
	function toggleResp( val ) {
		/**
		 * FORM_ENTRY_STUDANT
		 */
		Ajax.prototype.beforeSend = function() {
			$j('#form_entry').html('<br><br><br><center><img src="{/literal}{$pathAdmin}{literal}img/ajax-loader.gif" /></center>');
			
		}
		Ajax.prototype.success = function(response) {
			$j('#form_entry').html(response);
			{/literal}
			{if $school.country_id != ''}
				populate('country', {$school.country_id},null,null,'student_country_id');
				
				{literal}if($j('#company_state')) { {/literal}
					populate('country',{$school.country_id},null,null,'company_country');
				}
				{literal}if($j('#student_country')) { {/literal}
					populate('country',{$school.country_id},null,null,'student_country');
				}
			{/if}
		
			{if $school.country_id == 76}
				{if $school.state_id == ''}
					{$school.state_id = 26}
				{/if}		
			{else}
				trocaDom(null, {$school.country_id});
			{/if}
			
			$j('#city_input')			.hide();
			$j('#state_input')			.hide();
			$j('#student_city_input')	.hide();
			$j('#student_state_input')	.hide();
			
			{literal}if($j('#state')) { {/literal}
				populate('state', {$school.state_id}, {$school.country_id});	
			}
			{literal}if($j('#company_state')) { {/literal}
				populate('state',{$school.state_id},null,null,'company_state_id');	
			}
			{literal}if($j('#student_state')) { {/literal}
				populate('state',{$school.state_id},null,null,'student_state_id');	
			}
			{literal}if($j('#city')) { {/literal}
				populate('city', {$school.city_id}, {$school.state_id});	
			}
			{literal}if($j('#company_city')) { {/literal}
				populate('city',{$school.city_id},{$school.state_id},null,'company_city_id');	
			}
			{literal}if($j('#student_city')) { {/literal}
				populate('city',{$school.city_id},{$school.state_id},null,'student_city_id');	
			}
			{literal}
			getCompany(0);
			
					
		}
		var ajax = new Ajax();
		ajax.send('Admin/Manager/School/Entry/Student/toggleResp/'+val+'/Ajax');
	}
	
	function getCompany( id ) {
		id = id != null ? id : 0;
		
		Ajax.prototype.beforeSend = function() {
			$j('#company_box').html('<br /><br /><center><img src="{/literal}{$pathAdmin}{literal}img/ajax-loader.gif" /></center>');
		}
		Ajax.prototype.success = function( response ) {
			$j('#company_box').html(response);
			$j('#company_city_input')	.hide();
			$j('#company_state_input')	.hide();				
			
		}
		var ajax = new Ajax();
		ajax.send('Admin/Manager/School/Entry/Student/getCompany/'+id+'/Ajax');
	}
	
	function aguarde() {
		alert('Área ainda em construção');
		return false;
	}
</script>
{/literal}
</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title"><h2>Hit Centre of Language</h2></title></div>
        	
        	<div id="account" name="account">
        	{include file="includes/account.tpl"}
        	</div>
    	<div id="topmenu">
        	{include file="includes/topmenu.tpl"}
        </div>
      </div>
        <div id="top-panel">
            <div id="panel">
                {include file="includes/panel.tpl"}
            </div>
      </div>
        <div id="wrapper">
            <div id="content">
            <div id="box" name="box">
            {if $param == "second_part"}
            	{include file="actions/School/Entries/addStudentSecondPart.tpl"}
            {else}
            	{include file="actions/School/Entries/addStudent.tpl"}
            {/if}
            </div>
            </div>
            </div>
            <div id="sidebar">
  				{include file="includes/sidebar.tpl"}
          </div>
      </div>
        <div id="footer">
        <div id="credits">

        </div>
        <div id="styleswitcher">
            <ul>
                <li><a href="javascript: document.cookie='theme='; window.location.reload();" title="Default" id="blueswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=1'; window.location.reload();" title="Blue" id="defswitch">d</a></li>
                <li><a href="javascript: document.cookie='theme=2'; window.location.reload();" title="Green" id="greenswitch">g</a></li>
                <li><a href="javascript: document.cookie='theme=3'; window.location.reload();" title="Brown" id="brownswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=4'; window.location.reload();" title="Mix" id="mixswitch">m</a></li>
            </ul>
        </div><br />

        </div>
</div>
</body>
</html>