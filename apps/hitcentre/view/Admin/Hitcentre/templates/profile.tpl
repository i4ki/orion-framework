{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI.js"></script>

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
                	<h3 id="adduser">{$user.firstname}&nbsp;{$user.lastname}</h3>
					<form class="form" method="post">
                    <fieldset id="personal">
						<legend>INFORMAÇÕES PESSOAIS</legend>
						
                    	<div class="divAddUser" style="font-size:10pt;">
	                        <table class="tableAddUser">
	                    	<tr>
		                        <td class="label">Username:&nbsp;</td>
		                        <td class="input">&nbsp;<strong>{$user.username}</strong></td>
		                    </tr>
		                    <tr>
		                        <td class="label">Primeiro nome:&nbsp;</td>
		 	                    <td class="input">{$user.firstname}</td>
	                        </tr>
	                        <tr>
		                        <td class="label">Segundo nome:&nbsp;</td>
			                    <td class="input">{$user.lastname}</td>
	                        </tr>
	                        <tr>
		                        <td class="label">Email:&nbsp;</td>
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
                        <div class="divAddUser" style="font-size:10pt;">
                        <table class="tableAddUser">
                        <tr>
	                        <td class="label">Rua:&nbsp;</td>
	                        <td class="input">{$user.street}</td>
	                    </tr>
	                    <tr>
	                    	<td class="label">Bairro:&nbsp;</td>
	                    	<td class="input">{$user.district}</td>
	                    </tr>
	                    <tr>
	                        <td class="label">País:&nbsp;</td>
	                        <td class="input">{$country}</td>
	                    </tr>
	                    <tr>
	                        <td class="label">Estado:&nbsp;</td>
	                        <td class="input">{$state}</td>
	                    </tr>
	                    <tr>
	                        <td class="label">Cidade:&nbsp;</td>
	                        <td class="input">{$city}</td>
	                    </tr>
	                    <tr>
	                        <td class="label">C.E.P.:&nbsp;</td>
	                        <td class="input">{$user.cep}</td>
	                    </tr>
	                    <tr>
	                        <td class="label">Telefone:&nbsp;</td>
	                        <td class="input"></td>
	                  	</tr>
	                  	<tr>
	                        <td class="label">Celular:&nbsp;</td>
	                        <td class="input">{$user.tel_cel}</td>
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
                        <div class="divAddUser" style="font-size:10pt;">
                        <table class="tableAddUser">
                        <tr>
	                        <td class="label">Grupo:&nbsp;</td>
                        <td class="input">{$group}</td>
                        
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
					</fieldset>
					                    
                    </form>
                    <form method="post" class="form" action="Admin/Users/Notificar/{$user.id}">
                    <fieldset id="notificar">
                    	<legend>NOTIFICAR USUÁRIO</legend>
                    	<label for="titulo">Título:&nbsp;</label>
                    	<input name="title" type="text" id="title" size="50" />
                    	<label for="message">Mensagem</label>
                    	<textarea cols="30" rows="5" name="message" id="message">Olá {$user.firstname}, gostaríamos de informá-lo que...</textarea>
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
