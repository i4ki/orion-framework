<?php /* Smarty version 2.6.23, created on 2009-09-20 04:23:08
         compiled from users.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI.js"></script>

<script type="text/javascript">
<?php echo '

	$j = jQuery.noConflict();
	$j(document).ready(function() {
'; ?>

		<?php if ($this->_tpl_vars['url'] == "Admin/Users/EditUser"): ?>
			populate('country', <?php echo $this->_tpl_vars['user']['country_id']; ?>
);
			<?php if ($this->_tpl_vars['user']['country_id'] == 76): ?>
			populate('state', <?php echo $this->_tpl_vars['user']['state_id']; ?>
, 76);
			populate('city', <?php echo $this->_tpl_vars['user']['city_id']; ?>
, <?php echo $this->_tpl_vars['user']['state_id']; ?>
);
			<?php else: ?>
			trocaDom(null, <?php echo $this->_tpl_vars['user']['country_id']; ?>
);
			<?php endif; ?>
		<?php else: ?>	
			populate('country', 76);
			populate('state',null, 76);
			populate('city', null, 26);
		<?php endif; ?>
<?php echo '
	});
</script>
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
                <div id="box">
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/Users/seeUsers.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <br />
                <div id="box">
                                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/Users/adduser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
</div>

</body>
</html>