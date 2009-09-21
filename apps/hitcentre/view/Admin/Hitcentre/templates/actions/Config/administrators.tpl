<h3 id="adduser">Adicionar Administrador</h3>
    <form class="form" action="Admin/Config/Administrators" method="post">
	<fieldset id="personal">
		<legend>INFORMAÇÕES PESSOAIS</legend>
    	<div class="divAddUser">
            <table class="tableAddUser">
        	<tr>
                <td class="label"><label for="username">Username : </label></td>
                <td class="input"><input type="text" name="username" id="username" /></td>
            </tr>
            <tr>
                <td class="label"><label for="firstname">Primeiro nome : </label></td>
                    <td class="input"><input name="firstname" id="firstname" type="text" /></td>
            </tr>
            <tr>
                <td class="label"><label for="firstname">Segundo nome : </label></td>
                <td class="input"><input name="lastname" id="lastname" type="text"
                /></td>
            </tr>
            <tr>
                <td class="label"><label for="email">Email : </label></td>
                <td class="input"><input name="email" id="email" type="text"
                /></td>
            </tr>
            <tr>
                <td class="label"><label for="generatepass">Enviar password gerado automáticamente&nbsp;</label></td>
                <td><input name="generatepass" id="generatepass" type="checkbox" value="yes" /></td>
            </tr>
            <tr>
                <td class="label"><label for="pass">Password : </label></td>
                <td class="input"><input name="pass" id="pass" type="password"
                /></td>
            </tr>
            <tr>
                <td class="label"><label for="pass_2">Password : </label></td>
                <td class="input"><input name="pass_2" id="pass_2" type="password"
                /></td>
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
            <td class="input"><input name="street" id="street" type="text"
            /></td>
        </tr>
        <tr>
        	<td class="label"><label for="district">Bairro : </label></td>
        	<td class="input"><input type="text" name="district" id="district" /></td>
        </tr>
        <tr>
            <td class="label"><label for="country">País : </label></td>
            <td class="input"><select name="country" id="country" onchange="trocaDom(this, this.value)">
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
            	<input type="text" name="state_input" id="state_input" />
            	<span id="loader_state" name="loader_state"></span>
            	</td>
        </tr>
        <tr>
            <td class="label"><label for="city">Cidade : </label></td>
            <td class="input"><select name="city" id="city">
				<option value="0" size="100">Selecione...</option>
				
            </select>
            <input type="text" name="city_input" id="city_input" />
            <span id="loader_city" name="loader_city"></span>
            </td>
        </tr>
        <tr>
            <td class="label"><label for="cep">C.E.P.: </label></td>
            <td class="input"><input name="cep" id="cep" type="text"
            /></td>
        </tr>
        <tr>
            <td class="label"><label for="tel_res">Telefone&nbsp;</label></td>
            <td class="input"><input name="tel_res" id="tel_res" type="text" /></td>
      	</tr>
      	<tr>
      		<td class="label"><label for="tel_cel">Celular&nbsp;</label></td>
      		<td class="input"><input type="text" name="tel_cel" id="tel_cel" /></td>
      	</tr>
      	<tr>
      		<td class="label"><label for="tel_cel">Celular : </label></td>
      		<td class="input"><input type="text" name="tel_cel" id="tel_cel" /></td>
      	</tr>
      	</table>
      	</div>
      	<div id="dataAddressError" name="dataAddressError">
		<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
      	</div>
      	<div class="clear"></div>
      </fieldset>
      
      <div align="center">
	      <input id="button1" type="submit" value="Enviar" />
	      <input id="button2" type="reset" />
      </div>
</form>

