<?php /* Smarty version 2.6.23, created on 2009-09-20 04:23:08
         compiled from actions/Users/adduser.tpl */ ?>
<h3 id="adduser">Adicionar Usuário</h3>
    <form class="form" action="Admin/Users/AddUser" method="POST" enctype="multipart/form-data">
	<fieldset id="personal">
		<legend>INFORMAÇÕES PESSOAIS</legend>
    	<div class="divAddUser">
            <table class="tableAddUser">
        	
            <tr>
                <td class="label"><label for="firstname">Primeiro nome : </label></td>
                    <td class="input"><input name="firstname" id="firstname" type="text" /></td>
            </tr>
            <tr>
                <td class="label"><label for="firstname">Segundo nome : </label></td>
                <td class="input"><input name="lastname" id="lastname" type="text" /></td>
            </tr>
			<tr>
                <td class="label"><label for="username">Username : </label></td>
                <td class="input"><input type="text" name="username" id="username" /></td>
            </tr>
            <tr>
                <td class="label"><label for="email">Email : </label></td>
                <td class="input"><input name="email" id="email" type="text" /></td>
            </tr>
            <tr>
                <td colspan="2">
                Enviar password gerado automáticamente:&nbsp;
                <input name="generatepass" id="generatepass" type="checkbox" value="yes" />
                </td>
            </tr>
            <tr>
                <td class="label"><label for="pass">Password : </label></td>
                <td class="input"><input name="pass" id="pass" type="password" /></td>
            </tr>
            <tr>
                <td class="label"><label for="pass_2">Password : </label></td>
                <td class="input"><input name="pass_2" id="pass_2" type="password" /></td>
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
        <table class="tableAddUser">
        <tr>
            <td class="label"><label for="street">Rua : </label></td>
            <td class="input"><input name="street" id="street" type="text" /></td>
        </tr>
        <tr>
        	<td class="label"><label for="district">Bairro : </label></td>
        	<td class="input"><input type="text" name="district" id="district" /></td>
        </tr>
        <tr>
            <td class="label"><label for="country">País : </label></td>
            <td class="input"><select name="country" id="country" onchange="trocaDom(this, this.value)">
            	<option value="0">Selecione...</option>
            	
            	</select>
            	<span id="loader_country" name="loader_country"></span>
            </td>
        </tr>
        <tr>
            <td class="label"><label for="state">Estado : </label></td>
            <td class="input"><select name="state" id="state" onchange="populate('city',null, this.value)">
            	<option value="0">Selecione...</option>
            	
            	</select>
            	<input type="text" name="state_input" id="state_input" />
            	<span id="loader_state" name="loader_state"></span>
            	</td>
        </tr>
        <tr>
            <td class="label"><label for="city">Cidade : </label></td>
            <td class="input"><select name="city" id="city">
				<option value="0" size="100">Selecione...</option>
				
            </select>
            <input type="text" name="city_input" id="city_input" />
            <span id="loader_city" name="loader_city"></span>
            </td>
        </tr>
        <tr>
            <td class="label"><label for="cep">C.E.P.: </label></td>
            <td class="input"><input name="cep" id="cep" type="text" /></td>
        </tr>
        <tr>
            <td class="label"><label for="tel_res">Telefone : </label></td>
            <td class="input"><input name="tel_res" id="tel_res" type="text" /></td>
      	</tr>
      	<tr>
      		<td class="label"><label for="tel_cel">Celular : </label></td>
      		<td class="input"><input type="text" name="tel_cel" id="tel_cel" /></td>
      	</tr>
      	</table>
      	</div>
      	<div id="dataAddressError" name="dataAddressError">
		<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
      	</div>
      	<div class="clear"></div>
      </fieldset>
	  <fieldset id="imagem">
		<legend>IMAGEM DE EXIBIÇÃO</legend>
		<center>
			<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/user.gif" height="150" />
		</center>
			<br />
			<center>Imagem:&nbsp;<input type="file" name="foto" id="foto" /></center>
			
		</fieldset>
      <fieldset id="opt">
        <legend>OPÇÕES</legend>
        <div class="divAddUser">
        <table class="tableAddUser">
        <tr>
            <td class="label"><label for="group">Grupo : </label></td>
        <td class="input"><select name="group" id="group">
          <option value="">
          Selecione...
          </option>
          <?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          	<option value="<?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['name']; ?>
</option>
          <?php endfor; endif; ?>
        </select></td>
      </tr>
      </table>
      </div>
      <div class="divAddUserError">
      	<!-- AQUI APARECERAM AS MENSAGENS DE ERRO -->
      </div>
      <div class="clear"></div>
      </fieldset>
      <div align="center">
	      <input type="submit" value="Enviar" />
	      <input type="reset" />
      </div>
</form>
