<?php /* Smarty version 2.6.23, created on 2009-08-01 00:10:47
         compiled from actions/Users/Groups/seeGroups.tpl */ ?>
<h3 id="groups">Manutenção de Grupos</h3>
<table name="tbSeeGroups" id="tbSeeGroups">
	<thead>
		<tr>
        	<th width="40px"><a href="#">ID<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
        	<th><a href="#">Grupo</a></th>
        	<th>Data de Criação</th>
            <th width="60px"><a href="#">Ação</a></th>
        </tr>
        <?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
        <tr>
        	<td><?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['id']; ?>
</td>
        	<td><?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['name']; ?>
</td>
        	<td><?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['created_at']; ?>
</td>
        	<td><a href="Admin/Users/Groups/SeeGroup/<?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user.png" title="Ver Grupo" width="16" height="16" /></a><a href="Admin/Users/Groups/EditGroup/<?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_edit.png" title="Editar Grupo" width="16" height="16" /></a><a href="Admin/Users/Groups/DeleteGroup/<?php echo $this->_tpl_vars['groups'][$this->_sections['g']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_delete.png" title="Deletar Grupo" width="16" height="16" /></a></td>
        </tr>
        <?php endfor; endif; ?>
	</thead>
</table>
