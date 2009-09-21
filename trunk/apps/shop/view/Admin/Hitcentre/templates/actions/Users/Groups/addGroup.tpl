<form class="form" action="Admin/Manager/Groups/Save/GroupByName" method="post" name="saveGroup" id="saveGroup">
	<fieldset id="personal">
		<legend>Adicionar Grupo</legend>
		<div id="divAddGroup" name="divAddGroup">
		<br />
		<input type="hidden" name="role_pattern" id="role_pattern" value="0" />
		Nome do Grupo: 
            <input type="text" name="name" id="name" /><input type="submit" name="createGroup" id="createGroup" value="Criar" />
            <center><span class="title">Permissões do Grupo</span></center>
            
            <table class="none" border="0">
            	
            	{section name=s loop=$services}         		
            		<tr>
            			<td class="services"><a href="javascript:void(0)" name="{$services[s].id}" title="{$services[s].name}" id="service_{$services[s].id}" onclick="loadResources({$services[s].id}, $j('#role_pattern').attr('value'))">{$services[s].name}</a></td>
            		</tr>         	    		
            	{/section}
            	
            </table>
            <br />            
			<center><input type="button" name="finalizar" id="finalizar" value="Gravar" onclick="gravar()" /></center>
        </div>
        <div name="divRoleResource" id="divRoleResource">
        	<br />
        	<center><span class="title">Sistema de Permissões</span></center>
        	<img src="{$pathAdmin}img/icons/action_back.gif" /><p>Clique nas seções do menu ao lado e ajuste a permissão deste grupo</p>
        	<p>Você deverá ajustar as permissões de cada grupo de usuários.</p>
        	<p>Por exemplo, você poderá dar permissão para os professores 
        	<span class="title">visualizar</span> e <span class="title">editar</span>
        	 os alunos, mas não de <span class="title">cadastrar</span> e 
        	 <span class="title">apagar</span>.</p>
        	 
        </div>
        <div class="clear"></div><br />
        
   </fieldset>
</form>