<?php /* Smarty version 2.6.23, created on 2009-05-31 03:57:33
         compiled from Index.tpl */ ?>
{* TEMPLATE ADMIN -> INDEX.PHP *}
{* DEFAULT COLOR: WHITE *}
{* By Tiago Natel de Moura *}

{include file="head.tpl"}

<body onload="menuDropDown();">
	<div id="main" name="main">
		<div id="topo" name="topo">{$topo}<h1><center>:: TOPO ::</center></h1></div>
		<div id="menu" name="menu">
			{include file="menu_admin_portal.tpl"}
		</div>
		<div class="clear"></div>
		<div id="conteudo" name="conteudo">
			<div id="imagem" name="imagem">

			</div>
			<div id="box" name="box">
				{$conteudo}
			</div>
		</div>
	</div>
</body>
</html>