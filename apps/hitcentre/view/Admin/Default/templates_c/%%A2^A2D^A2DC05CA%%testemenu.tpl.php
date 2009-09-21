<?php /* Smarty version 2.6.23, created on 2009-06-14 05:32:58
         compiled from testemenu.tpl */ ?>
<html>
<head>
<title>Menu</title>
<script type="text/javascript" src="View/scriptaculo/jquery.js"></script>
<a base="http://localhost/myFramework/" />

<style type="text/css" media="all">
<!--

body {
	background-color:#222;
}
#topo_menu {
	position:relative;
	margin:0 auto;
	width:800px;
	height:100px;
	background-color:#CD0000;
	border:2px solid #B5B5B5;
}

#topo_menu ul.menu-drop-down {

}

/* SlideShow CSS */

#slideShow #slidesContainer {
	position:relative;
	margin:0 auto;
	width:560px;
	height:263px;
	overflow:auto;
	border:1px solid #666;

}

#slideShow #slidesContainer .slide {
	margin:0 auto;
	width:540px;
	height:263px;
}

/* Slide Show Control */
.control {
	display:block;
	width:39px;
	height:263px;
	text-indent:-10000px;
	position:absolute;
	cursor:pointer;
}

#leftControl {
	top:0;
	left:0;
	background:transparent url(img/control_left.jpg) no-repeat 0 0;
	background-color:white;
}

#rightControl {
	top:0;
	right:0;
	background:transparent url(img/control)right.jpg) no-repeat 0 0;
}

-->
</style>
<script type="text/javascript">
<!--
	$(document).ready(function() {
		$("#topo_menu").hide();

		/*
		Evento de abrir o menu com o clique
		*/
		$("#menuButton").click(function() {
			if(($("#topo_menu").is(":hidden"))==true)
			{
				$("#topo_menu").slideDown("slow");
			} else {
				$("#topo_menu").slideUp("slow");
			}

		});

		$("#topo_menu").find("ul:eq(0)>li>a").click(function() {
			$(this).parent().find('ul:eq(0)').slideToggle("slow");
		});

		/* SlideShow */
		var currentPosition = 0;
		var slideWidth = 560;
		var slides = $('.slide');
		var numberOfSlides = slides.length;


		// Remove Scrollbar
		$("#slidesContainer").css("overflow","hidden");

		// Envolve todas as .slides box com #slideInner
		slides.wrapAll('<div id="slideInner" name="slideInner"></div>')

		// Float left to display horizontally
		.css({
			'float' : 'left',
			'width' : slideWidth
			});

		// Insert left and right arrow controls in the Dom
		$('#slideShow').prepend('<span class="control" id="leftControl" name="leftControl">Move Left</span>')
		.append('<span class="control" id="rightControl">Move Right</span>');

		manageControls(currentPosition);

		// Manipulas os cliques em .controls
		$('.control').bind('click',function() {
			//Determina a nova posição
			currentPosition = ($(this).attr('id')=='rightControl')
			? currentPosition+1 : currentPosition-1;

			// Hide / Show Controls
			manageControls(currentPosition);
			// Move slideInner using margin-left
			$('#slideInner').animate({
				'marginLeft' : slideWidth*(-currentPosition)
			});


		});

		// Function manageControls -> hide/show controls depending on currentPosition
			function manageControls(position)
			{
				// Hide left arrow if position is first slide
				if(position == 0) {
					$('#leftControl').hide();
				} else {
					$('#leftControl').show();
				}
				// Hide right arrow if position is last slide
				if(position==numberOfSlides-1)
				{
					$('#rightControl').hide();
				} else {
					$('#rightControl').show();
				}
			}



	});





-->
</script>
</head>

<body>


<div id="main" name="main">
	<div id="topo_menu" name="topo_menu">

	<ul class="menu-drop-down">
		<li class="menu"><a href="#">Home</a></li>
		<li class="menu"><a href="#">Financeiro</a>
		<ul class="submenu">
			<li class="item"><a href="#">Cadastros</a></li>
			<li class="item"><a href="#">Buscas</a></li>
			<li class="item"><a href="#">Empresa</a></li>
		</ul>
	</ul>
	</div>
	<center><a href="#" name="menuButton" id="menuButton">Abrir</a></center>
</div>

<div id="slideShow" name="slideShow">
	<div id="slidesContainer" name="slidesContainer">
		<div class="slide" name="slide">
			<center><h2>Slide 1</h2></center>
		</div>
		<div class="slide">
			<center><h2>Slide 2</h2></center>
		</div>
		<div class="slide">
			<center><h2>Slide 3</h2:</center>
		</div>
		<div class="slide">
			<center><h2>Slide 4</h2></center>
		</div>
	</div>

</div>
</body>
</html>