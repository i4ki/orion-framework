<?php /* Smarty version 2.6.23, created on 2009-09-20 04:23:08
         compiled from includes/topmenu.tpl */ ?>
<ul>
	<li<?php if ($this->_tpl_vars['url'] == "Admin/Index"): ?> class="current"<?php endif; ?>><a href="Admin/Index">Principal</a></li>
	<li<?php if ($this->_tpl_vars['url'] == "Admin/School" || $this->_tpl_vars['url'] == "Admin/School/Students" || $this->_tpl_vars['url'] == "Admin/School/Teachers" || $this->_tpl_vars['url'] == "Admin/School/Entries" || $this->_tpl_vars['url'] == "Admin/School/Entries/Students" || $this->_tpl_vars['url'] == "Admin/School/viewStudent" || $this->_tpl_vars['url'] == "Admin/School/Entries/Teachers" || $this->_tpl_vars['url'] == "Admin/School/Entries/Company" || $this->_tpl_vars['url'] == "Admin/School/Languages" || $this->_tpl_vars['url'] == "Admin/School/Courses"): ?> class="current"<?php endif; ?>><a href="Admin/School/Students">Escola</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Financeiro"): ?> class="current"<?php endif; ?>><a href="Admin/Finance">Financeiro</a></li>
	<li<?php if ($this->_tpl_vars['url'] == "Admin/Users" || $this->_tpl_vars['url'] == "Admin/Users/EditUser" || $this->_tpl_vars['url'] == "Admin/Users/Painel" || $this->_tpl_vars['url'] == "Admin/Users/Groups"): ?> class="current"<?php endif; ?>><a href="Admin/Users">Usuários</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Maintenance"): ?> class="current"<?php endif; ?>><a href="Admin/Maintenance">Manutenção</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Portal"): ?> class="current"<?php endif; ?>><a href="Admin/Portal">Portal</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Statistics"): ?> class="current"<?php endif; ?>><a href="Admin/Statistics">Estatísticas</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Config" || $this->_tpl_vars['url'] == "Admin/Config/Portal" || $this->_tpl_vars['url'] == "Admin/Config/School" || $this->_tpl_vars['url'] == "Admin/Config/Administrators" || $this->_tpl_vars['url'] == "Admin/Config/Promotions" || $this->_tpl_vars['url'] == "Admin/Config/Newsletter"): ?> class="current"<?php endif; ?>><a href="Admin/Config">Configurações</a></li>
</ul>