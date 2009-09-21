<?php /* Smarty version 2.6.23, created on 2009-08-10 14:48:47
         compiled from includes/head.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">

<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<base href="<?php echo $this->_tpl_vars['URL']; ?>
" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/style.css" />

<?php if ($this->_tpl_vars['url'] == "Admin/Users" || $this->_tpl_vars['url'] == "Admin/Users/AddUser" || $this->_tpl_vars['url'] == "Admin/Users/EditUser"): ?><link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/Users/users.css" /><?php endif; ?>
<?php if ($this->_tpl_vars['url'] == "Admin/Users/Perfil"): ?> <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/Users/perfil.css" /><?php endif; ?>
<?php if ($this->_tpl_vars['url'] == "Admin/Users/Groups"): ?> <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/Users/Groups/group.css" media="all" /><?php endif; ?>

<?php if ($this->_tpl_vars['url'] == "Admin/School/Entries/Student" || $this->_tpl_vars['url'] == "Admin/School/Entries/Company" || $this->_tpl_vars['url'] == "Admin/School/Entries/Teacher"): ?>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/School/school.css" media="all" type="text/css" />
<?php endif; ?>

<?php if ($this->_tpl_vars['url'] == "Admin/Config/Portal"): ?><link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/Config/portal.css" media="all" /><?php endif; ?>
<?php if ($this->_tpl_vars['url'] == "Admin/Config"): ?><link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/Config/portal.css" media="all" /><?php endif; ?>
<?php if ($this->_tpl_vars['url'] == "Admin/Config/School"): ?><link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/Config/school.css" media="all" /><?php endif; ?>
<?php if ($this->_tpl_vars['url'] == "Admin/Config/Administrators"): ?><link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/Config/administrators.css" media="all" /><?php endif; ?>

<script>
   var StyleFile = "theme" + document.cookie.charAt(6) + ".css";
   document.writeln('<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['pathAdmin']; ?>
css/' + StyleFile + '">');
</script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->

<!-- Bibliotecas proprietárias -->

<script type="text/javascript" src="View/scriptaculo/jquery.js"></script>
<script type="text/javascript" src="View/scriptaculo/jquery.form.js"></script>
