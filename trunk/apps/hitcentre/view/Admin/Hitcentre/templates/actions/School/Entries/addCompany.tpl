<h3>Cadastro de Empresas</h3>
<form method="POST" class="form" action="Admin/School/Entries/Companies/Save">
<fieldset id="student">
<legend> Empresa </legend>

<table class="tbgerais">
	<tr>
		<td class="label"><label for="name_company">Nome:&nbsp;</label></td>
		<td class="input"><input type="text" name="name_company" id="name_company" /></td>
	</tr>
	<tr>
		<td class="label"><label for="cnpj">CNPJ:&nbsp;</label></td>
		<td class="input"><input type="text" name="cnpj" id="cnpj" /></td>
	</tr>
	<tr>
		<td class="label"><label for="tel">Telefone:&nbsp;</label></td>
		<td class="input"><input type="text" name="tel" id="tel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="tel_fax">Fax:&nbsp;</label></td>
		<td class="input"><input type="text" name="tel_fax" id="tel_fax" /></td>
	</tr>
	<tr>
		<td class="label"><label for="email_contact">Email (contato):&nbsp;</label></td>
		<td class="input"><input type="text" name="email_contact" id="email_contact" /></td>
	</tr>
	<tr>
		<td class="label"><label for="email_finance">Email (financeiro):&nbsp;</label></td>
		<td class="input"><input type="text" name="email_finance" id="email_finance" /></td>
	</tr>
</table>

</fieldset>
<fieldset id="contact">
<legend> Contato </legend>
<table class="tbgerais">
	<tr>
		<td class="label" width="10%"><label for="address">Endereço:&nbsp;</label></td>
		<td class="input" width="60%"><input type="text" name="address" id="address" size="30" /></td>
		<td class="label" width="20%"><label for="number">&nbsp;Número:&nbsp;</label></td>
		<td class="input" width="10%"><input type="text" name="number" id="number" size="5" />
	</tr>
	<tr>
		<td class="label"><label for="complement">Complemento:&nbsp;</label></td>
		<td class="input"><input type="text" name="complement" id="complement" size="30" /></label></td>
		<td class="label"><label for="district">Bairro:&nbsp;</label></td>
		<td class="input"><input type="text" name="district" id="district" size="15" /></td>
	</tr>
</table>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="country_id">País:&nbsp;</label></td>
		<td class="input">	<select name="country_id" id="country_id" onchange="trocaDom(this, this.value)">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country"></span>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="state_id">Estado:&nbsp;</label></td>
		<td class="input">	<select name="state_id" id="state_id" onchange="populate('city',null,this.value)">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="state_foreign" id="state_foreign" />
			<span id="loader_state" name="loader_state"></span>		
		</td>
	</tr>
	<tr>
		<td class="label"><label for="city_id">Cidade:&nbsp;</label></td>
		<td class="input">	<select name="city_id" id="city_id">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="city_foreign" id="city_foreign" />
			<span id="loader_city" name="loader_city"></span>
		</td>
	</tr>
</table>
<br />
<center>	<input type="submit" value="Cadastrar" />
			<input type="reset" value="Zerar campos" />
</center>

</fieldset>
</form>
