<?php /* Smarty version 2.6.23, created on 2009-09-09 14:18:17
         compiled from School/courses.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/cookies.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/rte/richtext.js"></script>
<!--script type="text/javascript" src="View/scriptaculo/Admin/adminUI.js"></script-->
<?php echo '
<script language="JavaScript" type="text/javascript">
<!--
function submitForm() 
{
	//make sure hidden and iframe values are in sync before submitting form
	//to sync only 1 rte, use updateRTE(rte)
	//to sync all rtes, use updateRTEs
	//updateRTE(\'rte1\');
	updateRTEs();
	description = document.form_course.description.value;
	$j(\'#description_2\').text(description);

	//change the following line to true to submit form
	return true;
}

//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("'; ?>
<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/", "apps/hitcentre/view/scriptaculo/rte/", ""<?php echo ');
//-->
</script>
<noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

<style type="text/css" media="all">
table.addcourse td {border:none;}
table.seecourse {width:500px;margin:0 auto;}
td.label {text-align:right;}
#pager {width:550px;margin:0 auto;}
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
                <div id="box">
                	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/School/courses.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <br />
                	
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