<?php /* Smarty version 2.6.23, created on 2009-09-07 11:42:03
         compiled from actions/School/Entries/addStudentNotRespSecondPart.tpl */ ?>
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
		<td class="input"><input type="text" name="student_firstname" id="student_firstname" maxlength="255" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
		<td class="label_right">
			<label for="student_lastname">Sobrenome:</label>
		</td>
		<td class="input_right">
			<input type="text" name="student_lastname" id="student_lastname" maxlength="255" class="<?php echo '{validate:{required:true}}'; ?>
" />
		</td>
	</tr>
	<tr>
		<td class="label"><label for="student_cpf">C.P.F.:</label></td>
		<td class="input"><input type="text" name="student_cpf" id="student_cpf" maxlength="14" class="<?php echo '{validate:{required:true,cpf:true}}'; ?>
" /></td>
		<td class="label_right"><label for="student_rg">R.G.:</label></td>
		<td class="input_right"><input type="text" name="student_rg" id="student_rg" maxlength="20" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_grade_school">Grau de escolaridade:</label></td>
		<td class="input">
			<select name="student_grade_school" id="student_grade_school" style="width:160px;" class="<?php echo '{validate:{required:true}}'; ?>
" />
				<option value="">Selecione...</option>
				<?php unset($this->_sections['g']);
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['grade_school']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['grade_school'][$this->_sections['g']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['grade_school'][$this->_sections['g']['index']]['name']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
		</td>
		<td class="label_right"><label for="student_civil_status">Estado Civil</label></td>
		<td class="input">
			<select name="student_civil_status" id="student_civil_status" class="<?php echo '{validate:{required:true}}'; ?>
">
				<option value="">Selecione...</option>
				<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['civil_status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['civil_status'][$this->_sections['c']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['civil_status'][$this->_sections['c']['index']]['name']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label"><label for="student_email">Email particular:</label></td>
		<td class="input"><input type="text" name="student_email_part" id="student_email_part" maxlength="200" class="<?php echo '{validate:{required:true, email:true}}'; ?>
" /></td>
		<td class="label_right"><label for="student_birthday">Data de Nascimento</label></td>
		<td class="input_right"><input type="text" name="student_birthday" id="student_birthday" maxlength="10" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_tel_res">Telefone residencial</label></td>
		<td class="input"><input type="text" name="student_tel_res" id="student_tel_res" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
		<td class="label_right"><label for="student_tel_cel">Telefone celular</label></td>
		<td class="input_right"><input type="text" name="student_tel_cel" id="student_tel_cel" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_nationality">Nacionalidade</label></td>
		<td class="input"><input type="text" name="student_nationality" id="student_nationality" value="Brasileiro" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
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
		<td class="input"><input type="text" name="student_address" id="student_address" size="30" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
		<td class="label"><label for="student_number">Número:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_number" id="student_number" size="5" /></td>
	</tr>
	<tr>
		<td class="label"><label for="student_complement">Complemento:&nbsp;</label></td>
		<td class="input"><input type="text" name="student_complement" id="student_complement" size="30" /></td>
		<td class="label"><label for="student_district">Bairro&nbsp;</label></td>
		<td class="input"><input type="text" name="student_district" id="student_district" size="10" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
	</tr>
</table>
<table class="tb2">
	<tr>
		<td class="label_right"><label for="student_country_id">País&nbsp;</label></td>
		<td class="input_right">	<select name="student_country_id" id="student_country_id" style="float:left" onchange="trocaDom(this, this.value, 'student')" class="<?php echo '{validate:{required:true}}'; ?>
">
								<option value="0">Selecione...</option>
							</select>
			<span id="loader_country" name="loader_country" style="float:right;"></span>
		</td>
		<td class="label_right"><label for="student_state_id">Estado&nbsp;</label></td>
		<td class="input_right">	<select style="float:left;" name="student_state_id" id="student_state_id" onchange="populate('city',null,this.value, null,'student_city_id')" class="<?php echo '{validate:{required:true}}'; ?>
">
								<option value="0">Selecione...</option>
							</select>
			<input type="text" name="student_state_foreign" id="student_state_foreign" />
			<span id="loader_state" name="loader_state" style="float:right;"></span>
		</td>
		<td class="label_right"><label for="student_city_id">Cidade&nbsp;</label></td>
		<td class="input_right">	<select style="float:left;" name="student_city_id" id="student_city_id" class="<?php echo '{validate:{required:true}}'; ?>
">
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