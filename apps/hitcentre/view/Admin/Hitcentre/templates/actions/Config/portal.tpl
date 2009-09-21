<h3 id="portal">CONFIGURAÇÕES DO PORTAL</h3>
    <form class="form" action="Admin/Config/Portal/Save" method="post">
	<fieldset id="gerais">
		<legend>Gerais</legend>
    	<div class="divGerais">
            <table class="tbgerais">
	        	<tr>
	                <td class="label"><label for="domain">Domínio:&nbsp; </label></td>
	                <td class="input"><input type="text" name="domain" id="domain" value="{$portal.domain}" /></td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="default_title">Título padrão:&nbsp;</label></td>
	            	<td class="input"><input type="text" name="default_title" id="default_title" value="{$portal.default_title}" /></td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="meta_description">Meta-Description padrão:&nbsp;</label></td>
	            	<td class="input"><textarea name="meta_description" id="meta_description" style="width:80%; height: 60px;">{$portal.meta_description}</textarea></td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="meta_keywords">Meta-Keywords padrão:&nbsp;</label></td>
	            	<td class="input"><textarea name="meta_keywords" id="meta_keywords" style="width:80%; height: 60px;">{$portal.meta_keywords}</textarea></td>
	            </tr>
	             <tr>
	            	<td class="label"><label for="approve_profile">Habilitar aprovação de perfis:&nbsp;</label></td>
	            	<td class="input">	<select name="approve_profile" id="approve_profile">
	            							<option value="0"{if $portal.approve_profile == "0"} selected="selected"{/if}>Não</option>
	            							<option value="1"{if $portal.approve_profile == "1"} selected="selected"{/if}>Sim</option>
	            						</select>
	            	</td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="auth_email">Habilitar email autenticado&nbsp;</label></td>
	            	<td class="input">	<select name="auth_email" id="auth_email">
	            							<option value="0"{if $portal.auth_email == "0"} selected="selected"{/if}>Não</option>
	            							<option value="1"{if $portal.auth_email == "1"} selected="selected"{/if}>Sim</option>
	            						</select>
	            	</td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="smtp_email">SMTP&nbsp;</label></td>
	            	<td class="input"><input type="text" name="smtp_email" id="smtp_email" size="20" value="{$portal.smtp_email}" /></td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="port_email">Porta&nbsp;</label></td>
	            	<td class="input"><input type="text" name="port_email" id="port_email" size="10" value="{$portal.port_email}" /></td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="user_email">Usuário&nbsp;</label></td>
	            	<td class="input"><input type="text" name="user_email" id="user_email" size="20" value="{$portal.user_email}" /></td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="pass_email">Senha&nbsp;</label></td>
	            	<td class="input"><input type="password" name="pass_email" id="pass_email" size="20" /></td>
	            </tr>        
           	</table>
    	</div>
    </fieldset>
	<fieldset id="security">
    	<legend>Segurança</legend>
    	<div id="security">
    		<table class="tbsecurity">
    			<tr>
	            	<td class="label"><label for="allow_ssl">Habilitar SSL:&nbsp;</label></td>
	            	<td class="input">	<select name="allow_ssl" id="allow_ssl">
	            							<option value="0"{if $portal.allow_ssl == "0"} selected="selected"{/if}>Não</option>
	            							<option value="1"{if $portal.allow_ssl == "1"} selected="selected"{/if}>Sim</option>
	            						</select>
	            	</td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="allow_logs">Habilitar manutenção de Logs de acesso:&nbsp;</label></td>
	            	<td class="input">	<select name="allow_logs" id="allow_logs">
	            							<option value="0"{if $portal.allow_logs == "0"} selected="selected"{/if}>Não</option>
	            							<option value="1"{if $portal.allow_logs == "1"} selected="selected"{/if}>Sim</option>
	            						</select>
	            	</td>
	            </tr>
	            <tr>
	            	<td class="label"><label for="login_admin">Nome da área de login para administradores:&nbsp;</label></td>
	            	<td class="input">&nbsp;<input type="login_admin" name="login_admin" id="login_admin" value="{$portal.login_admin}" size="20" /></td>
	            </tr>
	             			
    		</table>	
    	</div>
    </fieldset>
      <fieldset id="msg_register_user">
		<legend>Mensagem para envio Automático de Senha</legend>
		<table class="tbmsg">
			<tr>
				<td class="label">Título:&nbsp;</td>
				<td class="input"><input type="text" name="msg_register_title" id="msg_register_title" value="{$portal.msg_register_title}" size="32" /></td>
			</tr>
			<tr>
				<td class="label" colspan="2"><center>Mensagem:&nbsp;</center></td>
			</tr>
			<tr>
				<td class="input" colspan="2"><center><textarea id="msg_register_body" name="msg_register_body" style="width:80%; height: 200px;"></textarea></center></td>
			</tr>
			</tr>
		</table>
	  </fieldset>
      <div align="center">
	      <input id="button1" type="submit" value="Enviar" />
	      <input id="button2" type="reset" />
      </div>
</form><!--
Olá <name>, você acaba de receber um acesso à área restrita do Hitcentre. Os seus dados de acesso são:

login: <login>
senha: <senha>

A sua senha foi automaticamente gerado pelo nosso sistema, após logar-se no sistema, por favor altere como desejar.

Se você não pediu um acesso à esse sistema, por favor, notifique-nos do engano. contato@hitcentre.com

Hit Centre of Language.-->

