<br />
<table class="tbgerais">
	<tr>
		<td class="label"><label for="company_name">Empresa:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_name" id="company_name" size="20" maxlength="255" value="@name@" /></td>
		<td class="label"></td>
		<td class="input"></td>
	</tr>
	<tr>
		<td class="label"><label for="company_address">Endereço:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_address" id="company_address" size="20" maxlength="255" value="@address@" /></td>
		<td class="label"><label for="company_number">Número:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_number" id="company_number" value="@number@" /></td>
	</tr>
	<tr>
		<td class="label"><label for="company_complement">Complemento:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_complement" id="company_complement" value="@complement@" /></td>
		<td class="label"><label for="company_district">Bairro:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_district" id="company_district" maxlength="255" value="@district@" /></td>		
	</tr>
	<tr>
		<td class="label"><label for="company_tel">Telefone:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_tel" id="company_tel" value="@tel@" /></td>
		<td class="label"><label for="company_fax">FAX:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_fax" id="company_fax" value="@fax@" /></td>
	</tr>
	
</table>
<center>
<table class="tb3">
	<tr>
		<td width="100px"><label for="company_country_id">País:&nbsp;</label></td>
		<td class="input">	<select name="company_country_id" id="company_country_id" onchange="trocaDom(this, this.value,'company')">
								<option value="0">Selecione...</option>
							</select>
			<span id="company_loader_country" name="company_loader_country"></span>
		</td>
		<td width="100px"><label for="company_state_id">Estado:&nbsp;</label></td>
		<td class="input">	<select name="company_state_id" id="company_state_id" onchange="populate('city',null,this.value,null,'company_city_id');">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="company_state_foreign" id="company_state_foreign" size="12" />
			<span id="loader_company_state" name="loader_company_state"></span>
		</td>
		<td width="100px"><label for="company_city_id">Cidade:&nbsp;</label></td>
		<td class="input">	<select name="company_city_id" id="company_city_id">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="company_city_foreign" id="company_city_foreign" size="12" />
			<span id="loader_company_city" name="loader_company_city"></span>
		</td>
	</tr>
</table>

</center>
<center>
C.E.P:&nbsp;
<input type="text" name="company_cep" id="company_cep" size="8" value="@cep@" />
</center>
<table class="tbgerais" width="100%">
	<tr>
		<td class="label" width="200px"><label for="company_cargo">Cargo/Depto/Área:&nbsp;</label></td>
		<td class="input"><input type="text" name="company_cargo" id="company_cargo" size="15" /></td>
		<td class="label" width="130px"><label for="company_email_pro">Email profissional:&nbsp;</label></td>
		<td class="input"><label for="company_email_pro"><input type="text" name="company_email_pro" id="company_email_pro" size="15" /></td>
	</tr>	
</table>