{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}
{literal}
<script type="text/javascript">
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
       			<div id="box">
       				{include file="actions/Config/promotions.tpl"}
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