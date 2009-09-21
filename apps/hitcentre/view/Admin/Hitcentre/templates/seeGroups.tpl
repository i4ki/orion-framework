{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}
{literal}
<script type="text/javascript">
function aguarde() {
	alert('Área ainda em construção');
	return false;
}
</script>
{/literal}
</head>
<body>
	<div id="container">
    	<div id="header">
        	<h2>Hit Centre of Language</h2>
    	<div id="topmenu">
        	{include file="includes/topmenu.tpl"}
        </div>
      </div>
        <div id="top-panel">
            <div id="panel">
                {include file="includes/panel.tpl"}
            </div>
      </div>
        <div id="wrapper">
            <div id="content">
            {* CONTEUDO AQUI *}
           <form class="form" action="Admin/Manager/Groups/Save/GroupByName" method="post" name="saveGroup" id="saveGroup">
			<fieldset id="personal">
				<legend>GRUPO :: {$group[0].name}</legend>
				<div id="divAddGroup" name="divAddGroup">
				<br />	           
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
		        	<img src="{$pathAdmin}img/icons/action_back.gif" align="left" />&nbsp;Clique nas seções ao lado para ver as permissões.<br />
		        	<table class="none">
		        		<tr>
		        			<td>Nome do grupo:</td>
		        			<td>{$group[0].name}</td>
		        		</tr>
		        		<tr>
		        			<td>Criado por: </td>
		        			<td>{$group[0].create_by}</td>
		        		</tr>
		        		<tr>
		        			<td>Data de Criação: </td>
		        			<td>{$group[0].created_at}</td>
		        		</tr>
		        		<tr>
		        			<td>Nr. de usuários neste grupo: </td>
		        			<td>{$group[0].nrUsers}</td>
		        		</tr>
		        	</table>
		        	
		        	 
		        </div>
		        <div class="clear"></div><br />
		        
		   </fieldset>
		</form>
            </form>
            </div>
            </div>
            <div id="sidebar">
  				{include file="includes/sidebar.tpl"}
          </div>
      </div>
        <div id="footer">
        <div id="credits">

        </div>
        <div id="styleswitcher">
            <ul>
                <li><a href="javascript: document.cookie='theme='; window.location.reload();" title="Default" id="blueswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=1'; window.location.reload();" title="Blue" id="defswitch">d</a></li>
                <li><a href="javascript: document.cookie='theme=2'; window.location.reload();" title="Green" id="greenswitch">g</a></li>
                <li><a href="javascript: document.cookie='theme=3'; window.location.reload();" title="Brown" id="brownswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=4'; window.location.reload();" title="Mix" id="mixswitch">m</a></li>
            </ul>
        </div><br />

        </div>
</div>
</body>
</html>
