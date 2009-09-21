{* Template by Tiago Moura *}
{* Date: 28/05/2009 *}

{include file="includes/head.tpl"}
<link rel="stylesheet" type="text/css" href="{$pathAdmin}css/DatePicker.css" />

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.metadata.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.validate.js"></script>

<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.easyAjax.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/Admin/adminUI2.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/date.js"></script>
<script type="text/javascript" src="apps/hitcentre/view/scriptaculo/jQuery/jquery.datePicker.js"></script>
<script type="text/javascript" src="{$add_student}"></script>

</head>
<body>
	<div id="container">
    	<div id="header">
        	<div id="title"><h2>Hit Centre of Language</h2></title></div>
        	
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
				<div id="box" name="box">
					{include file="actions/School/Entries/addStudent.tpl"}
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