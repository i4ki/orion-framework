<h3 id="groups">Manutenção de Grupos</h3>
<table name="tbSeeGroups" id="tbSeeGroups">
	<thead>
		<tr>
        	<th width="40px"><a href="Admin/Users/Groups/OrderBy/id/{$order}">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
        	<th><a href="Admin/Users/Groups/OrderBy/name/{$order}">Grupo</a></th>
        	<th><a href="Admin/Users/Groups/OrderBy/created_at/{$order}">Data de Criação</a></th>
            <th width="60px"><a href="#">Ação</a></th>
        </tr>
        {section name=g loop=$groups}
        <tr>
        	<td>{$groups[g].id}</td>
        	<td>{$groups[g].name}</td>
        	<td>{$groups[g].created_at}</td>
        	<td><a href="Admin/Users/Groups/EditGroup/{$groups[g].id}"><img src="{$pathAdmin}img/icons/user_edit.png" title="Editar Grupo" width="16" height="16" /></a><a href="Admin/Users/Groups/DeleteGroup/{$groups[g].id}" title="Deletar Grupo" onclick="if(confirm('Tem certeza que deseja apagar este group?')) return true; else return false;"><img src="{$pathAdmin}img/icons/user_delete.png" title="Deletar Grupo" width="16" height="16" /></a></td>
        </tr>
        {/section}
	</thead>
</table>

