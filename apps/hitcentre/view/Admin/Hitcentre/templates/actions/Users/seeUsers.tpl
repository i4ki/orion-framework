<h3>Usuários</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="Admin/Users/{$resultsPerPage}/{$page}/OrderBy/id/{$order}" title="Ordenar pelo id">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="Admin/Users/{$resultsPerPage}/{$page}/OrderBy/firstname/{$order}">Nome Completo</a></th>
                <th><a href="Admin/Users/{$resultsPerPage}/{$page}/OrderBy/email/{$order}">Email</a></th>
                <th width="70px"><a href="Admin/Users/{$resultsPerPage}/{$page}/OrderBy/group/{$order}">Grupo</a></th>
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
    	Página <a href="Admin/Users/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/Users/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/Users/'+this.value+'/{$page}'">
    				<option{if $resultsPerPage == 5} selected="selected"{/if}>5</option>
					<option{if $resultsPerPage == 10} selected="selected"{/if}>10</option>
                    <option{if $resultsPerPage == 25} selected="selected"{/if}>25</option>
                    <option{if $resultsPerPage == 30} selected="selected"{/if}>30</option>
                    <option{if $resultsPerPage == 50} selected="selected"{/if}>50</option>
					<option{if $resultsPerPage == 75} selected="selected"{/if}>75</option>
					<option{if $resultsPerPage == 100} selected="selected"{/if}>100</option>
    			</select>
    	por página | Total <strong>{$count}</strong> registros encontrados
	</div>