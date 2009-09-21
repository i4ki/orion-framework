{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI2.js"></script>
<script type="text/javascript">     
{literal}

	$j = jQuery.noConflict();
	$j(document).ready(function() {
	
		$j('#notbank').hide();
		
		$j('#tel_cel').mask('(99) 9999-9999');
		$j('#tel_res').mask('(99) 9999-9999');
		$j('#cpf').mask('999.999.999-99');
		
		jQuery.validator.addMethod("cpf", function(value, element) {
			return isCpf(value);
		}, 'O CPF não é válido.');
		
		container = $j('.erros');
			
		var validator = $j(".form").validate({
			errorContainer		: container,
			errorLabelContainer	: $j("ol", container),
			wrapper				: 'li',
			meta				: "validate"
		});
		
{/literal}

	{if $school.country_id != ''}
		populate('country', {$school.country_id}, null, null, 'country_id');
	{else}
		{$school.country_id = 76}
		populate('country', {$school.state_id}, null, 'state_id');
	{/if}

	{if $school.country_id == 76}
		{if $school.state_id == ''}
			{$school.state_id = 26}
		{/if}		
	{else}
		trocaDom(null, {$schooll.country_id});
	{/if}
	populate('state', {$school.state_id}, {$school.country_id}, null, 'state_id' );
	populate('city', {$school.city_id}, {$school.state_id}, null, 'city_id');
		
{literal}
	});
	
	function aguarde() {
		alert('Área ainda em construção');
		return false;
	}
	
	function addInput( obj, item )
	{
		$j(obj).find('img').hide();
		item++;
		
		$j('#language_1').easyAjax({
			item: item,
			success: function(resp) {
				var langs = resp.getElementsByTagName('lang');
				
				options = '<option value="">Selecione...</option>';			
				$j(langs).each(function() {				
					options += '<option value="'+this.getAttribute('id')+'">'+this.getAttribute('name')+'</option>\n';
				});

				var append = '<tr>';
					append += '<td width="60px"><label for="language_'+item+'">Idioma:&nbsp;</label></td>';
					append += '<td width="120px"><select name="language_'+item+'" id="language_'+item+'">';
					append += options;
					append += '</select>\n';
					append += '</td>';
					append += '<td width="80px"><label for="pronunciation_'+item+'">Pronúncia:&nbsp;</label></td>';
					append += '<td><input type="text" name="pronunciation_'+item+'" id="pronunciation_'+item+'" size="10" /></td>';
					append += '<td width="100px"><label for="ntredacao_'+item+'">Nota redação:&nbsp;</label></td>';
					append += '<td><input type="text" name="ntredacao_'+item+'" id="ntredacao_'+item+'" size="5" /></td>';
					append += '<td width="80px"><label for="ntteste_'+item+'">Nota teste:&nbsp;</label></td>';
					append += '<td><input type="text" name="ntteste_'+item+'" id="ntteste_'+item+'" size="5" /></td>';
					append += '<td><a href="javascript:void(0)" item="'+item+'" onclick="addInput(this, this.getAttribute(\'item\'))"><img src="{/literal}{$pathAdmin}{literal}img/icons/add.png" /></a></td>';
					append += '</tr>';
			
				$j(obj).parent().parent().parent().append(append);
			
			},
			contentType: "application/xml; charset=utf-8",
			type: "GET",
			dataType: "xml",
			loader: false,
			url: 'Admin/Manager/School/getLanguages'
		});
		
	}
	
	function toggleBank( opt )
	{
		if(opt == 0)
		{
			$j('#notbank').hide();
			$j('#bank').show();
		} else {
			$j('#notbank').show();
			$j('#bank').hide();
		}
	}
	
	
</script>
<style typ="text/css" media="all">
#teacher_pro {border:0;}
#teacher_pro td {border:0;}
</style>
{/literal}
</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title"><h2>Hit Centre of Language</h2></title></div>
        	
        	<div id="account" name="account">
        	{include file="includes/account.tpl"}
        	</div>
			<div class="clear"></div>
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
            	{include file="actions/School/Entries/addTeacher.tpl"}
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