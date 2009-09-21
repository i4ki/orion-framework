<?php /* Smarty version 2.6.23, created on 2009-08-10 14:48:47
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
<?php elseif ($this->_tpl_vars['url'] == "Admin/Config" || $this->_tpl_vars['url'] == "Admin/Config/Portal" || $this->_tpl_vars['url'] == "Admin/Config/School" || $this->_tpl_vars['url'] == "Admin/Config/Administrators" || $this->_tpl_vars['url'] == "Admin/Config/Promotions"): ?>
<ul>
	<li><a href="Admin/Config/Portal" class="manage_page">Portal</a></li>
	<li><a href="Admin/Config/School" class="house">Escola</a></li>
	<li><a href="Admin/Config/Administrators" class="user">Administradores</a></li>
	<li><a href="Admin/Config/Promotions" class="promotions">Promoções</a></li>
</ul>
<?php elseif ($this->_tpl_vars['url'] == "Admin/School"): ?>
<ul>
	<li><a href="Admin/School/Entries" class="addorder">Cadastros</a></li>
	<li><a href="Admin/School/Courses" class="courses">Cursos</a></li>
</ul>
<?php elseif ($this->_tpl_vars['url'] == "Admin/School/Entries" || $this->_tpl_vars['url'] == "Admin/School/Entries/Students" || $this->_tpl_vars['url'] == "Admin/School/Entries/Teachers"): ?>
<ul>
	<li><a href="Admin/School/Entries/Students" class="students">Alunos</a></li>
	<li><a href="Admin/School/Entries/Teachers" class="teachers">Professores</a></li>
</ul>	
<?php endif; ?>