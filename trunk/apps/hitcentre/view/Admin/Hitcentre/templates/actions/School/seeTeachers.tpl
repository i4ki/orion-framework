<h3>Professores</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="Admin/School/Teachers/{$resultsPerPage}/{$page}/OrderBy/id/{$order}" title="Ordenar pelo id">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="Admin/School/Teachers/{$resultsPerPage}/{$page}/OrderBy/firstname/{$order}">Nome Completo</a></th>
				<th><a href="Admin/School/Teachers/{$resultsPerPage}/{$page}/OrderBy/email/{$order}">Email</a></th>
				<th><a href="Admin/School/Teachers/{$resultsPerPage}/{$page}/OrderBy/language/{$order}">Idiomas</a></th>
                <th width="60px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			{section name=u loop=$teacher}
			<tr>
				<td class="a-center">{$teacher[u].id}</td>
				<td><center><a href="#">{$teacher[u].name}</center></a></td>
				<td><center>{$teacher[u].email}</center></td>
				<td><center>
					<select name="languages" id="languages" style="width:100px;">
					{assign var=language value=$teacher[u].languages}
					{section name=l loop=$language}
						<option value="1">{$language[l].language}</option>
					{/section}
					</center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="{$pathAdmin}img/icons/user.png" title="Ver Perfil" width="16" height="16" /></a><a href="javascript:void(0)"><img src="{$pathAdmin}img/icons/user_edit.png" title="Editar Professor" width="16" height="16" /></a><a href="Admin/School/DeleteTeacher/{$teacher[u].id}" onclick="if(confirm('Você tem certeza de que deseja apagar esse professor?')) return true; else return false;"><img src="{$pathAdmin}img/icons/user_delete.png" title="Deletar professor" width="16" height="16" /></a></td>
			</tr>
			{/section}
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Teachers/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/School/Teachers/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Teachers/'+this.value+'/{$page}'">
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