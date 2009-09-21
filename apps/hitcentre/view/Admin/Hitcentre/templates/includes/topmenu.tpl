<ul>
	<li{if $url == "Admin/Index"} class="current"{/if}><a href="Admin/Index">Principal</a></li>
	<li{if 	$url == "Admin/School" ||
			$url == "Admin/School/Students" ||
			$url == "Admin/School/Teachers" ||
			$url == "Admin/School/Entries" ||
			$url == "Admin/School/Entries/Students" ||
			$url == "Admin/School/viewStudent" ||
			$url == "Admin/School/Entries/Teachers" ||
			$url == "Admin/School/Entries/Company" ||
			$url == "Admin/School/Languages" ||
			$url == "Admin/School/Courses"} class="current"{/if}><a href="Admin/School/Students">Escola</a></li>
    <li{if $url == "Admin/Financeiro"} class="current"{/if}><a href="Admin/Finance">Financeiro</a></li>
	<li{if  $url == "Admin/Users" || 
			$url == "Admin/Users/EditUser" || 
			$url == "Admin/Users/Painel" ||
			$url == "Admin/Users/Groups"} class="current"{/if}><a href="Admin/Users">Usuários</a></li>
    <li{if 	$url == "Admin/Maintenance"} class="current"{/if}><a href="Admin/Maintenance">Manutenção</a></li>
    <li{if 	$url == "Admin/Portal"} class="current"{/if}><a href="Admin/Portal">Portal</a></li>
    <li{if 	$url == "Admin/Statistics"} class="current"{/if}><a href="Admin/Statistics">Estatísticas</a></li>
    <li{if 	$url == "Admin/Config" ||
    		$url == "Admin/Config/Portal" ||
    		$url == "Admin/Config/School" ||
    		$url == "Admin/Config/Administrators" ||
    		$url == "Admin/Config/Promotions" 	||
			$url == "Admin/Config/Newsletter"} class="current"{/if}><a href="Admin/Config">Configurações</a></li>
</ul>