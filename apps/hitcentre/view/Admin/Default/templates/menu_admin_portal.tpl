{* smarty/templates/menu.tpl *}

{* $domain é o dominio do site *}
<ul id="menu_dropdown" class="menubar">
	<li class="submenu"><a href="{$domain}admin/index/">Principal</a></li>
	<li class="submenu"><a href="{$domain}admin/financeiro">Financeiro</a></li>
	<li class="submenu"><a href="{$domain}admin/empresa">Hitcentre</a></li>
	<li class="submenu"><a href="{$domain}admin/relatorios">Relatórios</a>
	<ul class="menu">
		<li class="item"><a href="{$domain}admin/relatorios/acesso">Acesso</a></li>
		<li class="item"><a href="{$domain}admin/relatorios/config">Configurações</a></li>
	</ul>
	</li>
<li class="submenu"><a href="{$domain}admin/configuracoes">Configuraçoes Gerais</a>
<ul class="menu">
	<li class="item"><a href="{$domain}admin/configuracoes/portal">Portal</a></li>
	<li class="item"><a href="{$domain}admin/configuracoes/financeiro">Financeiro</a></li>
	<li class="item"><a href="{$domain}admin/configuracoes/empresa">Hitcentre</a></li>
	<li class="item"><a href="{$domain}admin/configuracoes/permissoes">Permissões de acesso</a></li>
</ul>
</li>
<li class="submenu"><a href="{$domain}admin/personalizacao">Personalizacao</a>
<ul class="menu">
	<li class="item"><a href="{$domain}admin/personalizacao/banners">Banners</a></li>
	<li class="item"><a href="{$domain}admin/personalizacao/slides">Slides</a></li>
	<li class="item"><a href="{$domain}admin/personalizacao/estrutura">Estrutura</a></li>
	<li class="item"><a href="{$domain}adminpersonalizacao/estilo">Estilo</a></li>
</ul>
</li>


</ul>