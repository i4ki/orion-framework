<h3 id="portal">CONFIGURAÇÕES DA ESCOLA</h3>
    <form class="form" action="Admin/Config/School/Save" method="post">
	<fieldset id="gerais">
		<legend>Gerais</legend>
    	<div class="divGerais">
            <table class="tbgerais">
	        	<tr>
	        		<td class="label"><label for="company_name">Razão Social&nbsp;</label></td>
	        		<td class="input"><input type="text" name="company_name" id="company_name" size="30" value="{$school.company_name}" /></td>
	        	</tr>
	        	<tr>
	        		<td class="label"><label for="commercial_name">Nome Comercial&nbsp;</label></td>
	        		<td class="input"><input type="text" name="commercial_name" id="commercial_name" size="30" value="{$school.commercial_name}" /></td>
	        	</tr>
	        	<tr>
	        		<td class="label"><label for="cnpj">C.N.P.J&nbsp;</label></td>
	        		<td class="input"><input type="text" name="cnpj" id="cnpj" value="{$school.cnpj}" /></td>
	        	</tr>
           	</table>
    	</div>
    </fieldset>
    <fieldset id="endereco">
    	<legend>Endereço</legend>
    	<table class="tbgerais">
	    	<tr>
	    		<td class="label"><label for="street">Endereço&nbsp;</label></td>
	    		<td class="input"><input type="text" name="street" id="street" size="30" value="{$school.street}" /></td>
	    	</tr>
	    	<tr>
	    		<td class="label"><label for="district">Bairro</label></td>
	    		<td class="input"><input type="text" name="district" id="district" size="30" value="{$school.district}" /></td>
	    	</tr>
	    	<tr>
	    		<td class="label"><label for="country">País</label></td>
	    		<td class="input">	<select name="country" id="country">
	    								<option value="0">Selecione...</option>
	    							</select>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="label"><label for="state">Estado</label></td>
	    		<td class="input">	<select name="state" id="state">
	    								<option value="0">Selecione...</option>
	    							</select>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="label"><label for="city">Cidade</label></td>
	    		<td class="input">	<select name="city" id="city" >
	    								<option value="0">Selecione...</option>
	    							</select>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="label"><label for="zip">C.E.P&nbsp;</label></td>
	    		<td class="input"><input type="text" name="zip" id="zip" size="10" value="{$school.zip}" /></td>
	    	</tr>	
    	</table>    	
    </fieldset>
    <fieldset id="contato">
    	<legend>Contato</legend>
    	<table class="tbgerais">
    		<tr>
    			<td class="label"><label for="telefone">Telefone&nbsp;</label></td>
    			<td class="input"><input type="text" name="telefone" id="telefone" size="20" value="{$school.telefone}" /></td>
    		</tr>
    		<tr>
    			<td class="label"><label for="telefone_fax">Fax&nbsp;</label></td>
    			<td class="input"><input type="text" name="telefone_fax" id="telefone_fax" size="20" value="{$school.telefone_fax}" /></td>
    		</tr>
    		<tr>
    			<td class="label"><label for="email_main">Email principal&nbsp;</label></td>
    			<td class="input"><input type="text" name="email_main" id="email_main" size="30" value="{$school.email_main}" /></td>
    		</tr>
    	</table>
    </fieldset>
    <fieldset id="alunos">
    	<legend>Alunos</legend>
    	<table class="tbgerais">
    		<tr>
    			<td class="label"><label for="matricula_generated">Matrícula gerada automaticamente?</label></td>
    			<td class="input">	<select name="matricula_generated">
    									<option value="0">Não</option>
    									<option value="1">Sim</option>
    								</select>
    			</td>
    		</tr>
    	</table>
    </fieldset>
	      
      <div align="center">
	      <input id="button1" type="submit" value="Enviar" />
	      <input id="button2" type="reset" />
      </div>
</form>

