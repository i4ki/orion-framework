<h3>Usuários</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="#">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="#">Nome Completo</a></th>
                <th><a href="#">Email</a></th>
                <th width="70px"><a href="#">Grupo</a></th>
                <th width="60px"><a href="#">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			{section name=u loop=$users}
			<tr>
				<td class="a-center">{$users[u].id}</td>
				<td><center><a href="#">{$users[u].name}</center></a></td>
				<td><center>{$users[u].email}</center></td>
				<td><center>{$users[u].group}</center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="{$pathAdmin}img/icons/user.png" title="Ver Perfil" width="16" height="16" /></a><a href="Admin/Users/EditUser/{$users[u].id}"><img src="{$pathAdmin}img/icons/user_edit.png" title="Editar Usuário" width="16" height="16" /></a><a href="Admin/Users/DeleteUser/{$users[u].id}"><img src="{$pathAdmin}img/icons/user_delete.png" title="Deletar usuário" width="16" height="16" /></a></td>
			</tr>
			<tr class="seePerfil">
				<td colspan="5"></td>
			</tr>
			{/section}
		</tbody>
	</table>
    <div id="pager">
    	Página <a href="#"><img src="img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" value="1" type="text" name="page" id="page" />
    	<a href="#"><img src="img/icons/arrow_right.gif" width="16" height="16" /></a>de 1
    	páginas | Visualizar <select name="view">
    				<option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
    			</select>
    	por página | Total <strong>{$count}</strong> registros encontrados
	</div>