<input type="hidden" name="tipo" id="tipo" value="not_resp" />
<input type="hidden" name="nr_contract" id="nr_contract" value="" />
<fieldset id="student">
<legend>Pai ou Responsável Financeiro</legend>
<table class="tbgerais">
	
	<tr>
		<td class="label"><label for="nr_contrato">N&deg; Contrato:&nbsp;</label></td>
		<td class="input"><span id="nr_contrato" style="font-weight:bold;"></span></td>
		<td class="label"><label for="date_contract">Data do contrato:&nbsp;</label></td>
		<td class="input"><input type="text" name="date_contract" id="date_contract" class="{validate:{required:true}}" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_firstname">Nome:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_firstname" id="resp_firstname" class="{validate:{required:true}}" size="20" /></td>
		<td class="label"><label for="resp_lastname">Sobrenome:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_lastname" id="resp_lastname" class="{validate:{required:true}}" size="20" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_cpf">C.P.F.:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_cpf" id="resp_cpf" class="{validate:{required:true,cpf:true}}" size="20" /></td>
		<td class="label"><label for="resp_rg">R.G.:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_rg" id="resp_rg" class="{validate:{required:true}}" size="20" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_civil_status">Estado Civil:&nbsp;</label></td>
		<td class="input">
			<select name="resp_civil_status" id="resp_civil_status">
				<option value="1">Solteiro (a)</option>
				<option value="2">Casado (a)</option>
				<option value="3">Viúvo (a)</option>
				<option value="4">Divorciado (a)</option>				
			</select>
		</td>
		<td class="label"><label for="resp_nationality">Nacionalidade:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_nationality" id="resp_nationality" value="Brasileiro" class="{validate:{required:true}}" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_tel_res">Telefone residencial:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_tel_res" id="resp_tel_res" class="{validate:{required:true}}" /></td>
		<td class="label"><label for="resp_tel_cel">Telefone celular:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_tel_cel" id="resp_tel_cel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_email">Email:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_email" id="resp_email" class="{validate:{required:true, email:true}}" /></td>
		<td></td>
		<td></td>
	</tr>
</table>
</fieldset>
<fieldset id="address">
<legend>Endereço</legend>
<table class="tb4">
	<tr>
		<td class="label"><label for="resp_address">Endereço:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_address" id="resp_address" size="20" class="{validate:{required:true}}" /></td>
		<td class="label"><label for="resp_number">Número:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_number" id="resp_number" size="5" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_complement">Complemento:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_complement" id="resp_complement" /></td>
		<td class="label"><label for="resp_district">Bairro:&nbsp;</label></td>
		<td class="input"><input type="text" name="resp_district" id="resp_district" class="{validate:{required:true}}" /></td>
	</tr>
	<tr>
		<td class="label"><label for="country">País:&nbsp;</label></td>
		<td class="input">	<select id="country_id" name="country_id" onchange="trocaDom(this, this.value)" class="{validate:{required:true}}">
										<option value="0">Selecione...</option>
									</select>
			<span id="loader_country"></span>
		</td>
		<td class="label"><label for="state_id">Estado:&nbsp;</label></td>
		<td class="input">	<select name="state_id" id="state_id" onchange="populate('city',null,this.value, null, 'city_id')" class="{validate:{required:true}}">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_state"></span>
			<input type="text" name="state_foreign" id="state_foreign" />
		</td>
	</tr>
	<tr>
		<td class="label"><label for="city_id">Cidade:&nbsp;</label></td>
		<td class="input">	<select name="city_id" id="city_id" class="{validate:{required:true}}">
										<option value="0">Selecione...</option>
									</select>
			<span id="loader_city"></span>
			<input type="text" name="city_foreign" id="city_foreign" />
		</td>
		<td class="label"><label for="cep">CEP:&nbsp;</label></td>
		<td class="input"><input type="text" name="cep" id="cep" class="{validate:{required:true}}" /></td>
		<td></td>
		<td></td>
	</tr>
</table>
</fieldset>