<h3>Idiomas</h3>
	<table width="70%" class="seecourse">
		<thead>
			<tr>
            	<th width="10px"><a href="Admin/School/Languages/{$resultsPerPage}/{$page}/OrderBy/id/{$order}" title="Ordenar pelo id">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th width="60px"><a href="Admin/School/Languages/{$resultsPerPage}/{$page}/OrderBy/name/{$order}">Curso</a></th>
				<th width="30px"><center><a href="javascript:void(0)">N&deg; de Professores</a></center></th>
                <th width="50px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			{section name=u loop=$languages}
			<tr>
				<td class="a-center">{$languages[u].id}</td>
				<td><center><a href="#">{$languages[u].name}</center></a></td>
				<td><center><a href="javascript:void(0)">0</center></a></td>
				<td><center><a href="Admin/School/Languages/Edit/{$languages[u].id}"><img src="{$pathAdmin}img/icons/page_white_edit.png" title="Editar Idioma" width="16" height="16" /></a><a href="Admin/School/Languages/Del/{$languages[u].id}" onclick="if(confirm('Você tem certeza que deseja excluir esse idioma?')) return true; else return false;"><img src="{$pathAdmin}img/icons/page_white_delete.png" title="Deletar idioma" width="16" height="16" /></a></center></td>
			</tr>
			
			{/section}
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Languages/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/School/Languages/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Languages/'+this.value+'/{$page}'">
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
	<br />
	<div id="box">
		{if $opt == "add"}
			<h3>Cadastrar Novo Idioma</h3>
		{elseif $opt == "edit"}
			<h3>Editar Idioma</h3>
		{/if}
		<form class="form" method="post" action="Admin/School/Languages/{if $opt == 'add'}Add{elseif $opt == 'edit'}Edit{/if}">
			<input type="hidden" name="languageid" id="languageid" value="{if $opt == 'edit'}{$language.id}{/if}" />
			<table align="center" width="70%" class="addcourse">
				<tr>
					<td class="label">Idioma:&nbsp;</td>
					<td class="input"><input type="text" name="name" id="name" value="{if $opt == 'edit'}{$language.name}{/if}" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Salvar" /></td>
				</tr>
			</table>
		</form>
	</div>