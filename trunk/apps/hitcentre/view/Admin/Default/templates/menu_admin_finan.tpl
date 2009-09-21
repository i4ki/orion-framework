{* smarty/templates/menu.tpl *}

{* $domain é o dominio do site *}
<ul id="menu_dropdown" class="menubar">
	<li class="submenu"><a href="{$domain}index/">Principal</a></li>
	<li class="submenu"><a href="{$domain}financeiro">Financeiro</a></li>
	<li class="submenu"><a href="{$domain}empresa">Hitcentre</a></li>
	<li class="submenu"><a href="{$domain}relatorios">Relatórios</a>
	<ul class="menu">
		<li class="item"><a href="{$domain}relatorios/acesso">Acesso</a></li>
		<li class="item"><a href="{$domain}relatorios/config">Configurações</a></li>
	</ul>
	</li>
<li class="submenu"><a href="{$domain}configuracoes">Configuraçoes Gerais</a>
<ul class="menu">
	<li class="item"><a href="{$domain}configuracoes/portal">Portal</a></li>
	<li class="item"><a href="{$domain}configuracoes/financeiro">Financeiro</a></li>
	<li class="item"><a href="{$domain}configuracoes/empresa">Hitcentre</a></li>
	<li class="item"><a href="{$domain}configuracoes/permissoes">Permissões de acesso</a></li>
</ul>
</li>
<li class="submenu"><a href="{$domain}personalizacao">Personalizacao</a>
<ul class="menu">
	<li class="item"><a href="{$domain}personalizacao/banners">Banners</a></li>
	<li class="item"><a href="{$domain}personalizacao/slides">Slides</a></li>
	<li class="item"><a href="{$domain}personalizacao/estrutura">Estrutura</a></li>
	<li class="item"><a href="{$domain}personalizacao/estilo">Estilo</a></li>
</ul>
</li>


</ul>