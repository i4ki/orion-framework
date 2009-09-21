{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/cookies.js"></script>
<!--script type="text/javascript" src="View/scriptaculo/Admin/adminUI.js"></script-->
{literal}
<style type="text/css" media="all">
table.addcourse td {border:none;}
table.seecourse {width:500px;margin:0 auto;}
td.label {text-align:right;}
#pager {width:550px;margin:0 auto;}
</style>
{/literal}

</head>

<body>
	<div id="container">
    	<div id="header">
        	<div id="title">
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
                	{include file="actions/School/seeCompanies.tpl"}
                <br />
                	
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
