<h3>Busca de Usuários</h3>
<form name="search" id="search" class="form" method="POST" action="Admin/Users/Search">
	<center>
	<table width="300" class="searchUser">
		<tr>
			<td class="label">Nome:&nbsp;</td>
			<td class="input"><input type="text" name="name" id="name" /></td>
		</tr>
		<tr>
			<td class="label">Email:&nbsp;</td>
			<td class="input"><input type="text" name="email" id="email" /></td>
		</tr>
		<tr>
			<td class="label">Grupo:&nbsp;</td>
			<td class="input">
				<select name="group" id="group">
					<option value="">Selecione...</option>
					{section name=g loop=$groups}
						<option value="{$groups[g].id}">{$groups[g].name}</option>
					{/section}
				</select>
			</td>
		</tr>
		<tr>
			<td class="label">Resultados por página:&nbsp;</td>
			<td class="input">
					<select name="resultsPerPage" id="resultsPerPage">
						<option{if $resultsPerPage == 5} selected="selected"{/if}>5</option>
						<option{if $resultsPerPage == 10} selected="selected"{/if}>10</option>
						<option{if $resultsPerPage == 25} selected="selected"{/if}>25</option>
						<option{if $resultsPerPage == 30} selected="selected"{/if}>30</option>
						<option{if $resultsPerPage == 50} selected="selected"{/if}>50</option>
						<option{if $resultsPerPage == 75} selected="selected"{/if}>75</option>
						<option{if $resultsPerPage == 100} selected="selected"{/if}>100</option>
					</select>
		</tr>
		<tr>
			<td class="label"></td>
			<td class="input"><input type="submit" name="search" id="search" value="Buscar" /></td>
		</tr>
	</table>
	</center>
</form>
<h3>Usuários</h3>
	{if $totalPage > 3}
	<div class="pager">
	
    	Página <a href="Admin/Users/Search/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/Users/Search/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/Users/Search/'+this.value+'/{$page}'">
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
	{/if}
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="Admin/Users/Search/{$resultsPerPage}/{$page}/OrderBy/id/{$order}" title="Ordenar pelo id">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="Admin/Users/Search/{$resultsPerPage}/{$page}/OrderBy/firstname/{$order}">Nome Completo</a></th>
                <th width="80px"><a href="Admin/Users/Search/{$resultsPerPage}/{$page}/OrderBy/email/{$order}">Email</a></th>
                <th width="70px"><a href="Admin/Users/Search/{$resultsPerPage}/{$page}/OrderBy/group/{$order}">Grupo</a></th>
                <th width="60px"><a href="#">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			{section name=u loop=$users}
			<tr>
				<td class="a-center"><a href="Admin/Users/Profile/{$users[u].id}">{$users[u].id}</a></td>
				<td><center><a href="Admin/Users/Profile/{$users[u].id}">{$users[u].name}</a></center></a></td>
				<td><center><a href="Admin/Users/Profile/{$users[u].id}">{$users[u].email}</a></center></td>
				<td><center><a href="Admin/Users/Profile/{$users[u].id}">{$users[u].group}</a></center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="{$pathAdmin}img/icons/user.png" title="Ver Perfil" width="16" height="16" /></a><a href="Admin/Users/EditUser/{$users[u].id}"><img src="{$pathAdmin}img/icons/user_edit.png" title="Editar Usuário" width="16" height="16" /></a><a href="Admin/Users/DeleteUser/{$users[u].id}"><img src="{$pathAdmin}img/icons/user_delete.png" title="Deletar usuário" width="16" height="16" /></a></td>
			</tr>

			{/section}
		</tbody>
	</table>

    <div class="pager">
    	Página <a href="Admin/Users/Search/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/Users/Search/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/Users/Search/'+this.value+'/{$page}'">
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