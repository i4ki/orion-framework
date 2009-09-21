{literal}
<script type="text/javascript">
	$j(document).ready(function() {
		var country = {/literal}{$student.country_id}{literal};
		
		if( country != 76 )
		{
			trocaDom($j('#student_country_id'), document.getElementById('student_country_id').value, 'student');
		}
	});
</script>
{/literal}
<h3 id="adduser">Editar Estudante</h3>
<form class="form" action="Admin/School/editStudent/{$student.id}" method="POST" enctype="multipart/form-data">
<fieldset id="personal">
	<legend>INFORMAÇÕES PESSOAIS</legend>
	<div class="divAddUser">
		<table class="tbgerais">
			<tr>
				<td class="label"><label for="student_firstname">Nome:&nbsp;</label></td>
				<td class="input"><input name="student_firstname" id="student_firstname" type="text" value="{$student.firstname}" /></td>
				<td class="label"><label for="student_lastname">Sobrenome:&nbsp;</label></td>
				<td class="input"><input name="student_lastname" id="student_lastname" value="{$student.lastname}" type="text" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_cpf">CPF:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_cpf" id="student_cpf" value="{$student.cpf}" /></td>
				<td class="label"><label for="student_rg">RG:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_rg" id="student_rg" value="{$student.rg}" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_gradeschool">Grau escolar:&nbsp;</label></td>
				<td class="input">
					<select name="student_gradeschool" id="student_gradeschool" style="width:180px;">
						<option value="1"{if $student.gradeschool_id == 1} selected="selected"{/if}>Ensino Médio completo</option>
						<option value="2"{if $student.gradeschool_id == 2} selected="selected"{/if}>Ensino Médio incompleto</option>
						<option value="3"{if $student.gradeschool_id == 3} selected="selected"{/if}>Superior completo</option>
						<option value="4"{if $student.gradeschool_id == 4} selected="selected"{/if}>Superior incompleto</option>
						<option value="5"{if $student.gradeschool_id == 5} selected="selected"{/if}>Ensino Fundamental completo</option>
						<option value="6"{if $student.gradeschool_id == 6} selected="selected"{/if}>Ensino Fundamental incompleto</option>
						<option value="7"{if $student.gradeschool_id == 7} selected="selected"{/if}>Primário</option>
					</select>
				</td>
				<td class="label"><label for="student_civilstatus">Estado Civil:&nbsp;</label></td>
				<td class="input">
					<select name="student_civilstatus" id="student_civilstatus" style="width:120px;">
						<option value="1"{if $student.civilstatus_id == 1} selected="selected"{/if}>Solteiro (a)</option>
						<option value="2"{if $student.civilstatus_id == 2} selected="selected"{/if}>Casado (a)</option>
						<option value="3"{if $student.civilstatus_id == 3} selected="selected"{/if}>Viúvo (a)</option>
						<option value="4"{if $student.civilstatus_id == 4} selected="selected"{/if}>Divorciado (a)</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label"><label for="student_email_part">Email:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_email_part" id="student_email_part" value="{$student.email_part}" /></td>
				<td class="label"><label for="student_birthday">Data de nascimento:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_birthday" id="student_birthday" value="{$student.birthday}" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_tel_res">Telefone Residencial:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_tel_res" id="student_tel_res" value="{$student.tel_res}" /></td>
				<td class="label"><label for="text">Telefone Celular:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_tel_cel" id="student_tel_cel" value="{$student.tel_cel}" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_nationality">Nacionalidade:&nbsp;</label></td>
				<td class="input"><input type="text" nam="student_nationality" id="student_nationality" value="{$student.nationality}" /></td>
				<td class="label"></td>
				<td class="input"></td>
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
	<table class="tbgerais">
		<tr>
			<td class="label"><label for="student_address">Endereço:&nbsp;</label></td>
			<td class="input"><input name="student_address" id="student_address" type="text" value="{$student.address}" /></td>
			<td class="label"><label for="student_number">Número:&nbsp;</label></td>
			<td class="input"><input type="text" name="student_number" id="student_number" value="{$student.number}" /></td>
		</tr>
		<tr>
			<td class="label"><label for="student_complement">Complemento:&nbsp;</label></td>
			<td class="input"><input type="text" name="student_complement" id="student_complement" value="{$student.complement}" /></td>
			<td class="label"><label for="student_district">Bairro:&nbsp;</label></td>
			<td class="input"><input type="text" name="student_district" id="student_district" value="{$student.district}" /></td>
		</tr>
		<tr>
			<td class="label"><label for="student_country_id">País:&nbsp;</label></td>
			<td class="input"><select name="student_country_id" id="student_country_id" onchange="trocaDom( this, this.value, 'student' )">
				<option value="0">Selecione...</option>
				{section name=c loop=$countries}
					<option value="{$countries[c].id}"{if $countries[c].id == $student.country_id} selected="selected"{/if}>{$countries[c].name}</option>
				{/section}
				</select>
				<span id="loader_country" name="loader_country"></span>
			</td>
			<td class="label"><label for="student_state_id">Estado:&nbsp;</label></td>
			<td class="input">
			
				<select name="student_state_id" id="student_state_id" onchange="populate('city',null, this.value, null, 'city_id')">
					<option value="0">Selecione...</option>
					{section name=s loop=$states}
						<option value="{$states[s].id}"{if $states[s].id == $student.state_id} selected="selected"{/if}>{$states[s].name}</option>
					{/section}
				</select>
			
				<input type="text" name="student_state_foreign" id="student_state_foreign" value="{$student.state_foreign}" />
			
				<span id="loader_state" name="loader_state"></span>
			</td>
		</tr>
		<tr>
			<td class="label"><label for="student_city_id">Cidade:&nbsp;</label></td>
			<td class="input">
			
			<select name="student_city_id" id="student_city_id">
				<option value="0" size="100">Selecione...</option>
				{section name=c loop=$cities}
					<option value="{$cities[c].id}"{if $cities[c].id == $student.city_id} selected="selected"{/if}>{$cities[c].name}</option>
				{/section}
			</select>
			
			<input type="text" name="student_city_foreign" id="student_city_foreign" value="{$student.city_foreign}" />
			
			<span id="loader_city_id"></span>
			</td>
			<td class="label"><label for="student_cep">C.E.P.:&nbsp;</label></td>
			<td class="input"><input name="student_cep" id="student_cep" type="text" value="{$student.cep}" /></td>
		</tr>
	</table>
	</div>
	<div id="dataAddressError" name="dataAddressError">
	<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
	</div>
	<div class="clear"></div>
	</fieldset>
	{if $student.i_resp == 1}
	<fieldset id="notresponsible">
	<legend>Dados do Responsável Financeiro</legend>
		<table class="tbgerais">
			<tr>
				<td class="label"><label for="resp_firstname">Nome:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_firstname" id="resp_firstname" value="{$resp.firstname}" /></td>
				<td class="label"><label for="resp_lastname">Sobrenome:&nbsp;</label></td>
				<td class="label"><input type="text" name="resp_lastname" id="resp_lastname" value="{$resp.lastname}" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_cpf">CPF:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_cpf" id="resp_cpf" value="{$resp.cpf}" /></td>
				<td class="label"><label for="resp_rg">RG:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_rg" id="resp_rg" value="{$resp.rg}" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_civilstatus">Estado civil:&nbsp;</label></td>
				<td class="input">
					<select name="resp_civilstatus" id="resp_civilstatus">
						{section name=c loop=$civil_status}
							<option value="{$civil_status[c].id}"{if $civil_status[c].id == $resp.civil_status} selected="selected"{/if}>{$civil_status[c].name}</option>
						{/section}
					</select>
				</td>
				<td class="label"><label for="resp_email_part">Email particular:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_email_part" id="resp_email_part" value="{$resp.email_part}" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_email_pro">Email profissional:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_email_pro" id="resp_email_pro" value="{$resp.email_pro}" /></td>
				<td class="label"></td>
				<td></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_address">Endereço:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_address" id="resp_address" value="{$resp.address}" /></td>
				<td class="label"><label for="resp_number">Numero:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_number" id="resp_number" value="{$resp.number}" size="5" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_complement">Complemento:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_complement" id="resp_complement" value="{$resp.complement}" /></td>
				<td class="label"><label for="resp_district">Bairro:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_district" id="resp_district" value="{$resp.district}" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_country">País:&nbsp;</label></td>
				<td class="input">
					<select name="resp_country" id="resp_country" style="width:160px;">
						{section name=c loop=$countries}
							<option value="{$countries[c].id}"{if $countries[c].id == $resp.country_id} selected="selected"{/if}>{$countries[c].name}</option>
						{/section}
					</select>
				</td>
				<td class="label"><label for="resp_state">Estado:&nbsp;</label></td>
				<td class="input">
					<select name="resp_state" id="resp_state" style="width:160px;">
						{section name=s loop=$states}
							<option value="{$states[s].id}"{if $states[s].id == $resp.state_id} selected="selected"{/if}>{$states[s].name}</option>
						{/section}
					</select>
				</td>
			</tr>
			<tr>
				<td class="label"><label for="resp_city">Cidade:&nbsp;</label></td>
				<td class="input">
					<select name="resp_city" id="resp_city" style="width:160px;">
						{section name=c loop=$resp_cities}
							<option value="{$resp_cities[c].id}"{if $resp_cities[c].id == $resp.city_id} selected="selected"{/if}>{$resp_cities[c].name}</option>
						{/section}
					</select>
				</td>
				<td class="label"><label for="resp_cep">CEP:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_cep" id="resp_cep" value="{$resp.cep}" /></td>
			</tr>
			
		</table>		
	</fieldset>
	{else}
	<fieldset id="responsible">
		<legend>Dados Profissionais</legend>
		
		<table class="tbgerais">
			<tr>
				<td class="label">Empresa:&nbsp;</td>
				<td class="input">
					<select name="student_company" id="student_company" style="width:200px;">
						<option value="0">Nova Empresa</option>
						{section name=c loop=$companies}
							<option value="{$companies[c].id}"{if $companies[c].id == $student.company_id} selected="selected"{/if}>{$companies[c].name}</option>
						{/section}
					</select>
				</td>
				<td class="label">
				
			</tr>
		</table>
	</fieldset>
	{/if}
	<div align="center">
	<input id="button1" type="submit" value="Enviar" />
	<input id="button2" type="button" value="Restaurar valores" onclick="location.href='Admin/Users/EditUser/{$user.id}'" />
	</div>
</form>
