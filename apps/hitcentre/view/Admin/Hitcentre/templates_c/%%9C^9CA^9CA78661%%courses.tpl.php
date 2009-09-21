<?php /* Smarty version 2.6.23, created on 2009-09-09 14:18:17
         compiled from actions/School/courses.tpl */ ?>
<h3>Cursos</h3>
	<table width="100%" class="seecourse">
		<thead>
			<tr>
            	<th width="10px"><a href="Admin/School/Courses/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/id/<?php echo $this->_tpl_vars['order']; ?>
" title="Ordenar pelo id">ID<img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th width="300px"><a href="Admin/School/Courses/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/name/<?php echo $this->_tpl_vars['order']; ?>
">Curso</a></th>
				<th width="30px"><a href="Admin/School/Courses/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']; ?>
/OrderBy/language/<?php echo $this->_tpl_vars['order']; ?>
">Idioma</a></th>
				<th width="30px"><center><a href="javascript:void(0)">Alunos Matriculados</a></center></td>
                <th width="40px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['courses']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td class="a-center"><?php echo $this->_tpl_vars['courses'][$this->_sections['u']['index']]['id']; ?>
</td>
				<td><center><a href="javascript:void(0)"><?php echo $this->_tpl_vars['courses'][$this->_sections['u']['index']]['name']; ?>
</center></a></td>
				<td><center><a href="javascript:void(0)"><?php echo $this->_tpl_vars['courses'][$this->_sections['u']['index']]['language']; ?>
</a></center></td>
				<td><center><a href="javascript:void(0)"><?php echo $this->_tpl_vars['courses'][$this->_sections['u']['index']]['students']; ?>
</center></a></td>
				<td><center><a href="Admin/School/Courses/Edit/<?php echo $this->_tpl_vars['courses'][$this->_sections['u']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/page_white_edit.png" title="Editar Curso" width="16" height="16" /></a><a href="Admin/School/Courses/Del/<?php echo $this->_tpl_vars['courses'][$this->_sections['u']['index']]['id']; ?>
" onclick="if(confirm('Você tem certeza que deseja excluir esse curso?')) return true; else return false;"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/page_white_delete.png" title="Deletar curso" width="16" height="16" /></a></center></td>
			</tr>
			
			<?php endfor; endif; ?>
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Courses/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']-1; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="<?php echo $this->_tpl_vars['page']; ?>
" />
    	<a href="Admin/School/Courses/<?php echo $this->_tpl_vars['resultsPerPage']; ?>
/<?php echo $this->_tpl_vars['page']+1; ?>
"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong><?php echo $this->_tpl_vars['totalPage']; ?>
</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Courses/'+this.value+'/<?php echo $this->_tpl_vars['page']; ?>
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
	<br />
	<div id="box">
		<?php if ($this->_tpl_vars['opt'] == 'add'): ?>
			<h3>Cadastrar Novo Curso</h3>
		<?php elseif ($this->_tpl_vars['opt'] == 'edit'): ?>
			<h3>Editar Curso</h3>
		<?php endif; ?>
		<form class="form" method="post" action="Admin/School/Courses/<?php if ($this->_tpl_vars['opt'] == 'add'): ?>Add<?php elseif ($this->_tpl_vars['opt'] == 'edit'): ?>Edit<?php endif; ?>" onSubmit="return submitForm()" name="form_course" enctype="multipart/form-data">
			<input type="hidden" name="courseid" id="courseid" value="<?php if ($this->_tpl_vars['opt'] == 'edit'): ?><?php echo $this->_tpl_vars['course']['id']; ?>
<?php endif; ?>" />
			<table align="center" width="70%" class="addcourse">
				<tr>
					<td class="label">Nome do curso:&nbsp;</td>
					<td class="input"><input type="text" name="name" id="name" maxlength="255" size="50" value="<?php if ($this->_tpl_vars['opt'] == 'edit'): ?><?php echo $this->_tpl_vars['course']['name']; ?>
<?php endif; ?>" /></td>
				</tr>
				<tr>
					<td class="label">Descrição:&nbsp;</td>
					<td>
					<?php echo '
		
			<script language="JavaScript" type="text/javascript">
			<!--
			//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
						
			writeRichText(\'description\', '; ?>
'<?php echo $this->_tpl_vars['course']['description']; ?>
'<?php echo '  , 360, 200, true, false);

			//-->
			</script>
			'; ?>

				<textarea name="description_2" id="description_2" style="display:none;"></textarea>
					</td>
				</tr>
				<tr>
					<td class="label">Idioma:&nbsp;</label></td>
					<td class="input">
							<select name="language" id="language">
								<option value="0">Selecione...</option>
								<?php unset($this->_sections['l']);
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['languages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['name'] = 'l';
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
									<option value="<?php echo $this->_tpl_vars['languages'][$this->_sections['l']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['opt'] == 'edit' && $this->_tpl_vars['course']['language'] == $this->_tpl_vars['languages'][$this->_sections['l']['index']]['name']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['languages'][$this->_sections['l']['index']]['name']; ?>
</option>
								<?php endfor; endif; ?>
							</select>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Salvar" /></td>
				</tr>
			</table>
		</form>
		
	</div>