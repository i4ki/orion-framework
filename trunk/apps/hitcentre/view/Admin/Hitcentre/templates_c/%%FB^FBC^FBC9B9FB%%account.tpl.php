<?php /* Smarty version 2.6.23, created on 2009-09-20 04:23:08
         compiled from includes/account.tpl */ ?>
<br />
<table class="none">
	<tr>
		<td class="label2"><img src="<?php echo $this->_tpl_vars['pathAdmin']; ?>
img/icons/user.png" align="middle"/></td>
		<td class="data"><a href="Admin/Users/MyAccount/<?php echo $this->_tpl_vars['session']['id']; ?>
" title="Minha Conta"><?php echo $this->_tpl_vars['session']['username']; ?>
</a></td>
		<td class="data"><a href="Admin/Login">logout</a></td>
	</tr>
</table>