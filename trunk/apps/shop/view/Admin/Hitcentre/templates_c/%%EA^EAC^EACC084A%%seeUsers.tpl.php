<?php /* Smarty version 2.6.23, created on 2009-08-10 14:48:47
         compiled from actions/Users/seeUsers.tpl */ ?>
<h3>Usuários</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="#">ID<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="#">Nome Completo</a></th>
                <th><a href="#">Email</a></th>
                <th width="70px"><a href="#">Grupo</a></th>
                <th width="60px"><a href="#">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
$this->_sections['u']['step'] = 1;
$this->_sections['u']['start'] = $this->_sections['u']['step'] > 0 ? 0 : $this->_sections['u']['loop']-1;
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = $this->_sections['u']['loop'];
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
			<tr>
				<td class="a-center"><?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['id']; ?>
</td>
				<td><center><a href="#"><?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['name']; ?>
</center></a></td>
				<td><center><?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['email']; ?>
</center></td>
				<td><center><?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['group']; ?>
</center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user.png" title="Ver Perfil" width="16" height="16" /></a><a href="Admin/Users/EditUser/<?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_edit.png" title="Editar Usuário" width="16" height="16" /></a><a href="Admin/Users/DeleteUser/<?php echo $this->_tpl_vars['users'][$this->_sections['u']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_delete.png" title="Deletar usuário" width="16" height="16" /></a></td>
			</tr>
			<tr class="seePerfil">
				<td colspan="5"></td>
			</tr>
			<?php endfor; endif; ?>
		</tbody>
	</table>
    <div id="pager">
    	Página <a href="#"><img src="img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" value="1" type="text" name="page" id="page" />
    	<a href="#"><img src="img/icons/arrow_right.gif" width="16" height="16" /></a>de 1
    	páginas | Visualizar <select name="view">
    				<option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
    			</select>
    	por página | Total <strong><?php echo $this->_tpl_vars['count']; ?>
</strong> registros encontrados
	</div>