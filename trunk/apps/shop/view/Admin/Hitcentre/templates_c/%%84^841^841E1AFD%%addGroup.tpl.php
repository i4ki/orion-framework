<?php /* Smarty version 2.6.23, created on 2009-08-01 00:10:47
         compiled from actions/Users/Groups/addGroup.tpl */ ?>
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
img/icons/action_back.gif" /><p>Clique nas seções do menu ao lado e ajuste a permissão deste grupo</p>
        	<p>Você deverá ajustar as permissões de cada grupo de usuários.</p>
        	<p>Por exemplo, você poderá dar permissão para os professores 
        	<span class="title">visualizar</span> e <span class="title">editar</span>
        	 os alunos, mas não de <span class="title">cadastrar</span> e 
        	 <span class="title">apagar</span>.</p>
        	 
        </div>
        <div class="clear"></div><br />
        
   </fieldset>
</form>