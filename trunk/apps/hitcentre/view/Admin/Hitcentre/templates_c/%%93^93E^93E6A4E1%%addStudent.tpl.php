<?php /* Smarty version 2.6.23, created on 2009-09-09 14:45:05
         compiled from actions/School/Entries/addStudent.tpl */ ?>
<h3>Cadastro de Aluno</h3>
<div id="box_resp"><br />
<center><strong>O aluno é o responsável financeiro?</strong></center>
<center>
	Sim&nbsp;<input type="radio" name="student_resp" id="student_resp" value="0" onclick="toggleResp(0)" />&nbsp;
	<input type="radio" name="student_resp" id="student_resp" checked="checked" value="1" onclick="toggleResp(1)" />&nbsp;Não
</center>
</div>
<div class="erros">
	<center><h4>Foi encontrado erros no cadastro:</h4></center>
	<ol>
		<!-- ERROS STUDENT NOT RESPONSIBLE -->
		<li><label for="resp_firstname" 	class="error resp">Insira o <b>nome</b> do responsável.</label></li>
		<li><label for="resp_lastname" 		class="error resp">Insira o <b>sobrenome</b> do responsável.</label></li>
		<li><label for="date_contract" 		class="error resp">Insira a <b>data</b>.</label></li>
		<li><label for="resp_cpf"			class="error resp"><b>CPF</b> inválido.</label></li>
		<li><label for="resp_rg"			class="error resp">Insira o <b>rg</b> do responsável.</label></li>
		<li><label for="resp_nationality"	class="error resp">Insira a <b>nacionalidade</b>.</label></li>
		<li><label for="resp_tel_res"		class="error resp">Insira o <b>telefone residencial</b>.</label></li>
		<li><label for="resp_email"			class="error resp">Insira um <b>email</b> válido</label></li>
		<li><label for="resp_address"		class="error resp">Insira o <b>endereço</b>.</label></li>
		<li><label for="resp_district"		class="error resp">Insira o <b>bairro</b>,</label></li>
		<li><label for="country"			class="error resp">Insira o <b>país</b>.</label></li>
		<li><label for="state"				class="error resp">Insira o <b>estado</b>.</label></li>
		<li><label for="city"				class="error resp">Insira a <b>cidade</b>.</label></li>
		<li><label for="cep"				class="error resp">Insira o <b>cep</b>.</label></li>
		
		<!-- ERROS STUDENT RESPONSIBLE -->
		<li><label for="student_firstname"	class="error notresp">Insira o <b>nome</b> do estudante.</label></li>
		<li><label for="student_lastname"	class="error notresp">Insira o <b>sobrenome</b> do estudante.</label></li>
		<li><label for="student_cpf"		class="error notresp"><b>CPF</b> inválido.</label></li>
		<li><label for="student_rg"			class="error notresp">Insira o <b>rg</b> do estudante.</label></li>
		<li><label for="student_grade_school" class="error notresp">Insira o <b>grau escolar</b> do estudante.</label></li>
		<li><label for="student_email_part"	class="error notresp">Insira o <b>email</b> do estudante.</label></li>
		<li><label for="student_birthday"	class="error notresp">Insira a <b>data de nascimento</b> do estudante.</label></li>
		<li><label for="student_tel_res"	class="error notresp">Insira o <b>telefone residencial</b> do estudante.</label></li>
		<li><label for="student_nacionalidade" class="error notresp">Insira a <b>nacionalidade</b> do estudante.</label></li>
		<li><label for="student_address"	class="error notresp">Insira o <b>endereço</b> do estudante.</label></li>
		<li><label for="student_district"	class="error notresp">insira o <b>bairro</b> do estudante.</label></li>
		<li><label for="student_country_id"	class="error notresp">Insira o <b>país</b> do estudante.</label></li>
		<li><label for="student_state_id"	class="error notresp">Insira o <b>estado</b> do estudante</label></li>
		<li><label for="student_city_id"	class="error notresp">Insira a <b>cidade</b> do estudante.</label></li>
		<li><label for="student_cep"		class="error notresp">Insira o <b>CEP</b> do estudante.</label></li>
		
	</ol>
</div>
<form method="POST" class="form" action="Admin/School/Entries/Students/SecondPart">
<div id="form_entry" name="form_entry">
<!-- Ajax -->

</div>
<center><input type="reset" value="Limpar campos" /><input type="submit" value="Seguinte" /></center>
</form>