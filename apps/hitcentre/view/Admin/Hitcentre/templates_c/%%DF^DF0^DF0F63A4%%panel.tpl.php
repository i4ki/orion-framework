<?php /* Smarty version 2.6.23, created on 2009-09-20 04:23:08
         compiled from includes/panel.tpl */ ?>

<?php if ($this->_tpl_vars['url'] == "Admin/Index"): ?>
<ul>
    <li><a href="#" class="report">Relatórios</a></li>
    <li><a href="#" class="report_seo">SEO Report</a></li>
    <li><a href="#" class="search">Busca</a></li>
</ul>
<?php elseif ($this->_tpl_vars['url'] == "Admin/Users" || $this->_tpl_vars['url'] == "Admin/Users/EditUser" || $this->_tpl_vars['url'] == "Admin/Users/Groups"): ?>
<ul>
	<li><a href="Admin/Users/AddUser" class="useradd">Adicionar usuário</a></li>
    <li><a href="Admin/Users/Groups" class="group">Grupos de Usuários</a></li>
	<li><a href="Admin/Users/Search" class="search">Encontrar usuário</a></li>
    <li><a href="Admin/Users/UsersOnline" class="online">Usuários Online</a></li>
</ul>
<?php elseif ($this->_tpl_vars['url'] == "Admin/Config" || $this->_tpl_vars['url'] == "Admin/Config/Portal" || $this->_tpl_vars['url'] == "Admin/Config/School" || $this->_tpl_vars['url'] == "Admin/Config/Administrators" || $this->_tpl_vars['url'] == "Admin/Config/Promotions" || $this->_tpl_vars['url'] == "Admin/Config/Newsletter"): ?>
<ul>
	<li><a href="Admin/Config/Portal" class="manage_page">Portal</a></li>
	<li><a href="Admin/Config/School" class="house">Escola</a></li>
	<li><a href="Admin/Config/Administrators" class="user">Administradores</a></li>
	<li><a href="Admin/Config/Promotions" class="promotions">Promoções</a></li>
	<li><a href="Admin/Config/Newsletter" class="newsletter">Newsletter</a></li>
</ul>
<?php elseif ($this->_tpl_vars['url'] == "Admin/School" || $this->_tpl_vars['url'] == "Admin/School/Students" || $this->_tpl_vars['url'] == "Admin/School/Teachers" || $this->_tpl_vars['url'] == "Admin/School/Entries/Students" || $this->_tpl_vars['url'] == "Admin/School/viewStudent" || $this->_tpl_vars['url'] == "Admin/School/Entries/Teachers" || $this->_tpl_vars['url'] == "Admin/School/Entries/Company" || $this->_tpl_vars['url'] == "Admin/School/Languages" || $this->_tpl_vars['url'] == "Admin/School/Courses"): ?>
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
<?php endif; ?>