<?php /* Smarty version 2.6.23, created on 2009-09-20 04:23:07
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body>
	<div id="header">
		<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/logo.jpg" height="80" align="left" />
		<center><span id="titulo">Acesso à Area Restrita</span></center>
	</div>
	<div id="login">
	
	<center><h3>Login</h3></center>
	
	<form method="POST" class="form" action="Admin/Login">
		<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->_tpl_vars['key']; ?>
" />
		<table>
			<tr>
				<td width="30%" class="label">username:&nbsp;</td>
				<td width="70%"><input type="text" name="rsa_user" id="rsa_user" size="20" /></td>
			</tr>
			<tr>
				<td class="label">senha:&nbsp;</td>
				<td><input type="password" name="rsa_senha" id="rsa_senha" size="20" /></td>
			</tr>
			<input type="hidden" name="tipo" id="tipo" value="0" />
			<tr>
				<td></td>
				<td><input type="submit" name="enviar" id="enviar" value="Entrar" /></td>
			</tr>
		</table>
		</form>
	</div>
	<div id="footer">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</body>
</html>