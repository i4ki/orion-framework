{include file="includes/head.tpl"}
</head>
<body>
	<div id="header">
		<img src="{$pathAdmin}img/logo.jpg" height="80" align="left" />
		<center><span id="titulo">Acesso à Area Restrita</span></center>
	</div>
	<div id="login">
	
	<center><h3>Login</h3></center>
	
	<form method="POST" class="form" action="Admin/Login">
		<input type="hidden" name="csrf" id="csrf" value="{$key}" />
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
		{include file="includes/footer.tpl"}
	</div>
</body>
</html>