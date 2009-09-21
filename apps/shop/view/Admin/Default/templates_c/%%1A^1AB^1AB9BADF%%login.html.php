<?php /* Smarty version 2.6.23, created on 2009-08-11 00:08:18
         compiled from login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
<title>Área Restrita</title>
<base href="<?php echo $this->_tpl_vars['URL']; ?>
" />
</head>
<body>
	<div id="login">
	<form method="post" name="login" id="login" action="Admin/Login">
		<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->_tpl_vars['key']; ?>
" />
		<input type="hidden" name="tipo" id="tipo" value="0" />
		<table id="login">
			<tr>
				<td>username: </td>
				<td><input type="text" name="rsa_user" id="rsa_user" size="20" /></td>
			</tr>
			<tr>
				<td>Senha : </td>
				<td><input type="password" name="rsa_senha" id="rsa_senha" size="20" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="enviar" id="enviar" value="Entrar" /></td>
			</tr>
		</table>
		</form>
	</div>
</body>
</html>