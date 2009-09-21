<input type="hidden" name="tipo" id="tipo" value="not_resp" />
<fieldset id="student">
<legend>Pai ou Responsável Financeiro</legend>
<table class="tbgerais">
	
	<tr>
		<td class="label"><label for="nr_contrato">N&deg; Contrato</label></td>
		<td class="input"><input type="text" name="nr_contrato" id="nr_contrato" /></td>
		<td class="label_right"><label for="data_contrato">Data do contrato</label></td>
		<td class="input_right"><input type="text" name="data_contrato" id="data_contrato" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_firstname">Nome:</label></td>
		<td class="input"><input type="text" name="resp_firstname" id="resp_firstname" /></td>
		<td class="label"><label for="resp_lastname">Sobrenome:</label></td>
		<td class="input"><input type="text" name="resp_lastname" id="resp_lastname" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_cpf">C.P.F.:</label></td>
		<td class="input"><input type="text" name="resp_cpf" id="resp_cpf" /></td>
		<td class="label_right"><label for="resp_rg">R.G.:</label></td>
		<td class="input_right"><input type="text" name="resp_rg" id="resp_rg" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_estado_civil">Estado Civil</label></td>
		<td class="input"><input type="text" name="resp_estado_civil" id="resp_estado_civil" /></td>
		<td class="label_right"><label for="resp_nacionalidade">Nacionalidade</label></td>
		<td class="input_right"><input type="text" name="resp_nacionalidade" id="resp_nacionalidade" value="Brasileiro" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_tel_res">Telefone residencial</label></td>
		<td class="input"><input type="text" name="resp_tel_res" id="resp_tel_res" /></td>
		<td class="label_right"><label for="resp_tel_cel">Telefone celular</label></td>
		<td class="input_right"><input type="text" name="resp_tel_cel" id="resp_tel_cel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="resp_email">Email</label></td>
		<td class="input"><input type="text" name="resp_email" id="resp_email" /></td>
		<td></td>
		<td></td>
	</tr>
</table>
</fieldset>
<fieldset id="address">
<legend>Endereço</legend>
<table class="tb4">
	<tr>
		<td class="label"><label for="resp_address">Endereço</label></td>
		<td class="input" colspan="3"><input type="text" name="resp_address" id="resp_address" size="55" /></td>
	</tr>
	<tr>
		<td class="label_right"><label for="resp_district">Bairro</label></td>
		<td class="input_right"><input type="text" name="resp_district" id="resp_district" /></td>
		<td class="label_right"><label for="country">País</label></td>
		<td class="input_right">	<select name="country" id="country" onchange="trocaDom(this, this.value)">
										<option value="0">Selecione...</option>
									</select>
			<span id="loader_country"></span>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="state">Estado</label></td>
		<td class="input">	<select name="state" id="state" onchange="populate('city',null,this.value)">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_state"></span>
			<input type="text" name="state_input" id="state_input" />
		</td>
		<td class="label_right"><label for="city">Cidade</label></td>
		<td class="input_right">	<select name="city" id="city">
										<option value="0">Selecione...</option>
									</select>
			<span id="loader_city"></span>
			<input type="text" name="city_input" id="city_input" />
		</td>
	</tr>
	<tr>
		<td class="label"><label for="cep">CEP</label></td>
		<td class="input"><input type="text" name="cep" id="cep" /></td>
		<td></td>
		<td></td>
	</tr>
</table>
</fieldset>