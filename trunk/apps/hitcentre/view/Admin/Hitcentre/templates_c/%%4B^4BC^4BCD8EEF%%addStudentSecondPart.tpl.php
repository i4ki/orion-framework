<?php /* Smarty version 2.6.23, created on 2009-09-09 14:44:58
         compiled from actions/School/Entries/addStudentSecondPart.tpl */ ?>
<h3>Cadastro de Aluno :: Segunda Parte</h3>
<div class="erros">
	<center><h4>Foi encontrado erros no cadastro:</h4></center>
	<ol>
		<!-- ERROS STUDENT NOT RESPONSIBLE -->
		<li><label for="course_book"	class="error">Insira o <b>nome do livro</b>.</label></li>
		<li><label for="course"			class="error">Preencha o <b>curso</b>.</label></li>
		<li><label for="appraised_for"	class="error">Preencha o campo <b>Avaliado por:</b>.</label></li>
		<li><label for="level"			class="error">Prencha o <b>Nível</b> do aluno.</label></li>
	</ol>
</div>
<form method="POST" class="form" action="Admin/School/Entries/Students/Save">
<div id="form_entry" name="form_entry">
	<fieldset id="pedagogic">
		<legend>Dados Pedagógicos</legend>
		<table class="tbgerais">
			<tr>
				<td class="label"><label for="havechildren">Tem filhos?</label></td>
				<td class="input"><select name="havechildren" id="havechildren" onchange="togglechildren(this.value)">
					<option value="0">Não</option>
					<option value="1">Sim</option>
					</select>
					<span id="t_childrens">Quantos?</span>
					<input type="text" name="childrens" id="childrens" size="4" />
				</td>
			</tr>
			<tr>
				<td class="label"><label for="hobby">Hobby</label></td>
				<td class="input"><input type="text" name="hobby" id="hobby" size="20" /></td>
			</tr>
			<tr>
				<td class="label"><label for="expectations">Expectativas</label></td>
				<td class="input"><textarea name="expectations" id="expectations"></textarea></td>
			</tr>
			<tr>
				<td class="label"><label for="course_book">Curso (nome do Livro)</label></td>
				<td class="input"><input type="text" name="course_book" id="course_book" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="course">Curso</label></td>
				<td class="input">	<select name="course" id="course" style="width:350px;" class="<?php echo '{validate:{required:true}}'; ?>
">
										 <option value="">Selecione...</option>
									<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['courses']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
										<option value="<?php echo $this->_tpl_vars['courses'][$this->_sections['c']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['courses'][$this->_sections['c']['index']]['name']; ?>
 - <?php echo $this->_tpl_vars['courses'][$this->_sections['c']['index']]['language']; ?>
</option>
									<?php endfor; endif; ?>
									</select>
				</td>
			</tr>	
			<tr>
				<td class="label"><label for="appraised_for">Avaliado por:</label></td>
				<td class="input"><input type="text" name="appraised_for" id="appraised_for" class="<?php echo '{validate:{required:true}}'; ?>
"/></td>
			</tr>
			<tr>
				<td class="label"><label for="level">Nível</label></td>
				<td class="input"><input type="text" name="level" id="level" class="<?php echo '{validate:{required:true}}'; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="pays_material">Valor pago do Material</label>
				<td class="input"><input type="pays_material" id="pays_material" name="pays_material" />
			</tr>
			<tr>
				<td class="label"><label for="date_pay_material">Data de pagamento do material</label></td>
				<td class="input"><input type="text" id="date_pay_material" name="date_pay_material" /></td>
			</tr>
			<tr>
				<td class="label"><label for="value_pay_per">Valor pago por hora ou mês:&nbsp;</label></td>
				<td class="input"><input type="text" id="value_pay_per" name="value_pay_per" size="6" />
				<select name="pay_per" id="pay_per">
					<option value="0">por mês</option>
					<option value="1">por hora</option>
				</select>
			</td>
			</tr>
			<tr>
				<td class="label"><label for="value_total_pay_month">Valor total pago por mês</label></td>
				<td class="input"><input type="text" id="value_total_pay_month" name="value_total_pay_month" /></td>
			</tr>
			<tr>
				<td class="label"><label for="value_registration">Valor da matrícula (Cobrada a cada 6 meses)</label></td>
				<td class="input"><input type="text" id="value_registration" name="value_registration" /></td>
			</tr>
			<tr>
				<td class="label"><label for="date_pay_first_monthly">Data de pgto 1&deg; Mensalidade</label></td>
				<td class="input"><input type="text" name="date_pay_first_monthly" id="date_pay_first_monthly" /></td>
			</tr>
			<tr>
				<td class="label"><label for="amount_hours_month">Quantidade horas mês</label></td>
				<td class="input"><input type="text" name="amount_hours_month" id="amount_hours_month" /></td>
			</tr>
			<tr>
				<td class="label"><label for="date_expire">Data de vencimento</label></td>
				<td class="input"><input type="text" name="date_expire" id="date_expire" /></td>
			</tr>
			<tr>
				<td class="label"><label for="observations">Observações</label></td>
				<td class="input"><textarea name="observations" id="observations">O dia da 1&deg; aula deve ser antes ou no mesmo dia do 1&deg; pagamento
				</textarea></td>
			</tr>
		</table>
	</fieldset>
</div>
<center>
	<input type="reset" value="Limpar campos" />
	<input type="submit" value="Seguinte" />
</center>
</form>