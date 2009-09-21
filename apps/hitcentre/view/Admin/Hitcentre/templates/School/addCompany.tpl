{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI2.js"></script>

<script type="text/javascript">
{literal}

	$j = jQuery.noConflict();
	$j(document).ready(function() {
	
	$j('#state_foreign, #city_foreign').hide();
	populate('country', 76, null, null, 'country_id');
	populate('state', 26, null, null, 'state_id');
	populate('city', 9422, 26, null, 'city_id');
	
	jQuery.validator.addMethod("cnpj", function(value, element) {
		return isCnpj(value);
	}, 'O CNPJ não é válido.');
	
	
	$j('.form').validate({
		rules: {
			name_company: "required",
			cnpj: {
				required: true,
				cnpj: true
			},
			email_contact:"required",
			email_finance: "required"
		},
		messages: {
			name_company: "Por favor, insira o nome da empresa.",
			cnpj: "CNPJ inválido.",
			email_contact: "O email não é válido.",
			email_finance: "O email não é válido."
		}
	});
	
	$j('#cnpj').mask('99.999.999/9999-99');
	$j('#tel').mask('(99) 9999-9999');
	$j('#tel_fax').mask('(99) 9999-9999');
	
	});
	
	function aguarde() {
		alert('Área ainda em construção');
		return false;
	}
</script>
<style type="text/css" media="all">
	table.tbgerais td.label {width:80px;}
	form.form label.error {width:230px;float:right;text-align:left;}
</style>
{/literal}
</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title">
        		<h2>{$header}</h2>
        	</div>
        	<div id="account">
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
            	{include file="actions/School/Entries/addCompany.tpl"}
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

