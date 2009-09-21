<h3>Alunos</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="Admin/School/Students/{$resultsPerPage}/{$page}/OrderBy/id/{$order}" title="Ordenar pelo id">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="Admin/School/Students/{$resultsPerPage}/{$page}/OrderBy/firstname/{$order}">Nome Completo</a></th>
				<th><a href="Admin/School/Students/{$resultsPerPage}/{$page}/OrderBy/course/{$order}">Curso</a></th>
				<th><a href="Admin/School/Students/{$resultsPerPage}/{$page}/OrderBy/language/{$order}">Idioma</a></th>
				<th><a href="Admin/School/Students/{$resultsPerPage}/{$page}/OrderBy/teacher/{$order}">Professor</a></th>
                <th><a href="Admin/School/Students/{$resultsPerPage}/{$page}/OrderBy/status/{$order}">Situação</a></th>
                <th width="60px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			{section name=u loop=$student}
			<tr>
				<td class="a-center">{$student[u].id}</td>
				<td><center><a href="#">{$student[u].name}</center></a></td>
				<td><center>{$student[u].course}</center></td>
				<td><center>{$student[u].language}</center></td>
				<td><center>{$student[u].teacher}</center></td>
				<td><center><img src="{$pathAdmin}img/icons/fam_bullet_success.gif" width="16" height="16" /></center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="{$pathAdmin}img/icons/user.png" title="Ver Perfil" width="16" height="16" /></a><a href="Admin/School/viewStudent/{$student[u].id}"><img src="{$pathAdmin}img/icons/user_edit.png" title="Editar Estudante" width="16" height="16" /></a><a href="Admin/School/DeleteStudent/{$student[u].id}"><img src="{$pathAdmin}img/icons/user_delete.png" title="Deletar usuário" width="16" height="16" /></a></td>
			</tr>
			{/section}
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Students/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/School/Students/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Students/'+this.value+'/{$page}'">
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