{* ARQUIVO DE CONFIGURAÇÃO DO PANEL
 * Dependendo da $URL SERÁ EXIBIDO UM PANEL DIFERENTE
 *}

{if $url == "Admin/Index"}
<ul>
    <li><a href="#" class="report">Relatórios</a></li>
    <li><a href="#" class="report_seo">SEO Report</a></li>
    <li><a href="#" class="search">Busca</a></li>
</ul>
{elseif $url == "Admin/Users" || 
		$url == "Admin/Users/EditUser" ||
		$url == "Admin/Users/Groups" }
<ul>
	<li><a href="Admin/Users/AddUser" class="useradd">Adicionar usuário</a></li>
    <li><a href="Admin/Users/Groups" class="group">Grupos de Usuários</a></li>
	<li><a href="Admin/Users/Search" class="search">Encontrar usuário</a></li>
    <li><a href="Admin/Users/UsersOnline" class="online">Usuários Online</a></li>
</ul>
{elseif $url == "Admin/Config" ||
		$url == "Admin/Config/Portal" ||
		$url == "Admin/Config/School" ||
		$url == "Admin/Config/Administrators" ||
		$url == "Admin/Config/Promotions" }
<ul>
	<li><a href="Admin/Config/Portal" class="manage_page">Portal</a></li>
	<li><a href="Admin/Config/School" class="house">Escola</a></li>
	<li><a href="Admin/Config/Administrators" class="user">Administradores</a></li>
	<li><a href="Admin/Config/Promotions" class="promotions">Promoções</a></li>
</ul>
{elseif $url == "Admin/School" }
<ul>
	<li><a href="Admin/School/Entries" class="addorder">Cadastros</a></li>
	<li><a href="Admin/School/Courses" class="courses">Cursos</a></li>
</ul>
{elseif $url == "Admin/School/Entries" ||
		$url == "Admin/School/Entries/Students" ||
		$url == "Admin/School/Entries/Teachers" }
<ul>
	<li><a href="Admin/School/Entries/Students" class="students">Alunos</a></li>
	<li><a href="Admin/School/Entries/Teachers" class="teachers">Professores</a></li>
</ul>	
{/if}