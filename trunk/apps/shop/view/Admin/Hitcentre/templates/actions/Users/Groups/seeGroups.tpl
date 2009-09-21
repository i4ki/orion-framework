<h3 id="groups">Manutenção de Grupos</h3>
<table name="tbSeeGroups" id="tbSeeGroups">
	<thead>
		<tr>
        	<th width="40px"><a href="#">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
        	<th><a href="#">Grupo</a></th>
        	<th>Data de Criação</th>
            <th width="60px"><a href="#">Ação</a></th>
        </tr>
        {section name=g loop=$groups}
        <tr>
        	<td>{$groups[g].id}</td>
        	<td>{$groups[g].name}</td>
        	<td>{$groups[g].created_at}</td>
        	<td><a href="Admin/Users/Groups/SeeGroup/{$groups[g].id}"><img src="{$pathAdmin}img/icons/user.png" title="Ver Grupo" width="16" height="16" /></a><a href="Admin/Users/Groups/EditGroup/{$groups[g].id}"><img src="{$pathAdmin}img/icons/user_edit.png" title="Editar Grupo" width="16" height="16" /></a><a href="Admin/Users/Groups/DeleteGroup/{$groups[g].id}"><img src="{$pathAdmin}img/icons/user_delete.png" title="Deletar Grupo" width="16" height="16" /></a></td>
        </tr>
        {/section}
	</thead>
</table>

