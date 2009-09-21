<?php /* Smarty version 2.6.23, created on 2009-09-06 10:53:09
         compiled from actions/School/seeTeachers.tpl */ ?>
<h3>Professores</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="Admin/School/Teachers/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/id/<?php echo $this->_tpl_vars['order']; ?>
" title="Ordenar pelo id">ID<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="Admin/School/Teachers/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/firstname/<?php echo $this->_tpl_vars['order']; ?>
">Nome Completo</a></th>
				<th><a href="Admin/School/Teachers/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/email/<?php echo $this->_tpl_vars['order']; ?>
">Email</a></th>
				<th><a href="Admin/School/Teachers/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/language/<?php echo $this->_tpl_vars['order']; ?>
">Idiomas</a></th>
                <th width="60px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['teacher']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td class="a-center"><?php echo $this->_tpl_vars['teacher'][$this->_sections['u']['index']]['id']; ?>
</td>
				<td><center><a href="#"><?php echo $this->_tpl_vars['teacher'][$this->_sections['u']['index']]['name']; ?>
</center></a></td>
				<td><center><?php echo $this->_tpl_vars['teacher'][$this->_sections['u']['index']]['email']; ?>
</center></td>
				<td><center>
					<select name="languages" id="languages" style="width:100px;">
					<?php $this->assign('language', $this->_tpl_vars['teacher'][$this->_sections['u']['index']]['languages']); ?>
					<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['language']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
						<option value="1"><?php echo $this->_tpl_vars['language'][$this->_sections['l']['index']]['language']; ?>
</option>
					<?php endfor; endif; ?>
					</center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user.png" title="Ver Perfil" width="16" height="16" /></a><a href="javascript:void(0)"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_edit.png" title="Editar Professor" width="16" height="16" /></a><a href="Admin/School/DeleteTeacher/<?php echo $this->_tpl_vars['teacher'][$this->_sections['u']['index']]['id']; ?>
" onclick="if(confirm('Você tem certeza de que deseja apagar esse professor?')) return true; else return false;"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_delete.png" title="Deletar professor" width="16" height="16" /></a></td>
			</tr>
			<?php endfor; endif; ?>
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Teachers/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']-1; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
    	<a href="Admin/School/Teachers/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']+1; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong><?php echo $this->_tpl_vars['totalPage']; ?>
</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Teachers/'+this.value+'/<?php echo $this->_tpl_vars['page']; ?>
'">
    				<option<?php if ($this->_tpl_vars['resultsPerPage'] == 5): ?> selected="selected"<?php endif; ?>>5</option>
					<option<?php if ($this->_tpl_vars['resultsPerPage'] == 10): ?> selected="selected"<?php endif; ?>>10</option>
                    <option<?php if ($this->_tpl_vars['resultsPerPage'] == 25): ?> selected="selected"<?php endif; ?>>25</option>
                    <option<?php if ($this->_tpl_vars['resultsPerPage'] == 30): ?> selected="selected"<?php endif; ?>>30</option>
                    <option<?php if ($this->_tpl_vars['resultsPerPage'] == 50): ?> selected="selected"<?php endif; ?>>50</option>
					<option<?php if ($this->_tpl_vars['resultsPerPage'] == 75): ?> selected="selected"<?php endif; ?>>75</option>
					<option<?php if ($this->_tpl_vars['resultsPerPage'] == 100): ?> selected="selected"<?php endif; ?>>100</option>
    			</select>
    	por página | Total <strong><?php echo $this->_tpl_vars['count']; ?>
</strong> registros encontrados
	</div>