{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/ajax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI.js"></script>

</head>

<body>
	<div id="container">
    	<div id="header">
        	<div id="title" name="title">
        		<h2>{$header}</h2>
        	</div>
        	<div id="account">
        		{include file="includes/account.tpl"}
        	</div>
			<div class="clear"></div>
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
                	{include file="actions/School/seeTeachers.tpl"}
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
