<h3>Empresas</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="Admin/School/Companies/{$resultsPerPage}/{$page}/OrderBy/id/{$order}" title="Ordenar pelo id">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="Admin/School/Companies/{$resultsPerPage}/{$page}/OrderBy/name/{$order}">Empresa</a></th>
				<th><a href="Admin/School/Companies/{$resultsPerPage}/{$page}/OrderBy/tel/{$order}">Telefone</a></th>
				<th><a href="Admin/School/Companies/{$resultsPerPage}/{$page}/OrderBy/email_contact/{$order}">Email</a></th>
				<th><a href="Admin/School/Companies/{$resultsPerPage}/{$page}/OrderBy/students/{$order}">Alunos</a></th>
                <th width="60px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			{section name=u loop=$companies}
			<tr>
				<td class="a-center">{$companies[u].id}</td>
				<td><center><a href="#">{$companies[u].name}</center></a></td>
				<td><center>{$companies[u].tel}</center></td>
				<td><center>{$companies[u].email_contact}</center></td>
				<td><center>{$companies[u].students}</center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="{$pathAdmin}img/icons/magnifier.png" title="Ver Empresa" width="16" height="16" /></a><a href="javascript:void(0)"><img src="{$pathAdmin}img/icons/page_white_edit.png" title="Editar Empresa" width="16" height="16" /></a><a href="Admin/School/DeleteCompany/{$companies[u].id}" onclick="if(confirm('Tem certeza que deseja apagar essa empresa?')) return true; else return false;"><img src="{$pathAdmin}img/icons/page_white_delete.png" title="Deletar Empresa" width="16" height="16" /></a></td>
			</tr>
			{/section}
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Companies/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/School/Companies/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Companies/'+this.value+'/{$page}'">
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