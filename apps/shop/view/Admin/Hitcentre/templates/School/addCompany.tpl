{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="View/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="View/scriptaculo/Admin/adminUI.js"></script>
<script type="text/javascript">
{literal}

	$j = jQuery.noConflict();
	$j(document).ready(function() {
{/literal}

	{if $school.country_id != ''}
		populate('country', {$school.country_id});
	{else}
		{$school.country_id = 76}
		populate('country', {$school.state_id});
	{/if}

	{if $school.country_id == 76}
		{if $school.state_id == ''}
			{$school.state_id = 26}
		{/if}		
	{else}
		trocaDom(null, {$schooll.country_id});
	{/if}
	populate('state', {$school.state_id}, {$school.country_id});
	populate('city', {$school.city_id}, {$school.state_id});
		
{literal}
	});
	
	function aguarde() {
		alert('Área ainda em construção');
		return false;
	}
</script>
{/literal}
</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title"><h2>Hit Centre of Language</h2></title></div>
        	
        	<div id="account" name="account">
        	{include file="includes/account.tpl"}
        	</div>
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
            <div id="box" name="box">
            	{include file="actions/School/Entries/Company/add.tpl"}
            </div>
            </div>
            </div>
            <div id="sidebar">
  				{include file="includes/sidebar.tpl"}
          </div>
      </div>
        <div id="footer">
        <div id="credits">

        </div>
        <div id="styleswitcher">
            <ul>
                <li><a href="javascript: document.cookie='theme='; window.location.reload();" title="Default" id="blueswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=1'; window.location.reload();" title="Blue" id="defswitch">d</a></li>
                <li><a href="javascript: document.cookie='theme=2'; window.location.reload();" title="Green" id="greenswitch">g</a></li>
                <li><a href="javascript: document.cookie='theme=3'; window.location.reload();" title="Brown" id="brownswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=4'; window.location.reload();" title="Mix" id="mixswitch">m</a></li>
            </ul>
        </div><br />

        </div>
</div>
</body>
</html>

