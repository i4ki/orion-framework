<?php /* Smarty version 2.6.23, created on 2009-08-10 14:48:47
         compiled from includes/topmenu.tpl */ ?>
	<ul>
	<li<?php if ($this->_tpl_vars['url'] == "Admin/Index"): ?> class="current"<?php endif; ?>><a href="Admin/Index">Principal</a></li>
	<li<?php if ($this->_tpl_vars['url'] == "Admin/School" || $this->_tpl_vars['url'] == "Admin/School/Entries" || $this->_tpl_vars['url'] == "Admin/School/Entries/Student" || $this->_tpl_vars['url'] == "Admin/School/Entries/Company"): ?> class="current"<?php endif; ?>><a href="Admin/School">Escola</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Financeiro"): ?> class="current"<?php endif; ?>><a href="javascript:void(0)" onclick="aguarde();">Financeiro</a></li>
	<li<?php if ($this->_tpl_vars['url'] == "Admin/Users" || $this->_tpl_vars['url'] == "Admin/Users/EditUser" || $this->_tpl_vars['url'] == "Admin/Users/Painel" || $this->_tpl_vars['url'] == "Admin/Users/Groups"): ?> class="current"<?php endif; ?>><a href="Admin/Users">Usuários</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Maintenance"): ?> class="current"<?php endif; ?>><a href="javascript:void(0)" onclick="aguarde();">Manutenção</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Portal"): ?> class="current"<?php endif; ?>><a href="javascript:void(0)" onclick="aguarde();">Portal</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Statistics"): ?> class="current"<?php endif; ?>><a href="javascript:void(0)" onclick="aguarde();">Estatísticas</a></li>
    <li<?php if ($this->_tpl_vars['url'] == "Admin/Config" || $this->_tpl_vars['url'] == "Admin/Config/Portal" || $this->_tpl_vars['url'] == "Admin/Config/School" || $this->_tpl_vars['url'] == "Admin/Config/Administrators" || $this->_tpl_vars['url'] == "Admin/Config/Promotions"): ?> class="current"<?php endif; ?>><a href="Admin/Config">Configurações</a></li>
</ul>