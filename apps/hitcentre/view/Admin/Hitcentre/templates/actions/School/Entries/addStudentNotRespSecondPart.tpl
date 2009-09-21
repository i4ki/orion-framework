<h3>Cadastro de Aluno :: Segunda Parte</h3>
<br />
<div class="erros">
<ol>
	<li><label for="student_firstname" 	class="error">Insira o <b>nome</b> do estudante</label></li>
	<li><label for="student_lastname"	class="error">Insira o <b>sobrenome</b> do estudante.</label></li>
	<li><label for="student_cpf"		class="error">Insira o número do <b>CPF</b> do estudante.</label></li>
	<li><label for="student_rg"			class="error">Insira o <b>RG</b> do estudante.</label></li>
	<li><label for="student_grade_school" class="error">Insira o <b>grau escolar</b> do estudante.</label></li>
	<li><label for="student_email_part"	class="error">Insira o <b>email</b> do estudante.</label></li>
	<li><label for="student_birthday"	class="error">Insira a <b>data de nascimento</b>.</label></li>
	<li><label for="student_tel_res"	class="error">Insira um <b>telefone residencial</b>.</label></li> 
	<li><label for="student_nationality" class="error">Insira a <b>nacionalidade </b> do estudante.</label></il>
	<li><label for="student_address"	class="error">Insira o <b>endereço</b> do estudante.</label></li>
	<li><label for="student_district"	class="error">Insira o <b>bairro</b> do estudante.</label></li>
	<li><label for="student_country_id"	class="error">Insira o <b>país</b> do estudante.</label></li>
	<li><label for="student_state_id"	class="error">Insira o <b>estado</b> do estudante.</label></li>
	<li><label for="student_city_id"	class="error">Insira a <b>cidade</b> do estudante.</label></li>
</ol>
</div>
<form method="POST" class="form" action="Admin/School/Entries/Students/ThirdPart">
<div id="form_entry" name="form_entry">
	<fieldset id="student">
		<legend>Dados do Aluno</legend>
		<table class="tbgerais">
	<tr>
		<td class="label"><label for="student_firstname">Nome:</label></td>
		<td class="input"><input type="text" name="student_firstname" id="student_firstname" maxlength="255" class="{literal}{validate:{required:true}}{/literal}" /></td>
		<td class="label_right">
			<label for="student_lastname">Sobrenome:</label>
		</td>
		<td class="input_right">
			<input type="text" name="student_lastname" id="student_lastname" maxlength="255" class="{literal}{validate:{required:true}}{/literal}" />
		</td>
	</tr>
	<tr>
		<td class="label"><label for="student_cpf">C.P.F.:</label></td>
		<td class="input"><input type="text" name="student_cpf" id="student_cpf" maxlength="14" class="{literal}{validate:{required:true,cpf:true}}{/literal}" /></td>
		<td class="label_right"><label for="student_rg">R.G.:</label></td>
		<td class="input_right"><input type="text" name="student_rg" id="student_rg" maxlength="20" class="{literal}{validate:{required:true}}{/literal}" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_grade_school">Grau de escolaridade:</label></td>
		<td class="input">
			<select name="student_grade_school" id="student_grade_school" style="width:160px;" class="{literal}{validate:{required:true}}{/literal}" />
				<option value="">Selecione...</option>
				{section loop=$grade_school name=g}
					<option value="{$grade_school[g].id}">{$grade_school[g].name}</option>
				{/section}
			</select>
		</td>
		<td class="label_right"><label for="student_civil_status">Estado Civil</label></td>
		<td class="input">
			<select name="student_civil_status" id="student_civil_status" class="{literal}{validate:{required:true}}{/literal}">
				<option value="">Selecione...</option>
				{section name=c loop=$civil_status}
					<option value="{$civil_status[c].id}">{$civil_status[c].name}</option>
				{/section}
			</select>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="student_email">Email particular:</label></td>
		<td class="input"><input type="text" name="student_email_part" id="student_email_part" maxlength="200" class="{literal}{validate:{required:true, email:true}}{/literal}" /></td>
		<td class="label_right"><label for="student_birthday">Data de Nascimento</label></td>
		<td class="input_right"><input type="text" name="student_birthday" id="student_birthday" maxlength="10" class="{literal}{validate:{required:true}}{/literal}" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_tel_res">Telefone residencial</label></td>
		<td class="input"><input type="text" name="student_tel_res" id="student_tel_res" class="{literal}{validate:{required:true}}{/literal}" /></td>
		<td class="label_right"><label for="student_tel_cel">Telefone celular</label></td>
		<td class="input_right"><input type="text" name="student_tel_cel" id="student_tel_cel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_nationality">Nacionalidade</label></td>
		<td class="input"><input type="text" name="student_nationality" id="student_nationality" value="Brasileiro" class="{literal}{validate:{required:true}}{/literal}" /></td>
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
		<td class="input"><input type="text" name="student_address" id="student_address" size="30" class="{literal}{validate:{required:true}}{/literal}" /></td>
		<td class="label"><label for="student_number">Número:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_number" id="student_number" size="5" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_complement">Complemento:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_complement" id="student_complement" size="30" /></td>
		<td class="label"><label for="student_district">Bairro&nbsp;</label></td>
		<td class="input"><input type="text" name="student_district" id="student_district" size="10" class="{literal}{validate:{required:true}}{/literal}" /></td>
	</tr>
</table>
<table class="tb2">
	<tr>
		<td class="label_right"><label for="student_country_id">País&nbsp;</label></td>
		<td class="input_right">	<select name="student_country_id" id="student_country_id" style="float:left" onchange="trocaDom(this, this.value, 'student')" class="{literal}{validate:{required:true}}{/literal}">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country" style="float:right;"></span>
		</td>
		<td class="label_right"><label for="student_state_id">Estado&nbsp;</label></td>
		<td class="input_right">	<select style="float:left;" name="student_state_id" id="student_state_id" onchange="populate('city',null,this.value, null,'student_city_id')" class="{literal}{validate:{required:true}}{/literal}">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="student_state_foreign" id="student_state_foreign" />
			<span id="loader_state" name="loader_state" style="float:right;"></span>
		</td>
		<td class="label_right"><label for="student_city_id">Cidade&nbsp;</label></td>
		<td class="input_right">	<select style="float:left;" name="student_city_id" id="student_city_id" class="{literal}{validate:{required:true}}{/literal}">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="student_city_foreign" style="float:right;" id="student_city_foreign" />
			<span id="loader_city" name="loader_city"></span>
		</td>
	</tr>	
</table>
</center>
<center>CEP:&nbsp;<input type="text" name="student_cep" id="student_cep" size="10" /></center>
</fieldset>
<center>
Endereço para correspondências:&nbsp;
<select name="end_corresp" id="end_corresp">
	<option value="0">Residencial</option>
	<option value="1">Comercial</option>
</select>
</center>
<br />
<center><input type="reset" value="Limpar" /><input type="submit" value="Enviar" /></center>