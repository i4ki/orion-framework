<div class="center-box">
	<center><h3>Departamentos</h3></center>

	<div class="center-body">
	<fieldset id="departments-add">
	<legend>Adicionar Departamento</legend>
		<form class="forms" method="post" action="Admin/Register/Departaments/Register">
			<table class="body-action-tb" align="center">
				<tr>
					<td>Data:</td>
					<td>15/08/2009</td>
				</tr>
				<tr>
					<td>Nome do departamento: </td>
					<td><input id="name" type="text" name="name" size="20" maxlength="200" /></td>
				</tr>
				<tr>
					<td>Visível: </td>
					<td>	<select name="visible" id="visible">
								<option value="1">Sim</option>
								<option value="0">Não</option>
							</select>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
	</div>
	<!--	Mensagens de erros -->
	<div class="center-body-errors">

	</div>
</div>