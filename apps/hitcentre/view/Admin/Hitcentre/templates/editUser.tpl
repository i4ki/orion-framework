{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI.js"></script>
<script type="text/javascript">
{literal}

	$j = jQuery.noConflict();
	$j(document).ready(function() {
{/literal}
		{if $url == "Admin/Users/EditUser"}
			populate('country', {$user.country_id});
			{if $user.country_id == 76}
			populate('state', {$user.state_id}, 76);
			populate('city', {$user.city_id}, {$user.state_id});
			{else}
			trocaDom(null, {$user.country_id});
			{/if}
		{else}	
			populate('country');
			populate('state',null, 76);
			populate('city', null, 26);
		{/if}
{literal}
	});
</script>
{/literal}
</head>

<body>
	<div id="container">
    	<div id="header">
        	<h2>{$header}</h2>
    		<div id="topmenu">
            	{include file="includes/topmenu.tpl"}
          	</div>
      	</div>
        <div id="top-panel">
            <div id="panel">
                {include file="includes/panel.tpl"}
            </div>
      </div>
        <div id="wrapper">
            <div id="content">              
                <div id="box">
                	<h3 id="adduser">Editar Usuário</h3>
                    <form class="form" action="Admin/Users/EditUser/{$user.id}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="form" id="form" value="edituser" />
					<input type="hidden" name="username" id="username" value="{$user.username}" />
					<fieldset id="personal">
						<legend>INFORMAÇÕES PESSOAIS</legend>
                    	<div class="divAddUser">
	                        <table class="tableAddUser">
	                    	<tr>
		                        <td class="label">Username:&nbsp;</td>
		                        <td class="input">&nbsp;<strong>{$user.username}</strong></td>
		                    </tr>
		                    <tr>
		                        <td class="label">Primeiro nome:&nbsp;</td>
		 	                    <td class="input"><input name="firstname" id="firstname" type="text" value="{$user.firstname}" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label">Segundo nome:&nbsp;</td>
			                    <td class="input"><input name="lastname" id="lastname" value="{$user.lastname}" type="text" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label">Email:&nbsp;</td>
		                        <td class="input"><input name="email" id="email" type="text" value="{$user.email}" /></td>
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
	                        <td class="input"><input name="street" id="street" type="text" value="{$user.street}" /></td>
	                    </tr>
	                    <tr>
	                    	<td class="label">Bairro:&nbsp;</td>
	                    	<td class="input"><input type="text" name="district" id="district" value="{$user.district}" /></td>
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
	                        	<input type="text" name="state_input" id="state_input" value="{$user.state_foreign}" />
	                        	<span id="loader_state" name="loader_state"></span>
	                        	</td>
	                    </tr>
	                    <tr>
	                        <td class="label">Cidade:&nbsp;</td>
	                        <td class="input"><select name="city" id="city">
								<option value="0" size="100">Selecione...</option>
								
	                        </select>
	                        <input type="text" name="city_input" id="city_input" value="{$user.city_foreign}" />
	                        <span id="loader_city" name="loader_city"></span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="label">C.E.P.:&nbsp;</td>
	                        <td class="input"><input name="cep" id="cep" type="text" value="{$user.cep}" /></td>
	                    </tr>
	                    <tr>
	                        <td class="label">Telefone:&nbsp;</td>
	                        <td class="input"><input name="tel_res" id="tel_res" type="text" value="{$user.tel_res}" /></td>
	                  	</tr>
	                  	<tr>
	                        <td class="label">Celular:&nbsp;</td>
	                        <td class="input"><input name="tel_cel" id="tel_cel" type="text" value="{$user.tel_cel}" /></td>
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
                          {section name=g loop=$groups}
                          		<option {if $groups[g].id === $user.group_id} SELECTED {/if}value="{$groups[g].id}">{$groups[g].name}</option>
                          {/section}
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
                      	{if $user.imagem == NULL}
                      		<img src="{$pathAdmin}img/user.gif" height="150" />
                      	{else}
                      		<img src="{$URL}apps/hitcentre/view/Admin/Hitcentre/templates/images/avatar/{$user.username}/{$user.imagem}" height="150" />
                      	{/if}
                      	</center>
							<br />
							<center>Imagem:&nbsp;<input type="file" name="foto" id="foto" /></center>
							
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" value="Enviar" />
                      <input id="button2" type="button" value="Restaurar valores" onclick="location.href='Admin/Users/EditUser/{$user.id}'" />
                      </div>
                    </form>
                    <form method="post" class="form" action="Admin/Users/Notificar/{$user.id}">
                    <fieldset id="notificar">
                    	<legend>NOTIFICAR USUÁRIO</legend>
                    	<table class="tableAddUser">
						<tr>
							<td class="label"><label for="titulo">Título:&nbsp;</label></td>
							<td><input name="title" type="text" id="title" size="50" /></td>
						</tr>
						<tr>
							<td class="label"><label for="message">Mensagem:&nbsp;</label></td>
							<td><textarea cols="30" rows="5" name="message" id="message">Olá {$user.firstname}, gostaríamos de informá-lo que...</textarea></td>
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
  				{include file="includes/sidebar.tpl"}
          </div>
      </div>
        <div id="footer">
			{include file="includes/footer.tpl"}
        </div>
</div>

</body>
</html>
