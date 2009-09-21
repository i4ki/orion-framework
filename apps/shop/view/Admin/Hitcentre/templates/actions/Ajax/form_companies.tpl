<table class="tbgerais">
	<tr>
		<td class="label"><label for="company_name">Empresa&nbsp;</label></td>
		<td class="input"><input type="text" name="company_name" id="company_name" size="40" maxlength="255" /></td>
		<td class="labl_right">Telefone</td>
		<td class="input_right"><input type="text" name="company_tel" id="company_tel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="company_address">Endereço</label></td>
		<td class="input"><input type="text" name="company_address" id="company_address" size="40" maxlength="255" /></td>
		<td class="label_right"><label for="company_district">Bairro</label></td>
		<td class="input_right"><input type="text" name="company_district" id="company_district"maxlength="255" /></td>		
	</tr>
</table>
<center>
<table class="tb3">
	<tr>
		<td class="label"><label for="company_country_id">País&nbsp;</label></td>
		<td class="input">	<select name="company_country_id" id="company_country_id" onchange="trocaDom(this, this.value,'company')">
								<option value="0">Selecione...</option>
							</select>
			<span id="company_loader_country" name="company_loader_country"></span>
		</td>
		<td class="label"><label for="company_state_id">Estado</label></td>
		<td class="input">	<select name="company_state_id" id="company_state_id" onchange="populate('city',null,this.value,null,'company_city');">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="company_state_input" id="company_state_input" size="12" />
			<span id="loader_company_state" name="loader_company_state"></span>
		</td>
		<td class="label"><label for="company_city">Cidade&nbsp;</label></td>
		<td class="input">	<select name="company_city" id="company_city">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="company_city_input" id="company_city_input" size="12" />
			<span id="loader_company_city" name="loader_company_city"></span>
		</td>
	</tr>
</table>

</center>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="company_cep">C.E.P</label></td>
		<td class="input"><input type="text" name="company_cep" id="company_cep" /></td>
		<td class="label_right"></td>
		<td></td>
	</tr>
	<tr>
		<td class="label"><label for="company_cargo">Cargo/Depto/Área</label></td>
		<td class="input"><input type="text" name="company_cargo" id="company_cargo" /></td>
		<td class="label_right"><label for="company_email_pro">Email profissional</label></td>
		<td class="input_right"><label for="company_email_pro"><input type="text" name="company_email_pro" id="company_email_pro" /></td>
	</tr>	
</table>