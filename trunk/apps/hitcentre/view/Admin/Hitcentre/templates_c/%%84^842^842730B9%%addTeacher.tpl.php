<?php /* Smarty version 2.6.23, created on 2009-09-06 10:46:56
         compiled from School/addTeacher.tpl */ ?>

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
	
		$j(\'#notbank\').hide();
		
		$j(\'#tel_cel\').mask(\'(99) 9999-9999\');
		$j(\'#tel_res\').mask(\'(99) 9999-9999\');
		$j(\'#cpf\').mask(\'999.999.999-99\');
		
		jQuery.validator.addMethod("cpf", function(value, element) {
			return isCpf(value);
		}, \'O CPF não é válido.\');
		
		container = $j(\'.erros\');
			
		var validator = $j(".form").validate({
			errorContainer		: container,
			errorLabelContainer	: $j("ol", container),
			wrapper				: \'li\',
			meta				: "validate"
		});
		
'; ?>


	<?php if ($this->_tpl_vars['school']['country_id'] != ''): ?>
		populate('country', <?php echo $this->_tpl_vars['school']['country_id']; ?>
, null, null, 'country_id');
	<?php else: ?>
		<?php echo $this->_tpl_vars['school']['country_id']; ?>

		populate('country', <?php echo $this->_tpl_vars['school']['state_id']; ?>
, null, 'state_id');
	<?php endif; ?>

	<?php if ($this->_tpl_vars['school']['country_id'] == 76): ?>
		<?php if ($this->_tpl_vars['school']['state_id'] == ''): ?>
			<?php echo $this->_tpl_vars['school']['state_id']; ?>

		<?php endif; ?>		
	<?php else: ?>
		trocaDom(null, <?php echo $this->_tpl_vars['schooll']['country_id']; ?>
);
	<?php endif; ?>
	populate('state', <?php echo $this->_tpl_vars['school']['state_id']; ?>
, <?php echo $this->_tpl_vars['school']['country_id']; ?>
, null, 'state_id' );
	populate('city', <?php echo $this->_tpl_vars['school']['city_id']; ?>
, <?php echo $this->_tpl_vars['school']['state_id']; ?>
, null, 'city_id');
		
<?php echo '
	});
	
	function aguarde() {
		alert(\'Área ainda em construção\');
		return false;
	}
	
	function addInput( obj, item )
	{
		$j(obj).find(\'img\').hide();
		item++;
		
		$j(\'#language_1\').easyAjax({
			item: item,
			success: function(resp) {
				var langs = resp.getElementsByTagName(\'lang\');
				
				options = \'<option value="">Selecione...</option>\';			
				$j(langs).each(function() {				
					options += \'<option value="\'+this.getAttribute(\'id\')+\'">\'+this.getAttribute(\'name\')+\'</option>\\n\';
				});

				var append = \'<tr>\';
					append += \'<td width="60px"><label for="language_\'+item+\'">Idioma:&nbsp;</label></td>\';
					append += \'<td width="120px"><select name="language_\'+item+\'" id="language_\'+item+\'">\';
					append += options;
					append += \'</select>\\n\';
					append += \'</td>\';
					append += \'<td width="80px"><label for="pronunciation_\'+item+\'">Pronúncia:&nbsp;</label></td>\';
					append += \'<td><input type="text" name="pronunciation_\'+item+\'" id="pronunciation_\'+item+\'" size="10" /></td>\';
					append += \'<td width="100px"><label for="ntredacao_\'+item+\'">Nota redação:&nbsp;</label></td>\';
					append += \'<td><input type="text" name="ntredacao_\'+item+\'" id="ntredacao_\'+item+\'" size="5" /></td>\';
					append += \'<td width="80px"><label for="ntteste_\'+item+\'">Nota teste:&nbsp;</label></td>\';
					append += \'<td><input type="text" name="ntteste_\'+item+\'" id="ntteste_\'+item+\'" size="5" /></td>\';
					append += \'<td><a href="javascript:void(0)" item="\'+item+\'" onclick="addInput(this, this.getAttribute(\\\'item\\\'))"><img src="'; ?>
<?php echo $this->_tpl_vars['pathAdmin']; ?>
<?php echo 'img/icons/add.png" /></a></td>\';
					append += \'</tr>\';
			
				$j(obj).parent().parent().parent().append(append);
			
			},
			contentType: "application/xml; charset=utf-8",
			type: "GET",
			dataType: "xml",
			loader: false,
			url: \'Admin/Manager/School/getLanguages\'
		});
		
	}
	
	function toggleBank( opt )
	{
		if(opt == 0)
		{
			$j(\'#notbank\').hide();
			$j(\'#bank\').show();
		} else {
			$j(\'#notbank\').show();
			$j(\'#bank\').hide();
		}
	}
	
	
</script>
<style typ="text/css" media="all">
#teacher_pro {border:0;}
#teacher_pro td {border:0;}
</style>
'; ?>

</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title"><h2>Hit Centre of Language</h2></title></div>
        	
        	<div id="account" name="account">
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
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/School/Entries/addTeacher.tpl", 'smarty_include_vars' => array()));
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