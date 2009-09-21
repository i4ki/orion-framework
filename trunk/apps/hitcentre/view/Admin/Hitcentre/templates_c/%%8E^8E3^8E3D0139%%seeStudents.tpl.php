<?php /* Smarty version 2.6.23, created on 2009-09-10 01:44:02
         compiled from actions/School/seeStudents.tpl */ ?>
<h3>Alunos</h3>
	<table width="100%">
		<thead>
			<tr>
            	<th width="40px"><a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/id/<?php echo $this->_tpl_vars['order']; ?>
" title="Ordenar pelo id">ID<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th><a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/firstname/<?php echo $this->_tpl_vars['order']; ?>
">Nome Completo</a></th>
				<th><a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/course/<?php echo $this->_tpl_vars['order']; ?>
">Curso</a></th>
				<th><a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/language/<?php echo $this->_tpl_vars['order']; ?>
">Idioma</a></th>
				<th><a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/teacher/<?php echo $this->_tpl_vars['order']; ?>
">Professor</a></th>
                <th><a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/status/<?php echo $this->_tpl_vars['order']; ?>
">Situação</a></th>
                <th width="60px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['student']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td class="a-center"><?php echo $this->_tpl_vars['student'][$this->_sections['u']['index']]['id']; ?>
</td>
				<td><center><a href="#"><?php echo $this->_tpl_vars['student'][$this->_sections['u']['index']]['name']; ?>
</center></a></td>
				<td><center><?php echo $this->_tpl_vars['student'][$this->_sections['u']['index']]['course']; ?>
</center></td>
				<td><center><?php echo $this->_tpl_vars['student'][$this->_sections['u']['index']]['language']; ?>
</center></td>
				<td><center><?php echo $this->_tpl_vars['student'][$this->_sections['u']['index']]['teacher']; ?>
</center></td>
				<td><center><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/fam_bullet_success.gif" width="16" height="16" /></center></td>
				<td><a href="javascript:void(0)" onclick=""><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user.png" title="Ver Perfil" width="16" height="16" /></a><a href="Admin/School/viewStudent/<?php echo $this->_tpl_vars['student'][$this->_sections['u']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_edit.png" title="Editar Estudante" width="16" height="16" /></a><a href="Admin/School/DeleteStudent/<?php echo $this->_tpl_vars['student'][$this->_sections['u']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user_delete.png" title="Deletar usuário" width="16" height="16" /></a></td>
			</tr>
			<?php endfor; endif; ?>
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']-1; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
    	<a href="Admin/School/Students/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']+1; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong><?php echo $this->_tpl_vars['totalPage']; ?>
</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Students/'+this.value+'/<?php echo $this->_tpl_vars['page']; ?>
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