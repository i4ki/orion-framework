<?php /* Smarty version 2.6.23, created on 2009-07-25 07:54:56
         compiled from seeGroups.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type="text/javascript">
function aguarde() {
	alert(\'Área ainda em construção\');
	return false;
}
</script>
'; ?>

</head>
<body>
	<div id="container">
    	<div id="header">
        	<h2>Hit Centre of Language</h2>
    	<div id="topmenu">
        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/topmenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
      </div>
        <div id="top-panel">
            <div id="panel">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/panel.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
      </div>
        <div id="wrapper">
            <div id="content">
                       <form class="form" action="Admin/Manager/Groups/Save/GroupByName" method="post" name="saveGroup" id="saveGroup">
			<fieldset id="personal">
				<legend>GRUPO :: <?php echo $this->_tpl_vars['group'][0]['name']; ?>
</legend>
				<div id="divAddGroup" name="divAddGroup">
				<br />	           
		            <center><span class="title">Permissões do Grupo</span></center>
		            
		            <table class="none" border="0">
		            	
		            	<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['services']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?>         		
		            		<tr>
		            			<td class="services"><a href="javascript:void(0)" name="<?php echo $this->_tpl_vars['services'][$this->_sections['s']['index']]['id']; ?>
" title="<?php echo $this->_tpl_vars['services'][$this->_sections['s']['index']]['name']; ?>
" id="service_<?php echo $this->_tpl_vars['services'][$this->_sections['s']['index']]['id']; ?>
" onclick="loadResources(<?php echo $this->_tpl_vars['services'][$this->_sections['s']['index']]['id']; ?>
, $j('#role_pattern').attr('value'))"><?php echo $this->_tpl_vars['services'][$this->_sections['s']['index']]['name']; ?>
</a></td>
		            		</tr>         	    		
		            	<?php endfor; endif; ?>		            	
		            </table>
		            <br />            
					<center><input type="button" name="finalizar" id="finalizar" value="Gravar" onclick="gravar()" /></center>
		        </div>
		        <div name="divRoleResource" id="divRoleResource">
		        	<br />
		        	<center><span class="title">Sistema de Permissões</span></center>
		        	<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/action_back.gif" align="left" />&nbsp;Clique nas seções ao lado para ver as permissões.<br />
		        	<table class="none">
		        		<tr>
		        			<td>Nome do grupo:</td>
		        			<td><?php echo $this->_tpl_vars['group'][0]['name']; ?>
</td>
		        		</tr>
		        		<tr>
		        			<td>Criado por: </td>
		        			<td><?php echo $this->_tpl_vars['group'][0]['create_by']; ?>
</td>
		        		</tr>
		        		<tr>
		        			<td>Data de Criação: </td>
		        			<td><?php echo $this->_tpl_vars['group'][0]['created_at']; ?>
</td>
		        		</tr>
		        		<tr>
		        			<td>Nr. de usuários neste grupo: </td>
		        			<td><?php echo $this->_tpl_vars['group'][0]['nrUsers']; ?>
</td>
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
  				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/sidebar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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