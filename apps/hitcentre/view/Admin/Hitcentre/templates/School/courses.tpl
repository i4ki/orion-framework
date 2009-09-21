{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/cookies.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/rte/richtext.js"></script>
<!--script type="text/javascript" src="View/scriptaculo/Admin/adminUI.js"></script-->
{literal}
<script language="JavaScript" type="text/javascript">
<!--
function submitForm() 
{
	//make sure hidden and iframe values are in sync before submitting form
	//to sync only 1 rte, use updateRTE(rte)
	//to sync all rtes, use updateRTEs
	//updateRTE('rte1');
	updateRTEs();
	description = document.form_course.description.value;
	$j('#description_2').text(description);

	//change the following line to true to submit form
	return true;
}

//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("{/literal}{$pathAdmin}img/icons/", "apps/hitcentre/view/scriptaculo/rte/", ""{literal});
//-->
</script>
<noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

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
                	{include file="actions/School/courses.tpl"}
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
