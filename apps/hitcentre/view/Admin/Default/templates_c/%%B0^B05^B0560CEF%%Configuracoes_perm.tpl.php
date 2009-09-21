<?php /* Smarty version 2.6.23, created on 2009-05-19 05:30:45
         compiled from Configuracoes_perm.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<body onload="menuDropDown();">
	<div id="main" name="main">
		<div id="topo" name="topo"><?php echo $this->_tpl_vars['topo']; ?>
<h1><center>:: TOPO ::</center></h1></div>
		<div id="menu" name="menu">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu_admin_portal.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<div class="clear"></div>
		<div id="conteudo" name="conteudo">
			<div id="imagem" name="imagem">

			</div>
			<div id="box" name="box">
				<?php echo $this->_tpl_vars['conteudo']; ?>

			</div>
		</div>
	</div>
</body>
</html>