{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

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
                
                <div id="box_perfil">
                	<h3 id="adduser">Perfil do Usuário</h3>
                    
					<fieldset id="personal">
						<legend>INFORMAÇÕES PESSOAIS</legend>
                    	<div class="divAddUser">
	                        <table class="tableAddUser">
	                    	<tr>
		                        <td class="label"><label for="username">Username : </label></td>
		                        <td class="input">{$user.username}</td>
		                    </tr>
		                    <tr>
		                        <td class="label"><label for="name">Nome : </label></td>
		                        <td class="input">{$user.firstname}&nbsp;{$user.lastname}</td>
	                        </tr>
	                        <tr>
		                        <td class="label"><label for="email">Email : </label></td>
		                        <td class="input">{$user.email}</td>
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
	                        <td class="input">{$user.street}</td>
	                    </tr>
	                    <tr>
	                    	<td class="label"><label for="district">Bairro : </label></td>
	                    	<td class="input">{$user.district}</td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="country">País : </label></td>
	                        <td class="input">{$user.country}
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="state">Estado : </label></td>
	                        <td class="input">{$user.state}
	                        	</td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="city">Cidade : </label></td>
	                        <td class="input">{$user.city}
	                        </td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="zip">C.E.P.: </label></td>
	                        <td class="input">{$user.cep}</td>
	                    </tr>
	                    <tr>
	                        <td class="label"><label for="tel">Telefone : </label></td>
	                        <td class="input">{$user.tel_res}</td>
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
                        <td class="input"><select name="group" id="group">
                          <option value="0">
                          Selecione...
                          </option>
                          {section name=g loop=$groups}
                          	<option value="{$groups[g].id}">{$groups[g].namegroup}</option>
                          {/section}
                        </select></td>
                      </tr>
                      </table>
                      </div>
                      <div class="divAddUserError">
                      	<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
                      </div>
                      <div class="clear"></div>
                      </fieldset>
                      <div align="center">
                      </div>

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
