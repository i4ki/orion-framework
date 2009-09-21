<?php /* Smarty version 2.6.23, created on 2009-07-29 14:40:41
         compiled from actions/School/Entries/Students/add.tpl */ ?>
<form method="POST" class="form" action="Admin/School/Entries/Students">
<fieldset id="student">
<legend>Aluno</legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label id="matricula">Matrícula</label></td>
		<td class="input"><input type="text" name="matricula" id="matricula" /></td>
	</tr>
	<tr>
		<td class="label"><label for="firstname">Nome:</label></td>
		<td class="input"><input type="text" name="firstname" id="firstname" /></td>
	</tr>
	<tr>
		<td class="label"><label for="lastname">Sobrenome:</label></td>
		<td class="input"><input type="text" name="lastname" id="lastname" /></td>
	</tr>
	<tr>
		<td class="label"><label for="cpf">C.P.F.:</label></td>
		<td class="input"><input type="text" name="cpf" id="cpf" /></td>
	</tr>
	<tr>
		<td class="label"><label for="rg">R.G.:</label></td>
		<td class="input"><input type="text" name="rg" id="rg" /></td>
	</tr>
	<tr>
		<td class="label"><label for="birthday">Data de nascimento:</label></td>
		<td class="input"><input type="text" name="birthday" id="birthday" /></td>
	</tr>
	<tr>
		<td class="label"><label for="company">Empresa:</label></td>
		<td class="input">	<select name="company" id="company">
								<option value="0">Nenhuma</option>
							</select>
		</td>
	</tr>
</table>
</fieldset>
<fieldset id="address">
<legend>Endereço</legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="country">País</label></td>
		<td class="input">	<select name="country" id="country" onchange="trocaDom(this, this.value)">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country"></span>	
		</td>
	</tr>
	<tr>
		<td class="label"><label for="street">Endereço</label></td>
		<td class="input"><input type="text" name="street" id="street" /></td>
	</tr>
	<tr>
		<td class="label"><label for="district">Bairro</label></td>
		<td class="input"><input type="text" name="district" id="district" /></td>
	</tr>
	<tr>
		<td class="label"><label for="state">Estado</label></td>
		<td class="input">	<select name="state" id="state" onchange="populate('city',<?php echo $this->_tpl_vars['school']['city_id']; ?>
,this.value)">
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
</fieldset>
<fieldset id="pagamentos">
<legend>&nbsp;Pagamento&nbsp;</legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="payment">Forma de pagamento</label></td>
		<td class="input">	<select name="payment" id="payment">
								<option value="0">Selecione...</option>
							</select>
		</td>
	</tr>
</table>
</fieldset>
</form>