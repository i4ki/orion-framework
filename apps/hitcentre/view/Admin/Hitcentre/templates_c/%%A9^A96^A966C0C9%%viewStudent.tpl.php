<?php /* Smarty version 2.6.23, created on 2009-09-10 01:44:05
         compiled from actions/School/viewStudent.tpl */ ?>
<?php echo '
<script type="text/javascript">
	$j(document).ready(function() {
		var country = '; ?>
<?php echo $this->_tpl_vars['student']['country_id']; ?>
<?php echo ';
		
		if( country != 76 )
		{
			trocaDom($j(\'#student_country_id\'), document.getElementById(\'student_country_id\').value, \'student\');
		}
	});
</script>
'; ?>

<h3 id="adduser">Editar Estudante</h3>
<form class="form" action="Admin/School/editStudent/<?php echo $this->_tpl_vars['student']['id']; ?>
" method="POST" enctype="multipart/form-data">
<fieldset id="personal">
	<legend>INFORMAÇÕES PESSOAIS</legend>
	<div class="divAddUser">
		<table class="tbgerais">
			<tr>
				<td class="label"><label for="student_firstname">Nome:&nbsp;</label></td>
				<td class="input"><input name="student_firstname" id="student_firstname" type="text" value="<?php echo $this->_tpl_vars['student']['firstname']; ?>
" /></td>
				<td class="label"><label for="student_lastname">Sobrenome:&nbsp;</label></td>
				<td class="input"><input name="student_lastname" id="student_lastname" value="<?php echo $this->_tpl_vars['student']['lastname']; ?>
" type="text" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_cpf">CPF:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_cpf" id="student_cpf" value="<?php echo $this->_tpl_vars['student']['cpf']; ?>
" /></td>
				<td class="label"><label for="student_rg">RG:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_rg" id="student_rg" value="<?php echo $this->_tpl_vars['student']['rg']; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_gradeschool">Grau escolar:&nbsp;</label></td>
				<td class="input">
					<select name="student_gradeschool" id="student_gradeschool" style="width:180px;">
						<option value="1"<?php if ($this->_tpl_vars['student']['gradeschool_id'] == 1): ?> selected="selected"<?php endif; ?>>Ensino Médio completo</option>
						<option value="2"<?php if ($this->_tpl_vars['student']['gradeschool_id'] == 2): ?> selected="selected"<?php endif; ?>>Ensino Médio incompleto</option>
						<option value="3"<?php if ($this->_tpl_vars['student']['gradeschool_id'] == 3): ?> selected="selected"<?php endif; ?>>Superior completo</option>
						<option value="4"<?php if ($this->_tpl_vars['student']['gradeschool_id'] == 4): ?> selected="selected"<?php endif; ?>>Superior incompleto</option>
						<option value="5"<?php if ($this->_tpl_vars['student']['gradeschool_id'] == 5): ?> selected="selected"<?php endif; ?>>Ensino Fundamental completo</option>
						<option value="6"<?php if ($this->_tpl_vars['student']['gradeschool_id'] == 6): ?> selected="selected"<?php endif; ?>>Ensino Fundamental incompleto</option>
						<option value="7"<?php if ($this->_tpl_vars['student']['gradeschool_id'] == 7): ?> selected="selected"<?php endif; ?>>Primário</option>
					</select>
				</td>
				<td class="label"><label for="student_civilstatus">Estado Civil:&nbsp;</label></td>
				<td class="input">
					<select name="student_civilstatus" id="student_civilstatus" style="width:120px;">
						<option value="1"<?php if ($this->_tpl_vars['student']['civilstatus_id'] == 1): ?> selected="selected"<?php endif; ?>>Solteiro (a)</option>
						<option value="2"<?php if ($this->_tpl_vars['student']['civilstatus_id'] == 2): ?> selected="selected"<?php endif; ?>>Casado (a)</option>
						<option value="3"<?php if ($this->_tpl_vars['student']['civilstatus_id'] == 3): ?> selected="selected"<?php endif; ?>>Viúvo (a)</option>
						<option value="4"<?php if ($this->_tpl_vars['student']['civilstatus_id'] == 4): ?> selected="selected"<?php endif; ?>>Divorciado (a)</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label"><label for="student_email_part">Email:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_email_part" id="student_email_part" value="<?php echo $this->_tpl_vars['student']['email_part']; ?>
" /></td>
				<td class="label"><label for="student_birthday">Data de nascimento:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_birthday" id="student_birthday" value="<?php echo $this->_tpl_vars['student']['birthday']; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_tel_res">Telefone Residencial:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_tel_res" id="student_tel_res" value="<?php echo $this->_tpl_vars['student']['tel_res']; ?>
" /></td>
				<td class="label"><label for="text">Telefone Celular:&nbsp;</label></td>
				<td class="input"><input type="text" name="student_tel_cel" id="student_tel_cel" value="<?php echo $this->_tpl_vars['student']['tel_cel']; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="student_nationality">Nacionalidade:&nbsp;</label></td>
				<td class="input"><input type="text" nam="student_nationality" id="student_nationality" value="<?php echo $this->_tpl_vars['student']['nationality']; ?>
" /></td>
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
			<td class="input"><input name="student_address" id="student_address" type="text" value="<?php echo $this->_tpl_vars['student']['address']; ?>
" /></td>
			<td class="label"><label for="student_number">Número:&nbsp;</label></td>
			<td class="input"><input type="text" name="student_number" id="student_number" value="<?php echo $this->_tpl_vars['student']['number']; ?>
" /></td>
		</tr>
		<tr>
			<td class="label"><label for="student_complement">Complemento:&nbsp;</label></td>
			<td class="input"><input type="text" name="student_complement" id="student_complement" value="<?php echo $this->_tpl_vars['student']['complement']; ?>
" /></td>
			<td class="label"><label for="student_district">Bairro:&nbsp;</label></td>
			<td class="input"><input type="text" name="student_district" id="student_district" value="<?php echo $this->_tpl_vars['student']['district']; ?>
" /></td>
		</tr>
		<tr>
			<td class="label"><label for="student_country_id">País:&nbsp;</label></td>
			<td class="input"><select name="student_country_id" id="student_country_id" onchange="trocaDom( this, this.value, 'student' )">
				<option value="0">Selecione...</option>
				<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['countries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<option value="<?php echo $this->_tpl_vars['countries'][$this->_sections['c']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['countries'][$this->_sections['c']['index']]['id'] == $this->_tpl_vars['student']['country_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['countries'][$this->_sections['c']['index']]['name']; ?>
</option>
				<?php endfor; endif; ?>
				</select>
				<span id="loader_country" name="loader_country"></span>
			</td>
			<td class="label"><label for="student_state_id">Estado:&nbsp;</label></td>
			<td class="input">
			
				<select name="student_state_id" id="student_state_id" onchange="populate('city',null, this.value, null, 'city_id')">
					<option value="0">Selecione...</option>
					<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['states']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?>
						<option value="<?php echo $this->_tpl_vars['states'][$this->_sections['s']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['states'][$this->_sections['s']['index']]['id'] == $this->_tpl_vars['student']['state_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['states'][$this->_sections['s']['index']]['name']; ?>
</option>
					<?php endfor; endif; ?>
				</select>
			
				<input type="text" name="student_state_foreign" id="student_state_foreign" value="<?php echo $this->_tpl_vars['student']['state_foreign']; ?>
" />
			
				<span id="loader_state" name="loader_state"></span>
			</td>
		</tr>
		<tr>
			<td class="label"><label for="student_city_id">Cidade:&nbsp;</label></td>
			<td class="input">
			
			<select name="student_city_id" id="student_city_id">
				<option value="0" size="100">Selecione...</option>
				<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['cities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<option value="<?php echo $this->_tpl_vars['cities'][$this->_sections['c']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['cities'][$this->_sections['c']['index']]['id'] == $this->_tpl_vars['student']['city_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['cities'][$this->_sections['c']['index']]['name']; ?>
</option>
				<?php endfor; endif; ?>
			</select>
			
			<input type="text" name="student_city_foreign" id="student_city_foreign" value="<?php echo $this->_tpl_vars['student']['city_foreign']; ?>
" />
			
			<span id="loader_city_id"></span>
			</td>
			<td class="label"><label for="student_cep">C.E.P.:&nbsp;</label></td>
			<td class="input"><input name="student_cep" id="student_cep" type="text" value="<?php echo $this->_tpl_vars['student']['cep']; ?>
" /></td>
		</tr>
	</table>
	</div>
	<div id="dataAddressError" name="dataAddressError">
	<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
	</div>
	<div class="clear"></div>
	</fieldset>
	<?php if ($this->_tpl_vars['student']['i_resp'] == 1): ?>
	<fieldset id="notresponsible">
	<legend>Dados do Responsável Financeiro</legend>
		<table class="tbgerais">
			<tr>
				<td class="label"><label for="resp_firstname">Nome:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_firstname" id="resp_firstname" value="<?php echo $this->_tpl_vars['resp']['firstname']; ?>
" /></td>
				<td class="label"><label for="resp_lastname">Sobrenome:&nbsp;</label></td>
				<td class="label"><input type="text" name="resp_lastname" id="resp_lastname" value="<?php echo $this->_tpl_vars['resp']['lastname']; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_cpf">CPF:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_cpf" id="resp_cpf" value="<?php echo $this->_tpl_vars['resp']['cpf']; ?>
" /></td>
				<td class="label"><label for="resp_rg">RG:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_rg" id="resp_rg" value="<?php echo $this->_tpl_vars['resp']['rg']; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_civilstatus">Estado civil:&nbsp;</label></td>
				<td class="input">
					<select name="resp_civilstatus" id="resp_civilstatus">
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
"<?php if ($this->_tpl_vars['civil_status'][$this->_sections['c']['index']]['id'] == $this->_tpl_vars['resp']['civil_status']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['civil_status'][$this->_sections['c']['index']]['name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
				<td class="label"><label for="resp_email_part">Email particular:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_email_part" id="resp_email_part" value="<?php echo $this->_tpl_vars['resp']['email_part']; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_email_pro">Email profissional:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_email_pro" id="resp_email_pro" value="<?php echo $this->_tpl_vars['resp']['email_pro']; ?>
" /></td>
				<td class="label"></td>
				<td></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_address">Endereço:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_address" id="resp_address" value="<?php echo $this->_tpl_vars['resp']['address']; ?>
" /></td>
				<td class="label"><label for="resp_number">Numero:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_number" id="resp_number" value="<?php echo $this->_tpl_vars['resp']['number']; ?>
" size="5" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_complement">Complemento:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_complement" id="resp_complement" value="<?php echo $this->_tpl_vars['resp']['complement']; ?>
" /></td>
				<td class="label"><label for="resp_district">Bairro:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_district" id="resp_district" value="<?php echo $this->_tpl_vars['resp']['district']; ?>
" /></td>
			</tr>
			<tr>
				<td class="label"><label for="resp_country">País:&nbsp;</label></td>
				<td class="input">
					<select name="resp_country" id="resp_country" style="width:160px;">
						<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['countries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<option value="<?php echo $this->_tpl_vars['countries'][$this->_sections['c']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['countries'][$this->_sections['c']['index']]['id'] == $this->_tpl_vars['resp']['country_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['countries'][$this->_sections['c']['index']]['name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
				<td class="label"><label for="resp_state">Estado:&nbsp;</label></td>
				<td class="input">
					<select name="resp_state" id="resp_state" style="width:160px;">
						<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['states']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?>
							<option value="<?php echo $this->_tpl_vars['states'][$this->_sections['s']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['states'][$this->_sections['s']['index']]['id'] == $this->_tpl_vars['resp']['state_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['states'][$this->_sections['s']['index']]['name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label"><label for="resp_city">Cidade:&nbsp;</label></td>
				<td class="input">
					<select name="resp_city" id="resp_city" style="width:160px;">
						<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['resp_cities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<option value="<?php echo $this->_tpl_vars['resp_cities'][$this->_sections['c']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['resp_cities'][$this->_sections['c']['index']]['id'] == $this->_tpl_vars['resp']['city_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['resp_cities'][$this->_sections['c']['index']]['name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
				<td class="label"><label for="resp_cep">CEP:&nbsp;</label></td>
				<td class="input"><input type="text" name="resp_cep" id="resp_cep" value="<?php echo $this->_tpl_vars['resp']['cep']; ?>
" /></td>
			</tr>
			
		</table>		
	</fieldset>
	<?php else: ?>
	<fieldset id="responsible">
		<legend>Dados Profissionais</legend>
		
		<table class="tbgerais">
			<tr>
				<td class="label">Empresa:&nbsp;</td>
				<td class="input">
					<select name="student_company" id="student_company" style="width:200px;">
						<option value="0">Nova Empresa</option>
						<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['companies']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<option value="<?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['companies'][$this->_sections['c']['index']]['id'] == $this->_tpl_vars['student']['company_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]['name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
				<td class="label">
				
			</tr>
		</table>
	</fieldset>
	<?php endif; ?>
	<div align="center">
	<input id="button1" type="submit" value="Enviar" />
	<input id="button2" type="button" value="Restaurar valores" onclick="location.href='Admin/Users/EditUser/<?php echo $this->_tpl_vars['user']['id']; ?>
'" />
	</div>
</form>