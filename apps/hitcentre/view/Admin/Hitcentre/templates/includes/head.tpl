<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">

<head>
<title>{$title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<base href="{$URL}" />
<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/theme.css" />
<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/style.css" />


{* Estilos do Módulo users *}
{if $url == "Admin/Users" || 
 	$url == "Admin/Users/AddUser" ||
 	$url == "Admin/Users/EditUser"
}<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/Users/users.css" />{/if}
{if $url == "Admin/Users/Perfil"} <link rel="stylesheet" type="text/css" href="{$pathAdmin}css/Users/perfil.css" />{/if}
{if $url == "Admin/Users/Groups"} <link rel="stylesheet" type="text/css" href="{$pathAdmin}css/Users/Groups/group.css" media="all" />{/if}

{* Estilos do Módulo School *}
{if $url == "Admin/School/Entries/Students" ||
	$url == "Admin/School/viewStudent"		||
	$url == "Admin/School/Entries/Company" ||
	$url == "Admin/School/Entries/Teachers"}
<link rel="stylesheet" href="{$pathAdmin}css/School/school.css" media="all" type="text/css" />
{/if}

{* Estilos do Módulo Config *}
{if $url == "Admin/Config/Portal"}<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/Config/portal.css" media="all" />{/if}
{if $url == "Admin/Config"}<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/Config/portal.css" media="all" />{/if}
{if $url == "Admin/Config/School"}<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/Config/school.css" media="all" />{/if}
{if $url == "Admin/Config/Administrators"}<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/Config/administrators.css" media="all" />{/if}

{if $url == "Admin/Login"}<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/login.css" media="all" />{/if}
<script>
	var StyleFile = "theme" + document.cookie.charAt(6) + ".css";
	if(document.cookie.match(/theme/))
		document.writeln('<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/' + StyleFile + '">'); 
</script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->

<!-- Bibliotecas proprietárias -->
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/formatcpf.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jquery.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/menu.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.metadata.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.validate.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.maskedinput.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.maskmoney.js"></script>
<!--script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jquery.form.js"></script-->

