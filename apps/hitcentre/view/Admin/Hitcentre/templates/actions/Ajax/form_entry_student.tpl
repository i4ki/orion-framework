<input type="hidden" name="tipo" id="tipo" value="resp" />
<input type="hidden" name="nr_contract" id="nr_contract" value="" />
<fieldset id="student">
<legend>Aluno</legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label>N&deg; Contrato:&nbsp;</label></td>
		<td class="input"><span id="nr_contrato" style="font-weight: bold;"></span></td>
		<td class="label"><label for="data_contrato">Data do contrato:&nbsp;</label></td>
		<td class="input"><input type="text" name="date_contract" id="date_contract" size="8" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_firstname">Nome:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_firstname" id="student_firstname" maxlength="255" class="{validate:{required:true}}" size="20" /></td>
		<td class="label">
			<label for="student_lastname">Sobrenome:&nbsp;</label>
		</td>
		<td class="input">
			<input type="text" name="student_lastname" id="student_lastname" maxlength="255" class="{validate:{required:true}}" />
		</td>
	</tr>
	<tr>
		<td class="label"><label for="student_cpf">C.P.F.:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_cpf" id="student_cpf" maxlength="14" class="{validate:{required:true, cpf:true}}" /></td>
		<td class="label"><label for="student_rg">R.G.:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_rg" id="student_rg" maxlength="20" class="{validate:{required:true}}" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_grade_school">Grau de escolaridade:&nbsp;</label></td>
		<td class="input">
			<select name="student_grade_school" id="student_grade_school" style="width:180px;" class="{validate:{required:true}}">
				<option value="1">Ensino Médio completo</option>
				<option value="2">Ensino Médio incompleto</option>
				<option value="3">Superior completo</option>
				<option value="4">Superior incompleto</option>
				<option value="5">Ensino Fundamental completo</option>
				<option value="6">Ensino Fundamental incompleto</option>
				<option value="7">Primário</option>				
			</select>
		</td>
		<td class="label"><label for="student_civil_status">Estado Civil:&nbsp;</label></td>
		<td class="input">
			<select name="student_civil_status" id="student_civil_status" class="{validate:{required:true}}">
				<option value="1">Solteiro (a)</option>
				<option value="2">Casado (a)</option>
				<option value="3">Viúvo (a)</option>
				<option value="4">Divorciado (a)</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="student_email">Email particular:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_email_part" id="student_email_part" maxlength="200" class="{validate:{required:true, email:true}}" /></td>
		<td class="label"><label for="student_birthday">Data de Nascimento:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_birthday" id="student_birthday" maxlength="10" class="{validate:{required:true}}" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_tel_res">Telefone residencial:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_tel_res" id="student_tel_res" class="{validate:{required:true}}" /></td>
		<td class="label"><label for="student_tel_cel">Telefone celular:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_tel_cel" id="student_tel_cel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_nacionalidade">Nacionalidade:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_nationality" id="student_nationality" value="Brasileiro" class="{validate:{required:true}}" /></td>
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
		<td class="label"><label for="student_address">Endereço:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_address" id="student_address" size="30" class="{validate:{required:true}}" /></td>
		<td class="label"><label for="number">Número:&nbsp;</label>
		<td class="input"><input type="text" name="student_number" id="student_number" size="5" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_complement">Complemento:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_complement" id="student_complement" size="30" /></td>
		<td class="label"><label for="student_district">Bairro:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_district" id="student_district" size="15" class="{validate:{required:true}}" /></td>
	</tr>
</table>
<table class="tb2">
	<tr>
		<td width="100px"><label for="student_country_id">País:&nbsp;</label></td>
		<td class="input">	<select name="student_country_id" id="student_country_id" style="float:left;" onchange="trocaDom(this, this.value, 'student')" class="{validate:{required:true}}">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country" style="float:right;"></span>
		</td>
		<td width="100px"><label for="student_state_id">Estado:&nbsp;</label></td>
		<td class="input" width="50px">	<select style="float:left;" name="student_state_id" id="student_state_id" onchange="populate('city',null,this.value, null, 'student_city_id')" class="{validate:{required:true}}">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="student_state_foreign" id="student_state_foreign" />
			<span id="loader_state" name="loader_state" style="float:right;"></span>
		</td>
		<td width="100px"><label for="student_city_id">Cidade:&nbsp;</label></td>
		<td class="input">	<select style="float:left;" name="student_city_id" id="student_city_id" class="{validate:{required:true}}">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="student_city_foreign" style="float:right;" id="student_city_foreign" />
			<span id="loader_city" name="loader_city"></span>
		</td>
	</tr>	
</table><br />
CEP:&nbsp;<input type="text" name="student_cep" id="student_cep" size="8" class="{validate:{required:true}}" />
</center>
</fieldset>

<fieldset id="pro">
<legend>Dados Profissionais</legend>
<center>
	<select name="company_id" id="company_id" style="width:160px;" onchange="getCompany(this.value)">
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
