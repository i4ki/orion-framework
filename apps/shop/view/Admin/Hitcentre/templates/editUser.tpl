{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="View/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="View/scriptaculo/Admin/adminUI.js"></script>
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
                    <form class="form" action="Admin/Users/EditUser/{$user.id}" method="post">
					<fieldset id="personal">
						<legend>INFORMAÇÕES PESSOAIS</legend>
                    	<div class="divAddUser">
	                        <table class="tableAddUser">
	                    	<tr>
		                        <td class="label"><label for="username">Username : </label></td>
		                        <td class="input"><input type="text" name="username" id="username" value="{$user.username}" tabindex="1" /></td>
		                    </tr>
		                    <tr>
		                        <td class="label"><label for="firstname">Primeiro nome : </label></td>
		 	                    <td class="input"><input name="firstname" id="firstname" type="text" value="{$user.firstname}" tabindex="2" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label"><label for="firstname">Segundo nome : </label></td>
			                    <td class="input"><input name="lastname" id="lastname" value="{$user.lastname}" type="text"
		                        tabindex="2" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label"><label for="email">Email : </label></td>
		                        <td class="input"><input name="email" id="email" type="text" value="{$user.email}"
		                        tabindex="2" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label"><label for="pass">Password : </label></td>
		                        <td class="input"><input name="pass" id="pass" type="password"
		                        tabindex="2" /></td>
	                        </tr>
	                        <tr>
		                        <td class="label"><label for="pass_2">Password : </label></td>
		                        <td class="input"><input name="pass_2" id="pass_2" type="password"
		                        tabindex="2" /></td>
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
	                        <td class="label"><label for="street">Rua : </label></td>
	                        <td class="input"><input name="street" id="street" type="text" value="{$user.street}"
	                        tabindex="2" /></td>
	                    </tr>
	                    <tr>
	                    	<td class="label"><label for="district">Bairro : </label></td>
	                    	<td class="input"><input type="text" name="district" id="district" value="{$user.district}" tabindex="2" /></td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="country">País : </label></td>
	                        <td class="input"><select name="country" id="country" onchange="trocaDom( this, this.value )">
	                        	<option value="0">Selecione...</option>
	                        	
	                        	</select>
	                        	<span id="loader_country" name="loader_country"></span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="state">Estado : </label></td>
	                        <td class="input"><select name="state" id="state" onchange="populate('city',null, this.value)">
	                        	<option value="0">Selecione...</option>
	                        	
	                        	</select>
	                        	<input type="text" name="state_input" id="state_input" value="{$user.state_foreign}" />
	                        	<span id="loader_state" name="loader_state"></span>
	                        	</td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="city">Cidade : </label></td>
	                        <td class="input"><select name="city" id="city">
								<option value="0" size="100">Selecione...</option>
								
	                        </select>
	                        <input type="text" name="city_input" id="city_input" value="{$user.city_foreign}" />
	                        <span id="loader_city" name="loader_city"></span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="cep">C.E.P.: </label></td>
	                        <td class="input"><input name="cep" id="cep" type="text" value="{$user.cep}"
	                        tabindex="2" /></td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="tel_res">Telefone : </label></td>
	                        <td class="input"><input name="tel_res" id="tel_res" type="text" value="{$user.tel_res}"
	                        tabindex="2" /></td>
	                  	</tr>
	                  	<tr>
	                        <td class="label"><label for="tel_cel">Celular : </label></td>
	                        <td class="input"><input name="tel_cel" id="tel_cel" type="text" value="{$user.tel_cel}"
	                        tabindex="2" /></td>
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
	                        <td class="label"><label for="group">Grupo : </label></td>
                        <td class="input">
                        	<select name="group" id="group">
                          		<option value="0">Selecione...</option>
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
                      		<img src="{$URL}View/imagens/usuarios/{$user.id}/{$user.imagem}" height="150" />
                      	{/if}
                      	</center>	
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" value="Enviar" />
                      <input id="button2" type="button" value="Restaurar valores" onclick="location.href='Admin/Users/EditUser/{$user.id}'" />
                      </div>
                    </form>
                    <form method="post" class="form" action="Admin/Users/Notificar/{$user.id}">
                    <fieldset id="notificar">
                    	<legend>NOTIFICAR USUÁRIO</legend>
                    	<label for="titulo">Título: </label>
                    	<input name="title" type="text" id="title" size="49" />
                    	<label for="message">Mensagem</label>
                    	<textarea cols="30" rows="5">Olá {$user.firstname}, gostaríamos de informá-lo que...</textarea>
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
