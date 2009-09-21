<?php

if($_POST) {
	print_r($_POST);
	exit(0);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Filament Group Lab</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <script type="text/javascript" src="jQuery/jquery.js"></script>
    <script type="text/javascript" src="jQuery/fg.menu.js"></script>
	<script type="text/javascript" src="jquery.easyAjax.js"></script>

    <link type="text/css" href="jQuery/ipodMenu/fg-menu/fg.menu.css" media="screen" rel="stylesheet" />
    <link type="text/css" href="jQuery/ipodMenu/fg-menu/theme/ui.all.css" media="screen" rel="stylesheet" />

    <!-- styles for this example page only -->
	<style type="text/css">
	body { font-size:62.5%; margin:0; padding:0; }
	#menuLog { font-size:1.4em; margin:20px; }
	.hidden { position:absolute; top:0; left:-9999px; width:1px; height:1px; overflow:hidden; }

	.fg-button {
	    clear:left;
	    margin:0 4px 40px 20px;
	    padding: .4em 1em;
	    text-decoration:none !important;
	    cursor:pointer;
	    position: relative;
	    text-align: center;
	    zoom: 1;
	 }
	.fg-button .ui-icon { position: absolute; top: 50%; margin-top: -8px; left: 50%; margin-left: -8px; }
	a.fg-button { float:left;  }
	button.fg-button { width:auto; overflow:visible; } /* removes extra button width in IE */

	.fg-button-icon-left { padding-left: 2.1em; }
	.fg-button-icon-right { padding-right: 2.1em; }
	.fg-button-icon-left .ui-icon { right: auto; left: .2em; margin-left: 0; }
	.fg-button-icon-right .ui-icon { left: auto; right: .2em; margin-left: 0; }
	.fg-button-icon-solo { display:block; width:8px; text-indent: -9999px; }	 /* solo icon buttons must have block properties for the text-indent to work */

	.fg-button.ui-state-loading .ui-icon { background: url(spinner_bar.gif) no-repeat 0 0; }
	</style>

	<!-- style exceptions for IE 6 -->
	<!--[if IE 6]>
	<style type="text/css">
		.fg-menu-ipod .fg-menu li { width: 95%; }
		.fg-menu-ipod .ui-widget-content { border:0; }
	</style>
	<![endif]-->

    <script type="text/javascript">
    $(function(){
		    	
		$('#teste-ajax').easyAjax({
			url: 'http://localhost/hitcentre/Admin',
			loader: true,
			highlightTarget: true,
			typeResponse: 'append'
		});

		
    });
    </script>

    <!-- theme switcher button -->
    <!--script type="text/javascript" src="http://ui.jquery.com/applications/themeroller/themeswitchertool/"></script>
	<script type="text/javascript"> $(function(){ $('<div style="position: absolute; top: 20px; right: 300px;" />').appendTo('body').themeswitcher(); }); </script-->
</head>

<body>

<div id="teste-ajax">Testando ajax</div>
<br />

<p id="menuLog">You chose: <span id="menuSelection"></span></p>

<a tabindex="0" href="#search-engines" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flat"><span class="ui-icon ui-icon-triangle-1-s"></span>flat menu</a>
<div id="search-engines" class="hidden">
<ul>
	<li><a href="#">Google</a></li>
	<li><a href="#">Yahoo</a></li>
	<li><a href="#">MSN</a></li>
	<li><a href="#">Ask</a></li>
	<li><a href="#">AOL</a></li>
</ul>
</div>

<a tabindex="0" href="menuContent.html" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flyout"><span class="ui-icon ui-icon-triangle-1-s"></span>flyout menu</a>

<a tabindex="0" href="#news-items" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="hierarchy"><span class="ui-icon ui-icon-triangle-1-s"></span>ipod-style menu</a>
<div id="news-items" class="hidden">
<ul>
	<li><a href="#">Breaking News</a>
		<ul>
			<li><a href="#">Entertainment</a></li>
			<li><a href="http://www.w3schools.com/tags/html5.asp">Politics</a></li>
			<li><a href="#">A&amp;E</a></li>
			<li><a href="#">Sports</a>
				<ul>
					<li><a href="#">Baseball</a></li>
					<li><a href="#">Basketball</a></li>
					<li><a href="#">A really long label would wrap nicely as you can see</a></li>
					<li><a href="#">Swimming</a>
						<ul>
							<li><a href="#">High School</a></li>
							<li><a href="#">College</a></li>
							<li><a href="#">Professional</a>
								<ul>
									<li><a href="#">Mens Swimming</a>
										<ul>
											<li><a href="#">News</a></li>
											<li><a href="#">Events</a></li>
											<li><a href="#">Awards</a></li>
											<li><a href="#">Schedule</a></li>
											<li><a href="#">Team Members</a></li>
											<li><a href="#">Fan Site</a></li>
										</ul>
									</li>
									<li><a href="#">Womens Swimming</a>
										<ul>
											<li><a href="#">News</a></li>
											<li><a href="#">Events</a></li>
											<li><a href="#">Awards</a></li>
											<li><a href="#">Schedule</a></li>
											<li><a href="#">Team Members</a></li>
											<li><a href="#">Fan Site</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="#">Adult Recreational</a></li>
							<li><a href="#">Youth Recreational</a></li>
							<li><a href="#">Senior Recreational</a></li>
						</ul>
					</li>
					<li><a href="#">Tennis</a></li>
					<li><a href="#">Ice Skating</a></li>
					<li><a href="#">Javascript Programming</a></li>
					<li><a href="#">Running</a></li>
					<li><a href="#">Walking</a></li>
				</ul>
			</li>
			<li><a href="#">Local</a></li>
			<li><a href="#">Health</a></li>
		</ul>
	</li>
	<li><a href="#">Entertainment</a>
	<ul>
		<li><a href="#">Celebrity news</a></li>
		<li><a href="#">Gossip</a></li>
		<li><a href="#">Movies</a></li>
		<li><a href="#">Music</a>
		<ul>
			<li><a href="#">Alternative</a></li>
			<li><a href="#">Country</a></li>
			<li><a href="#">Dance</a></li>
			<li><a href="#">Electronica</a></li>
			<li><a href="#">Metal</a></li>
			<li><a href="#">Pop</a></li>
			<li><a href="#">Rock</a>
				<ul>
					<li><a href="#">Bands</a>
						<ul>
							<li><a href="#">Dokken</a></li>
						</ul>
					</li>
					<li><a href="#">Fan Clubs</a></li>
					<li><a href="#">Songs</a></li>
				</ul>
			</li>
		</ul>
		</li>
		<li><a href="#">Slide shows</a></li>
		<li><a href="#">Red carpet</a></li>
	</ul>
	</li>
	<li><a href="#">Finance</a>
	<ul>
		<li><a href="#">Personal</a>
		<ul>
			<li><a href="#">Loans</a></li>
			<li><a href="#">Savings</a></li>
			<li><a href="#">Mortgage</a></li>
			<li><a href="#">Debt</a></li>
		</ul>
		</li>
		<li><a href="#">Business</a></li>
	</ul>
	</li>
	<li><a href="#">Food &#38; Cooking</a>
	<ul>
		<li><a href="#">Breakfast</a></li>
		<li><a href="#">Lunch</a></li>
		<li><a href="#">Dinner</a></li>
		<li><a href="#">Dessert</a>
			<ul>
				<li><a href="#">Dump Cake</a></li>
				<li><a href="#">Doritos</a></li>
				<li><a href="#">Both please.</a></li>
			</ul>
		</li>
	</ul>
	</li>
	<li><a href="#">Lifestyle</a></li>
	<li><a href="#">News</a></li>
	<li><a href="#">Politics</a></li>
	<li><a href="#">Sports</a>
		<ul>
			<li><a href="#">Baseball</a></li>
			<li><a href="#">Basketball</a></li>
			<li><a href="#">Swimming</a>
			<ul>
				<li><a href="#">High School</a></li>
				<li><a href="#">College</a></li>
				<li><a href="#">Professional</a>
				<ul>
					<li><a href="#">Mens Swimming</a>
					<ul>
							<li><a href="#">News</a></li>
							<li><a href="#">Events</a></li>
							<li><a href="#">Awards</a></li>
							<li><a href="#">Schedule</a></li>
							<li><a href="#">Team Members</a></li>
							<li><a href="#">Fan Site</a></li>
						</ul>
					</li>
					<li><a href="#">Womens Swimming</a>
					<ul>
						<li><a href="#">News</a></li>
						<li><a href="#">Events</a></li>
						<li><a href="#">Awards</a></li>
						<li><a href="#">Schedule</a></li>
						<li><a href="#">Team Members</a></li>
						<li><a href="#">Fan Site</a></li>
					</ul>
					</li>
				</ul>
				</li>
				<li><a href="#">Adult Recreational</a></li>
				<li><a href="#">Youth Recreational</a></li>
				<li><a href="#">Senior Recreational</a></li>
			</ul>
			</li>
			<li><a href="#">Tennis</a></li>
			<li><a href="#">Ice Skating</a></li>
			<li><a href="#">Javascript Programming</a></li>
			<li><a href="#">Running</a></li>
			<li><a href="#">Walking</a></li>
		</ul>
		</li>
	</ul>
</div>

<a tabindex="0" href="#news-items-2" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="hierarchybreadcrumb"><span class="ui-icon ui-icon-triangle-1-s"></span>ipod-style menu w/ breadcrumb</a>
<div id="news-items-2" class="hidden">
<ul>
	<li><a href="#">Breaking News</a>
		<ul>
			<li><a href="#">Entertainment</a></li>
			<li><a href="#">Politics</a></li>
			<li><a href="#">A&amp;E</a></li>
			<li><a href="#">Sports</a>
				<ul>
					<li><a href="#">Baseball</a></li>
					<li><a href="#">Basketball</a></li>
					<li><a href="#">A really long label would wrap nicely as you can see</a></li>
					<li><a href="#">Swimming</a>
						<ul>
							<li><a href="#">High School</a></li>
							<li><a href="#">College</a></li>
							<li><a href="#">Professional</a>
								<ul>
									<li><a href="#">Mens Swimming</a>
										<ul>
											<li><a href="#">News</a></li>
											<li><a href="#">Events</a></li>
											<li><a href="#">Awards</a></li>
											<li><a href="#">Schedule</a></li>
											<li><a href="#">Team Members</a></li>
											<li><a href="#">Fan Site</a></li>
										</ul>
									</li>
									<li><a href="#">Womens Swimming</a>
										<ul>
											<li><a href="#">News</a></li>
											<li><a href="#">Events</a></li>
											<li><a href="#">Awards</a></li>
											<li><a href="#">Schedule</a></li>
											<li><a href="#">Team Members</a></li>
											<li><a href="#">Fan Site</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="#">Adult Recreational</a></li>
							<li><a href="#">Youth Recreational</a></li>
							<li><a href="#">Senior Recreational</a></li>
						</ul>
					</li>
					<li><a href="#">Tennis</a></li>
					<li><a href="#">Ice Skating</a></li>
					<li><a href="#">Javascript Programming</a></li>
					<li><a href="#">Running</a></li>
					<li><a href="#">Walking</a></li>
				</ul>
			</li>
			<li><a href="#">Local</a></li>
			<li><a href="#">Health</a></li>
		</ul>
	</li>
	<li><a href="#">Entertainment</a>
	<ul>
		<li><a href="#">Celebrity news</a></li>
		<li><a href="#">Gossip</a></li>
		<li><a href="#">Movies</a></li>
		<li><a href="#">Music</a>
		<ul>
			<li><a href="#">Alternative</a></li>
			<li><a href="#">Country</a></li>
			<li><a href="#">Dance</a></li>
			<li><a href="#">Electronica</a></li>
			<li><a href="#">Metal</a></li>
			<li><a href="#">Pop</a></li>
			<li><a href="#">Rock</a>
				<ul>
					<li><a href="#">Bands</a>
						<ul>
							<li><a href="#">Dokken</a></li>
						</ul>
					</li>
					<li><a href="#">Fan Clubs</a></li>
					<li><a href="#">Songs</a></li>
				</ul>
			</li>
		</ul>
		</li>
		<li><a href="#">Slide shows</a></li>
		<li><a href="#">Red carpet</a></li>
	</ul>
	</li>
	<li><a href="#">Finance</a>
	<ul>
		<li><a href="#">Personal</a>
		<ul>
			<li><a href="#">Loans</a></li>
			<li><a href="#">Savings</a></li>
			<li><a href="#">Mortgage</a></li>
			<li><a href="#">Debt</a></li>
		</ul>
		</li>
		<li><a href="#">Business</a></li>
	</ul>
	</li>
	<li><a href="#">Food &#38; Cooking</a>
	<ul>
		<li><a href="#">Breakfast</a></li>
		<li><a href="#">Lunch</a></li>
		<li><a href="#">Dinner</a></li>
		<li><a href="#">Dessert</a>
			<ul>
				<li><a href="#">Dump Cake</a></li>
				<li><a href="#">Doritos</a></li>
				<li><a href="#">Both please.</a></li>
			</ul>
		</li>
	</ul>
	</li>
	<li><a href="#">Lifestyle</a></li>
	<li><a href="#">News</a></li>
	<li><a href="#">Politics</a></li>
	<li><a href="#">Sports</a>
		<ul>
			<li><a href="#">Baseball</a></li>
			<li><a href="#">Basketball</a></li>
			<li><a href="#">Swimming</a>
			<ul>
				<li><a href="#">High School</a></li>
				<li><a href="#">College</a></li>
				<li><a href="#">Professional</a>
				<ul>
					<li><a href="#">Mens Swimming</a>
					<ul>
							<li><a href="#">News</a></li>
							<li><a href="#">Events</a></li>
							<li><a href="#">Awards</a></li>
							<li><a href="#">Schedule</a></li>
							<li><a href="#">Team Members</a></li>
							<li><a href="#">Fan Site</a></li>
						</ul>
					</li>
					<li><a href="#">Womens Swimming</a>
					<ul>
						<li><a href="#">News</a></li>
						<li><a href="#">Events</a></li>
						<li><a href="#">Awards</a></li>
						<li><a href="#">Schedule</a></li>
						<li><a href="#">Team Members</a></li>
						<li><a href="#">Fan Site</a></li>
					</ul>
					</li>
				</ul>
				</li>
				<li><a href="#">Adult Recreational</a></li>
				<li><a href="#">Youth Recreational</a></li>
				<li><a href="#">Senior Recreational</a></li>
			</ul>
			</li>
			<li><a href="#">Tennis</a></li>
			<li><a href="#">Ice Skating</a></li>
			<li><a href="#">Javascript Programming</a></li>
			<li><a href="#">Running</a></li>
			<li><a href="#">Walking</a></li>
		</ul>
		</li>
	</ul>
</div>

</body>
</html>
