{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI.js"></script>
<script type="text/javascript">
{literal}

	$j = jQuery.noConflict();
	$j(document).ready(function() {
{/literal}
		{if $url == "Admin/Users/EditUser"}
			populate('country', {$user.country_id});
			{if $user.country_id == 76}
			populate('state', {$user.state_id}, 76);
			populate('city', {$user.city_id}, {$user.state_id});
			{else}
			trocaDom(null, {$user.country_id});
			{/if}
		{else}	
			populate('country', 76);
			populate('state',null, 76);
			populate('city', null, 26);
		{/if}
{literal}
	});
</script>
{/literal}
</head>

<body>
	<div id="container">
    	<div id="header">
        	<h2>{$header}</h2>
    		<div id="topmenu">
            	{include file="includes/topmenu.tpl"}
          	</div>
      	</div>
        <div id="top-panel">
            <div id="panel">
                {include file="includes/panel.tpl"}
            </div>
      </div>
        <div id="wrapper">
            <div id="content">              
                <div id="box">
                	{include file="actions/Users/adduser.tpl"}
                </div>
            </div>
            <div id="sidebar">
  				{include file="includes/sidebar.tpl"}
          </div>
      </div>
        <div id="footer">
			{include file="includes/footer.tpl"}
        </div>
</div>

</body>
</html>
