<?php /* Smarty version 2.6.23, created on 2009-09-10 01:44:05
         compiled from School/viewStudent.tpl */ ?>

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
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/date.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.datePicker.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/edit_student.js"></script>

</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title"><h2>Hit Centre of Language</h2></title></div>
        	
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
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/School/viewStudent.tpl", 'smarty_include_vars' => array()));
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