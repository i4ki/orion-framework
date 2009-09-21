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
		$url == "Admin/Config/Promotions" ||
		$url == "Admin/Config/Newsletter"}
<ul>
	<li><a href="Admin/Config/Portal" class="manage_page">Portal</a></li>
	<li><a href="Admin/Config/School" class="house">Escola</a></li>
	<li><a href="Admin/Config/Administrators" class="user">Administradores</a></li>
	<li><a href="Admin/Config/Promotions" class="promotions">Promoções</a></li>
	<li><a href="Admin/Config/Newsletter" class="newsletter">Newsletter</a></li>
</ul>
{elseif $url == "Admin/School"  				||
		$url == "Admin/School/Students"  		||
		$url == "Admin/School/Teachers"  		||
		$url == "Admin/School/Entries/Students" ||
		$url == "Admin/School/viewStudent"		||
		$url == "Admin/School/Entries/Teachers" ||
		$url == "Admin/School/Entries/Company" ||
		$url == "Admin/School/Languages"		||
		$url == "Admin/School/Courses"
}
<ul>
	<li><a href="Admin/School/Students" class="user">Alunos</a></li>
	<li><a href="Admin/School/Teachers" class="user">Professores</a></li>
	<li><a href="javascript:void(0)" 	class="addorder topmenu">Cadastros</a>
	<ul>
		<li>|&nbsp;<a href="Admin/School/Entries/Students" class="useradd item">Alunos</a></li>
		<li><a href="Admin/School/Entries/Teachers" class="useradd item">Professores</a></li>
		<li><a href="Admin/School/Entries/Companies" class="house item">Empresas</a>&nbsp;|&nbsp;</li>
	</ul>
	</li>
	<li><a href="Admin/School/Languages" class="courses">Idiomas</a></li>
	<li><a href="Admin/School/Courses" 	class="courses">Cursos</a></li>
	<li><a href="Admin/School/Events" 	class="events">Eventos</a></li>
</ul>
{/if}