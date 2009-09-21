<?php /* Smarty version 2.6.23, created on 2009-09-06 10:46:56
         compiled from actions/School/Entries/addTeacher.tpl */ ?>
<h3>Cadastro de Professores</h3>
<div class="erros">
	<ol>
		<li><label for="firstname" 	class="error">Insira o <b>nome</b> do professor.</label></li>
		<li><label for="lastname" class="error">Insira o <b>sobrenome</b> do professor.</label></li>
		<li><label for="cpf" class="error">Insira um <b>CPF</b> válido.</label></li>
		<li><label for="acronym" class="error">Insira uma <b>sigla</b> para o professor.</label></li>
		<li><label for="email" class="error">Insira um <b>email</b> válido.</label></li>
		<li><label for="language_1" class="error">Preencha o <b>idioma</b> do professor.</label></li>
	</ol>
</div>
<form method="POST" class="form" action="Admin/School/Entries/Teachers/Save">
<fieldset id="student">
<legend> Dados Pessoais </legend>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="firstname">Nome:&nbsp;</label></td>
		<td class="input"><input type="text" name="firstname" id="firstname" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
		<td class="label"><label for="lastname">Sobrenome:&nbsp;</label></td>
		<td class="input"><input type="text" name="lastname" id="lastname" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
	</tr>
	<tr>
		<td class="label"><label for="cpf">CPF:&nbsp;</label></td>
		<td class="input"><input type="text" name="cpf" id="cpf" class="<?php echo '{validate:{required:true, cpf:true}}'; ?>
" /></td>
		<td class="label"><label for="rg">RG:&nbsp;</label></td>
		<td class="input"><input type="text" name="rg" id="rg" /></td>
	</tr>
	<tr>
		<td class="label"><label for="acronym">Sigla:&nbsp;</label></td>
		<td class="input"><input type="text" name="acronym" id="acronym" size="4" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
		<td class="label"><label for="email">Email:&nbsp;</label></td>
		<td class="input"><input type="text" name="email" id="email" class="<?php echo '{validate:{required:true, email:true}}'; ?>
" /></td>
	</tr>
	<tr>
		<td class="label"><label for="tel_cel">Celular:&nbsp;</label></td>
		<td class="input"><input type="text" name="tel_cel" id="tel_cel" /></td>
		<td class="label"><label for="tel_res">Telefone Residencial:&nbsp;</label></td>
		<td class="input"><input type="text" name="tel_res" id="tel_res" /></td>
	</tr>
	
</table>
</fieldset>
<fieldset id="contact">
<legend> Endereço </legend>
<table class="tbgerais">
	<tr>
		<td class="label" width="10%"><label for="address">Endereço:&nbsp;</label></td>
		<td class="input" width="60%"><input type="text" name="address" id="address" size="30" /></td>
		<td class="label" width="20%"><label for="number">&nbsp;Número:&nbsp;</label></td>
		<td class="input" width="10%"><input type="text" name="number" id="number" size="5" />
	</tr>
	<tr>
		<td class="label"><label for="complement">Complemento:&nbsp;</label></td>
		<td class="input"><input type="text" name="complement" id="complement" size="30" /></label></td>
		<td class="label"><label for="district">Bairro:&nbsp;</label></td>
		<td class="input"><input type="text" name="district" id="district" size="15" /></td>
	</tr>
</table>
<table class="tbgerais">
	<tr>
		<td class="label"><label for="country_id">País:&nbsp;</label></td>
		<td class="input">	<select name="country_id" id="country_id" onchange="trocaDom(this, this.value)">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country"></span>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="state_id">Estado:&nbsp;</label></td>
		<td class="input">	<select name="state_id" id="state_id" onchange="populate('city',null,this.value, null, 'city_id')">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="state_foreign" id="state_foreign" />
			<span id="loader_state" name="loader_state"></span>		
		</td>
	</tr>
	<tr>
		<td class="label"><label for="city_id">Cidade:&nbsp;</label></td>
		<td class="input">	<select name="city_id" id="city_id">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="city_foreign" id="city_foreign" />
			<span id="loader_city" name="loader_city"></span>
		</td>
	</tr>
</table>

</fieldset>
<fieldset id="profissional">
<legend>Dados Profissionais</legend>
	<table id="teacher_pro">
		<tr>
			<td width="60px"><label for="language">Idioma:&nbsp;</label></td>
			<td width="120px">
				<select name="language_1" id="language_1" class="<?php echo '{validate:{required:true}}'; ?>
">
					<option value="">Selecione...</option>
					<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['languages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['languages'][$this->_sections['l']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['languages'][$this->_sections['l']['index']]['name']; ?>
</option>
					<?php endfor; endif; ?>
				</select>
			</td>
			<td width="80px"><label for="pronunciation_1">Pronúncia:&nbsp;</label></td>
			<td><input type="text" name="pronunciation_1" id="pronunciation_1" size="10" /></td>
			<td width="100px"><label for="ntredacao_1">Nota redação:&nbsp;</label></td>
			<td><input type="text" name="ntredacao_1" id="ntredacao_1" size="5" /></td>
			<td width="80px"><label for="ntteste_1">Nota teste:&nbsp;</label></td>
			<td><input type="text" name="ntteste_1" id="ntteste_1" size="5" /></td>
			<td><a href="javascript:void(0)" item="1" onclick="addInput(this, this.getAttribute('item'))"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/add.png" /></a></td>
		</tr>		
	</table>
	<table class="tbgerais">
		<tr>
			<td class="label"><label for="day_disp">Dias disponíveis:&nbsp;</label></td>
			<td class="input"><textarea name="day_disp" id="day_disp"></textarea></td>
		</tr>
	</table>
</fieldset>
<fieldset id="dados_bancarios">
	<legend>Dados Bancários</legend>
	
	<div id="box_bank"><br />
		<center><strong>O professor possui conta bancária?</strong></center>
		<center>
			Sim&nbsp;<input type="radio" name="possui_bank" id="possui_bank" checked="checked" value="0" onclick="toggleBank(0)" />&nbsp;
			<input type="radio" name="possui_bank" id="possui_bank" value="1" onclick="toggleBank(1)" />&nbsp;Não
		</center>
	</div>
	<br />
	<div id="bank">
		<table class="tbgerais">
			<tr>
				<td class="label"><label for="bank_name">Banco:&nbsp;</label></td>
				<td class="input"><input type="text" name="bank_name" id="bank_name" size="10" /></td>
			</tr>
			<tr>
				<td class="label"><label for="ag_bank">Agência:&nbsp;</label></td>
				<td class="input"><input type="text" name="ag_bank" id="ag_bank" size="10" /></td>
			</tr>
			<tr>
				<td class="label"><label for="account">Conta:&nbsp;</label></td>
				<td class="input"><input type="text" name="account_bank" id="account_bank" size="10" /></td>
			</tr>
		</table>
	</div>
	<div id="notbank">
		<center><h4>Pagamento diretamente em mãos.</h4></center>
	</div>
</fieldset>
<center>Data de admissão:&nbsp;<input type="text" name="date_admission" id="date_admission" value="<?php echo $this->_tpl_vars['date_admission']; ?>
" size="10" /></center>
<br />
<center>	<input type="submit" value="Cadastrar" />
			<input type="reset" value="Zerar campos" />
</center>
</form>