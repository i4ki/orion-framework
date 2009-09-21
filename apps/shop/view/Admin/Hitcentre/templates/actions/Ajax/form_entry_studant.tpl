<input type="hidden" name="tipo" id="tipo" value="resp" />
<fieldset id="student">
<legend>Aluno</legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label id="nt_contrato">N&deg; Contrato</label></td>
		<td class="input"><input type="text" name="nr_contrato" id="nr_contrato" /></td>
		<td class="label_right"><label for="data_contrato">Data do contrato</label></td>
		<td class="input_right"><input type="text" name="data_contrato" id="data_contrato" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_firstname">Nome:</label></td>
		<td class="input"><input type="text" name="student_firstname" id="student_firstname" maxlength="255" /></td>
		<td class="label_right">
			<label for="student_lastname">Sobrenome:</label>
		</td>
		<td class="input_right">
			<input type="text" name="student_lastname" id="student_lastname" maxlength="255"/>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="student_cpf">C.P.F.:</label></td>
		<td class="input"><input type="text" name="student_cpf" id="student_cpf" maxlength="14" /></td>
		<td class="label_right"><label for="student_rg">R.G.:</label></td>
		<td class="input_right"><input type="text" name="student_rg" id="student_rg" maxlength="20" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_grade_school">Grau de escolaridade:</label></td>
		<td class="input"><input type="text" name="student_grade_school" id="student_grade_school" maxlength="25" /></td>
		<td class="label_right"><label for="student_civil_status">Estado Civil</label></td>
		<td class="input_right"><input type="text" name="student_civil_status" id="student_civil_status" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_email">Email particular:</label></td>
		<td class="input"><input type="text" name="student_email_part" id="student_email_part" maxlength="200" /></td>
		<td class="label_right"><label for="student_birthday">Data de Nascimento</label></td>
		<td class="input_right"><input type="text" name="student_data_nasc" id="student_data_nasc" maxlength="10" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_tel_res">Telefone residencial</label></td>
		<td class="input"><input type="text" name="student_tel_res" id="student_tel_res" /></td>
		<td class="label_right"><label for="student_tel_cel">Telefone celular</label></td>
		<td class="input_right"><input type="text" name="student_tel_cel" id="student_tel_cel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_nacionalidade">Nacionalidade</label></td>
		<td class="input"><input type="text" name="student_nacionalidade" id="student_nacionalidade" value="Brasileiro" /></td>
		<td></td>
		<td></td>
	</tr>
</table>
</fieldset>

<fieldset id="address">
<legend>Endereço</legend>
<center>
<table class="tb2">
	<tr>
		<td class="label"><label for="student_address">Endereço&nbsp;</label></td>
		<td class="input" colspan="3"><input type="text" name="student_address" id="student_address" size="50" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_district">Bairro&nbsp;</label></td>
		<td class="input"><input type="text" name="student_district" id="student_district" size="15" /></td>
		<td class="label_right"><label for="student_country_id">País&nbsp;</label></td>
		<td class="input_right">	<select name="student_country_id" id="student_country_id" onchange="trocaDom(this, this.value)">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country"></span>
		</td>
	</tr>
	<tr>
		<td class="label_right"><label for="student_state_id">Estado&nbsp;</label></td>
		<td class="input_right">	<select name="student_state_id" id="student_state_id" onchange="populate('city',null,this.value)">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="student_state_input" id="student_state_input" />
			<span id="loader_state" name="loader_state"></span>
		</td>
		<td class="label_right"><label for="student_city_id">Cidade&nbsp;</label></td>
		<td class="input_right">	<select name="student_city_id" id="student_city_id">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="student_city_input" id="student_city_input" />
			<span id="loader_city" name="loader_city"></span>
		</td>
	</tr>
	
	
</table>
</center>
</fieldset>

<fieldset id="pro">
<legend>Dados Profissionais</legend>
<center>
	<select name="company_id" id="company_id" onchange="getCompany(this.value)">
		<option value="0">Nova Empresa</option>
	</select>
</center>
<div id="company_box">
 
</div>
</fieldset>
<br />
<center>
Endereço para correspondências:&nbsp;
<select name="end_corresp" id="end_corresp">
	<option value="0">Residencial</option>
	<option value="1">Comercial</option>
</select>
</center>
<br />
