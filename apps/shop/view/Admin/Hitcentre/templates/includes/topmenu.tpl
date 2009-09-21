	<ul>
	<li{if $url == "Admin/Index"} class="current"{/if}><a href="Admin/Index">Principal</a></li>
	<li{if 	$url == "Admin/School" ||
			$url == "Admin/School/Entries" ||
			$url == "Admin/School/Entries/Student" ||
			$url == "Admin/School/Entries/Company"} class="current"{/if}><a href="Admin/School">Escola</a></li>
    <li{if $url == "Admin/Financeiro"} class="current"{/if}><a href="javascript:void(0)" onclick="aguarde();">Financeiro</a></li>
	<li{if  $url == "Admin/Users" || 
			$url == "Admin/Users/EditUser" || 
			$url == "Admin/Users/Painel" ||
			$url == "Admin/Users/Groups"} class="current"{/if}><a href="Admin/Users">Usuários</a></li>
    <li{if 	$url == "Admin/Maintenance"} class="current"{/if}><a href="javascript:void(0)" onclick="aguarde();">Manutenção</a></li>
    <li{if 	$url == "Admin/Portal"} class="current"{/if}><a href="javascript:void(0)" onclick="aguarde();">Portal</a></li>
    <li{if 	$url == "Admin/Statistics"} class="current"{/if}><a href="javascript:void(0)" onclick="aguarde();">Estatísticas</a></li>
    <li{if 	$url == "Admin/Config" ||
    		$url == "Admin/Config/Portal" ||
    		$url == "Admin/Config/School" ||
    		$url == "Admin/Config/Administrators" ||
    		$url == "Admin/Config/Promotions"} class="current"{/if}><a href="Admin/Config">Configurações</a></li>
</ul>