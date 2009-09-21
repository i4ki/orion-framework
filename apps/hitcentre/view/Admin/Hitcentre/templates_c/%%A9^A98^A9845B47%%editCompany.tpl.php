<?php /* Smarty version 2.6.23, created on 2009-09-06 10:39:43
         compiled from School/editCompany.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI2.js"></script>

<script type="text/javascript">
<?php echo '

	$j = jQuery.noConflict();
	$j(document).ready(function() {
	
	$j(\'#state_foreign, #city_foreign\').hide();
	populate(\'country\', 76, null, null, \'country_id\');
	populate(\'state\', 26, null, null, \'state_id\');
	populate(\'city\', 9422, 26, null, \'city_id\');
	
	jQuery.validator.addMethod("cnpj", function(value, element) {
		return isCnpj(value);
	}, \'O CNPJ não é válido.\');
	
	
	$j(\'.form\').validate({
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
	
	$j(\'#cnpj\').mask(\'99.999.999/9999-99\');
	$j(\'#tel\').mask(\'(99) 9999-9999\');
	$j(\'#tel_fax\').mask(\'(99) 9999-9999\');
	
	});
	
	function aguarde() {
		alert(\'Área ainda em construção\');
		return false;
	}
</script>
<style type="text/css" media="all">
	table.tbgerais td.label {width:80px;}
	form.form label.error {width:230px;float:right;text-align:left;}
</style>
'; ?>

</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title">
        		<h2><?php echo $this->_tpl_vars['header']; ?>
</h2>
        	</div>
        	<div id="account">
        		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/account.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        	</div>
			<div class="clear"></div>
			<div id="topmenu">
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/topmenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          	</div>
      	</div>
		
        <div id="top-panel">
            <div id="panel">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/panel.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
      </div>
        <div id="wrapper">
            <div id="content">
            <div id="box" name="box">
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/School/editCompany.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            </div>
            </div>
            <div id="sidebar">
  				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/sidebar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
