<h3>Cursos</h3>
	<table width="100%" class="seecourse">
		<thead>
			<tr>
            	<th width="10px"><a href="Admin/School/Courses/{$resultsPerPage}/{$page}/OrderBy/id/{$order}" title="Ordenar pelo id">ID<img src="{$pathAdmin}img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
            	<th width="300px"><a href="Admin/School/Courses/{$resultsPerPage}/{$page}/OrderBy/name/{$order}">Curso</a></th>
				<th width="30px"><a href="Admin/School/Courses/{$resultsPerPage}/{$page}/OrderBy/language/{$order}">Idioma</a></th>
				<th width="30px"><center><a href="javascript:void(0)">Alunos Matriculados</a></center></td>
                <th width="40px"><a href="javascript:void(0)">Ação</a></th>
            </tr>
		</thead>
		<tbody>
			{section name=u loop=$courses}
			<tr>
				<td class="a-center">{$courses[u].id}</td>
				<td><center><a href="javascript:void(0)">{$courses[u].name}</center></a></td>
				<td><center><a href="javascript:void(0)">{$courses[u].language}</a></center></td>
				<td><center><a href="javascript:void(0)">{$courses[u].students}</center></a></td>
				<td><center><a href="Admin/School/Courses/Edit/{$courses[u].id}"><img src="{$pathAdmin}img/icons/page_white_edit.png" title="Editar Curso" width="16" height="16" /></a><a href="Admin/School/Courses/Del/{$courses[u].id}" onclick="if(confirm('Você tem certeza que deseja excluir esse curso?')) return true; else return false;"><img src="{$pathAdmin}img/icons/page_white_delete.png" title="Deletar curso" width="16" height="16" /></a></center></td>
			</tr>
			
			{/section}
		</tbody>
	</table>

    <div id="pager">
    	Página <a href="Admin/School/Courses/{$resultsPerPage}/{$page-1}"><img src="{$pathAdmin}img/icons/arrow_left.gif" width="16" height="16" /></a>
    	<input size="1" type="text" name="page" id="page" value="{$page}" />
    	<a href="Admin/School/Courses/{$resultsPerPage}/{$page+1}"><img src="{$pathAdmin}img/icons/arrow_right.gif" width="16" height="16" /></a>de <strong>{$totalPage}</strong>
    	páginas&nbsp;|&nbsp;Visualizar <select name="resultsPerPage" id="resultsPerPage" onchange="window.location.href='Admin/School/Courses/'+this.value+'/{$page}'">
    				<option{if $resultsPerPage == 5} selected="selected"{/if}>5</option>
					<option{if $resultsPerPage == 10} selected="selected"{/if}>10</option>
                    <option{if $resultsPerPage == 25} selected="selected"{/if}>25</option>
                    <option{if $resultsPerPage == 30} selected="selected"{/if}>30</option>
                    <option{if $resultsPerPage == 50} selected="selected"{/if}>50</option>
					<option{if $resultsPerPage == 75} selected="selected"{/if}>75</option>
					<option{if $resultsPerPage == 100} selected="selected"{/if}>100</option>
    			</select>
    	por página | Total <strong>{$count}</strong> registros encontrados
	</div>
	<br />
	<div id="box">
		{if $opt == "add"}
			<h3>Cadastrar Novo Curso</h3>
		{elseif $opt == "edit"}
			<h3>Editar Curso</h3>
		{/if}
		<form class="form" method="post" action="Admin/School/Courses/{if $opt == 'add'}Add{elseif $opt == 'edit'}Edit{/if}" onSubmit="return submitForm()" name="form_course" enctype="multipart/form-data">
			<input type="hidden" name="courseid" id="courseid" value="{if $opt == 'edit'}{$course.id}{/if}" />
			<table align="center" width="70%" class="addcourse">
				<tr>
					<td class="label">Nome do curso:&nbsp;</td>
					<td class="input"><input type="text" name="name" id="name" maxlength="255" size="50" value="{if $opt == 'edit'}{$course.name}{/if}" /></td>
				</tr>
				<tr>
					<td class="label">Descrição:&nbsp;</td>
					<td>
					{literal}
		
			<script language="JavaScript" type="text/javascript">
			<!--
			//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
						
			writeRichText('description', {/literal}'{$course.description}'{literal}  , 360, 200, true, false);

			//-->
			</script>
			{/literal}
				<textarea name="description_2" id="description_2" style="display:none;"></textarea>
					</td>
				</tr>
				<tr>
					<td class="label">Idioma:&nbsp;</label></td>
					<td class="input">
							<select name="language" id="language">
								<option value="0">Selecione...</option>
								{section loop=$languages name=l}
									<option value="{$languages[l].id}"{if $opt == 'edit' && $course.language == $languages[l].name} selected="selected"{/if}>{$languages[l].name}</option>
								{/section}
							</select>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Salvar" /></td>
				</tr>
			</table>
		</form>
		
	</div>