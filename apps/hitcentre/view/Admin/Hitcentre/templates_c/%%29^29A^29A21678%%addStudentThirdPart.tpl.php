<?php /* Smarty version 2.6.23, created on 2009-09-07 13:48:14
         compiled from School/addStudentThirdPart.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/DatePicker.css" />

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.metadata.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.validate.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI2.js"></script>
<script type="text/javascript">
<?php echo '

var $j = jQuery.noConflict();
$j(document).ready(function() {
	
	if($j(\'#student_country_id\'))
	{
		populate(\'country\', 76, null,null,\'student_country_id\');
	}
	if($j(\'#student_state_id\'))
	{
		$j(\'#student_state_input\').hide();
		populate(\'state\', 26, null, null, \'student_state_id\');
	}
	if($j(\'#student_city_id\'))
	{
		$j(\'#student_city_input\').hide();
		populate(\'city\', 9422, 26, null, \'student_city_id\');
	}
	
	var container = $j(\'.erros\');
					
	jQuery.validator.addMethod("cpf", function(value, element) {
		return isCpf(value);
	}, \'O CPF não é válido.\');
	
	var validator = $j(".form").validate({
		errorContainer		: container,
		errorLabelContainer	: $j("ol", container),
		wrapper				: \'li\',
		meta				: "validate"
	});
	
	$j(\'#t_childrens\').hide();
	$j(\'#childrens\').hide();
	
	$j(\'#date_expire\').mask(\'99/99/9999\');
	$j(\'#date_pay_material\').mask(\'99/99/9999\');
	$j(\'#date_pay_first_monthly\').mask(\'99/99/9999\');
	
	$j(	\'#value_pay_per, #pays_material, #value_total_pay_month, #value_registration\').maskMoney({
		symbol: "R$",
		decimal: \',\',
		thousands: \'.\',
		showSymbol: true
	});		
		
});
	
	function toggleForm( val ) {
		/**
		 * FORM_ENTRY_STUDANT
		 */
		Ajax.prototype.beforeSend = function() {
			$j(\'#form_entry\').html(\'<br><br><br><center><img src="'; ?>
<?php echo $this->_tpl_vars['pathAdmin']; ?>
<?php echo 'img/ajax-loader.gif" /></center>\');
			
		}
		Ajax.prototype.success = function(response) {
			$j(\'#form_entry\').html(response);
			'; ?>

			<?php if ($this->_tpl_vars['school']['country_id'] != ''): ?>
				if(val == 0)	
					populate('country', <?php echo $this->_tpl_vars['school']['country_id']; ?>
,null,null,'country');
				else
					populate('country', <?php echo $this->_tpl_vars['school']['country_id']; ?>
,null,null,'student_country_id');
				
				<?php echo 'if($j(\'#company_state\')) { '; ?>

					populate('country',<?php echo $this->_tpl_vars['school']['country_id']; ?>
,null,null,'company_country');
				}
				<?php echo 'if($j(\'#student_country\')) { '; ?>

					populate('country',<?php echo $this->_tpl_vars['school']['country_id']; ?>
,null,null,'student_country');
				}
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['school']['country_id'] == 76): ?>
				<?php if ($this->_tpl_vars['school']['state_id'] == ''): ?>
					<?php echo $this->_tpl_vars['school']['state_id']; ?>

				<?php endif; ?>		
			<?php else: ?>
				trocaDom(null, <?php echo $this->_tpl_vars['school']['country_id']; ?>
);
			<?php endif; ?>
			
			$j('#city_input')			.hide();
			$j('#state_input')			.hide();
			$j('#student_city_input')	.hide();
			$j('#student_state_input')	.hide();
			
			<?php echo 'if($j(\'#state\')) { '; ?>

				populate('state', <?php echo $this->_tpl_vars['school']['state_id']; ?>
, <?php echo $this->_tpl_vars['school']['country_id']; ?>
);	
			}
			<?php echo 'if($j(\'#company_state\')) { '; ?>

				populate('state',<?php echo $this->_tpl_vars['school']['state_id']; ?>
,null,null,'company_state_id');	
			}
			<?php echo 'if($j(\'#student_state\')) { '; ?>

				populate('state',<?php echo $this->_tpl_vars['school']['state_id']; ?>
,null,null,'student_state_id');	
			}
			<?php echo 'if($j(\'#city\')) { '; ?>

				populate('city', <?php echo $this->_tpl_vars['school']['city_id']; ?>
, <?php echo $this->_tpl_vars['school']['state_id']; ?>
);	
			}
			<?php echo 'if($j(\'#company_city\')) { '; ?>

				populate('city',<?php echo $this->_tpl_vars['school']['city_id']; ?>
,<?php echo $this->_tpl_vars['school']['state_id']; ?>
,null,'company_city_id');	
			}
			<?php echo 'if($j(\'#student_city\')) { '; ?>

				populate('city',<?php echo $this->_tpl_vars['school']['city_id']; ?>
,<?php echo $this->_tpl_vars['school']['state_id']; ?>
,null,'student_city_id');	
			}
			<?php echo '
			getCompany(0);
			
					
		}
		var ajax = new Ajax();
		ajax.send(\'Admin/Manager/School/Entry/Student/toggleForm/\'+val+\'/Ajax\');
	}
	
	function getCompany( id ) {
		id = id != null ? id : 0;
		
		Ajax.prototype.beforeSend = function() {
			$j(\'#company_box\').html(\'<br /><br /><center><img src="'; ?>
<?php echo $this->_tpl_vars['pathAdmin']; ?>
<?php echo 'img/ajax-loader.gif" /></center>\');
		}
		Ajax.prototype.success = function( response ) {
			$j(\'#company_box\').html(response);
			$j(\'#company_city_input\')	.hide();
			$j(\'#company_state_input\')	.hide();				
			
		}
		var ajax = new Ajax();
		ajax.send(\'Admin/Manager/School/Entry/Student/getCompany/\'+id+\'/Ajax\');
	}
	
	function toggleChildren(value)
	{
		if(value == 0)
		{
			$j(\'#t_childrens\').hide();
			$j(\'#childrens\').hide();
		} else
		{
			$j(\'#t_childrens\').show();
			$j(\'#childrens\').show();
		}
		
		return true;
	}
	
	function aguarde() {
		alert(\'Área ainda em construção\');
		return false;
	}
</script>
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
			<?php if ($this->_tpl_vars['resp'] == 0): ?>
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/School/Entries/addStudentThirdPart.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/School/Entries/addStudentNotRespThirdPart.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
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