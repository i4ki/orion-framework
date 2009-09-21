<?php /* Smarty version 2.6.23, created on 2009-07-28 02:09:58
         compiled from actions/School/Entries/Company/add.tpl */ ?>
<h3>Cadastro de Empresas</h3>
<form method="POST" class="form" action="Admin/School/Entries/Students">
<fieldset id="student">
<legend> Empresa </legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="name">Nome</label></td>
		<td class="input"><input type="text" name="name" id="name" /></td>
	</tr>
	<tr>
		<td class="label"><label for="cnpj">CNPJ</label></td>
		<td class="input"><input type="text" name="cnpj" id="cnpj" /></td>
	</tr>
	<tr>
		<td class="label"><label for="email_contact">Email (contato)</label></td>
		<td class="input"><input type="text" name="email_contact" id="email_contact" /></td>
	</tr>
	<tr>
		<td class="label"><label for="email_finance">Email (financeiro)</label></td>
		<td class="input"><input type="text" name="email_finance" id="email_finance" /></td>
	</tr>
</table>
</fieldset>
<fieldset id="contact">
<legend> Contato </legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="address">Endereço</label></td>
		<td class="input"><input type="text" name="address" id="address" /></td>
	</tr>
	<tr>
		<td class="label"><label for="district">Bairro</label></td>
		<td class="input"><input type="text" name="district" id="district" /></td>
	</tr>
	<tr>
		<td class="label"><label for="country">País</label></td>
		<td class="input">	<select name="country" id="country" onchange="populate('country',this.value)">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country"></span>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="state">Estado</label></td>
		<td class="input">	<select name="state" id="state">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="state_input" id="state_input" />
			<span id="loader_state" name="loader_state"></span>		
		</td>
	</tr>
	<tr>
		<td class="label"><label for="city">Cidade</label></td>
		<td class="input">	<select name="city" id="city">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="city_input" id="city_input" />
			<span id="loader_city" name="loader_city"></span>
		</td>
	</tr>
</table>
<center>	<input type="submit" value="Cadastrar" />
			<input type="reset" value="Zerar campos" /></center>

</fieldset>
</form>