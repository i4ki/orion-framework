<?php /* Smarty version 2.6.23, created on 2009-09-06 01:21:04
         compiled from editUser.tpl */ ?>

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
			populate('country');
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
        	<h2><?php echo $this->_tpl_vars['header']; ?>
</h2>
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
                	<h3 id="adduser">Editar Usuário</h3>
                    <form class="form" action="Admin/Users/EditUser/<?php echo $this->_tpl_vars['user']['id']; ?>
" method="post" enctype="multipart/form-data">
					<input type="hidden" name="form" id="form" value="edituser" />
					<input type="hidden" name="username" id="username" value="<?php echo $this->_tpl_vars['user']['username']; ?>
" />
					<fieldset id="personal">
						<legend>INFORMAÇÕES PESSOAIS</legend>
                    	<div class="divAddUser">
	                        <table class="tableAddUser">
	                    	<tr>
		                        <td class="label">Username:&nbsp;</td>
		                        <td class="input">&nbsp;<strong><?php echo $this->_tpl_vars['user']['username']; ?>
</strong></td>
		                    </tr>
		                    <tr>
		                        <td class="label">Primeiro nome:&nbsp;</td>
		 	                    <td class="input"><input name="firstname" id="firstname" type="text" value="<?php echo $this->_tpl_vars['user']['firstname']; ?>
" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label">Segundo nome:&nbsp;</td>
			                    <td class="input"><input name="lastname" id="lastname" value="<?php echo $this->_tpl_vars['user']['lastname']; ?>
" type="text" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label">Email:&nbsp;</td>
		                        <td class="input"><input name="email" id="email" type="text" value="<?php echo $this->_tpl_vars['user']['email']; ?>
" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label">Password:&nbsp;</td>
		                        <td class="input"><input name="pass" id="pass" type="password" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label">Password:&nbsp;</td>
		                        <td class="input"><input name="pass_2" id="pass_2" type="password" /></td>
	                        </tr>
		                   	</table>
	                	</div>
	                   	<div class="divAddUserError">
                  			<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
                  			
                  		</div>
                  		<div class="clear"></div>

                    </fieldset>

                      <fieldset id="address">
                        <legend>Endereço</legend>
                        <div class="divAddUser">
                        <table class="tableAddUser">
                        <tr>
	                        <td class="label">Rua:&nbsp;</td>
	                        <td class="input"><input name="street" id="street" type="text" value="<?php echo $this->_tpl_vars['user']['street']; ?>
" /></td>
	                    </tr>
	                    <tr>
	                    	<td class="label">Bairro:&nbsp;</td>
	                    	<td class="input"><input type="text" name="district" id="district" value="<?php echo $this->_tpl_vars['user']['district']; ?>
" /></td>
	                    </tr>
	                    <tr>
	                        <td class="label">País:&nbsp;</td>
	                        <td class="input"><select name="country" id="country" onchange="trocaDom( this, this.value )">
	                        	<option value="0">Selecione...</option>
	                        	
	                        	</select>
	                        	<span id="loader_country" name="loader_country"></span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="label">Estado:&nbsp;</td>
	                        <td class="input"><select name="state" id="state" onchange="populate('city',null, this.value)">
	                        	<option value="0">Selecione...</option>
	                        	
	                        	</select>
	                        	<input type="text" name="state_input" id="state_input" value="<?php echo $this->_tpl_vars['user']['state_foreign']; ?>
" />
	                        	<span id="loader_state" name="loader_state"></span>
	                        	</td>
	                    </tr>
	                    <tr>
	                        <td class="label">Cidade:&nbsp;</td>
	                        <td class="input"><select name="city" id="city">
								<option value="0" size="100">Selecione...</option>
								
	                        </select>
	                        <input type="text" name="city_input" id="city_input" value="<?php echo $this->_tpl_vars['user']['city_foreign']; ?>
" />
	                        <span id="loader_city" name="loader_city"></span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="label">C.E.P.:&nbsp;</td>
	                        <td class="input"><input name="cep" id="cep" type="text" value="<?php echo $this->_tpl_vars['user']['cep']; ?>
" /></td>
	                    </tr>
	                    <tr>
	                        <td class="label">Telefone:&nbsp;</td>
	                        <td class="input"><input name="tel_res" id="tel_res" type="text" value="<?php echo $this->_tpl_vars['user']['tel_res']; ?>
" /></td>
	                  	</tr>
	                  	<tr>
	                        <td class="label">Celular:&nbsp;</td>
	                        <td class="input"><input name="tel_cel" id="tel_cel" type="text" value="<?php echo $this->_tpl_vars['user']['tel_cel']; ?>
" /></td>
	                  	</tr>
	                  	</table>
	                  	</div>
	                  	<div id="dataAddressError" name="dataAddressError">
						<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
	                  	</div>
	                  	<div class="clear"></div>
                      </fieldset>
                      <fieldset id="opt">
                        <legend>OPÇÕES</legend>
                        <div class="divAddUser">
                        <table class="tableAddUser">
                        <tr>
	                        <td class="label">Grupo:&nbsp;</td>
                        <td class="input">
                        	<select name="group" id="group">
                          		<option value="">Selecione...</option>
                          <?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
                          		<option <?php if ($this->_tpl_vars['groups'][$this->_sections['g']['index']]['id'] === $this->_tpl_vars['user']['group_id']): ?> SELECTED <?php endif; ?>value="<?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['name']; ?>
</option>
                          <?php endfor; endif; ?>
                        	</select>
                        </td>
                        
                      </tr>
                      </table>
                      </div>
                      <div class="divAddUserError">
                      	<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
                      </div>
                      <div class="clear"></div>
                      </fieldset>
                      <fieldset id="imagem">
                      	<legend>IMAGEM DE EXIBIÇÃO</legend>
                      	<center>
                      	<?php if ($this->_tpl_vars['user']['imagem'] == NULL): ?>
                      		<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/user.gif" height="150" />
                      	<?php else: ?>
                      		<img src="<?php echo $this->_tpl_vars['URL']; ?>
apps/hitcentre/view/Admin/Hitcentre/templates/images/avatar/<?php echo $this->_tpl_vars['user']['username']; ?>
/<?php echo $this->_tpl_vars['user']['imagem']; ?>
" height="150" />
                      	<?php endif; ?>
                      	</center>
							<br />
							<center>Imagem:&nbsp;<input type="file" name="foto" id="foto" /></center>
							
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" value="Enviar" />
                      <input id="button2" type="button" value="Restaurar valores" onclick="location.href='Admin/Users/EditUser/<?php echo $this->_tpl_vars['user']['id']; ?>
'" />
                      </div>
                    </form>
                    <form method="post" class="form" action="Admin/Users/Notificar/<?php echo $this->_tpl_vars['user']['id']; ?>
">
                    <fieldset id="notificar">
                    	<legend>NOTIFICAR USUÁRIO</legend>
                    	<table class="tableAddUser">
						<tr>
							<td class="label"><label for="titulo">Título:&nbsp;</label></td>
							<td><input name="title" type="text" id="title" size="50" /></td>
						</tr>
						<tr>
							<td class="label"><label for="message">Mensagem:&nbsp;</label></td>
							<td><textarea cols="30" rows="5" name="message" id="message">Olá <?php echo $this->_tpl_vars['user']['firstname']; ?>
, gostaríamos de informá-lo que...</textarea></td>
						</tr>
						</table>
						</center>
                    </fieldset>
                    <div align="center">
                    	<input type="submit" id="button1" name="button1" value="Enviar" />
                    	<input type="reset" id="button2" name="bitton2" value="Apagar" />
                    </div>
                    </form>

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