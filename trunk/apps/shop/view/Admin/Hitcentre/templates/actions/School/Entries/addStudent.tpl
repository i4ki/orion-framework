<h3>Cadastro de Aluno</h3>
<div id="box_resp"><br />
<center><strong>O aluno é o responsável financeiro?</strong></center>
<center>
	Sim&nbsp;<input type="radio" name="student_resp" id="student_resp" value="1" onclick="toggleResp('1')" />&nbsp;
	<input type="radio" name="student_resp" id="student_resp" checked="checked" value="0" onclick="toggleResp('0')" />&nbsp;Não																				
</center>
</div>
<form method="POST" class="form" action="Admin/School/Entries/Students/SecondPart">
<div id="form_entry" name="form_entry">


</div>
<center><input type="reset" value="Limpar campos" /><input type="submit" value="Seguinte" /></center>
</form>