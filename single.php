
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Cadaver Exquisito </title>
	<meta name="description" content="Un recorrido visual por los lugares más icónicos de la ciudad de México desde el punto de vista de todos los capitalinos."/>
	<meta name="keywords" content=" Cadaver Exquisito, cultura, twitter, Museo Soumaya, Aldea Digital, CTIN, Interactividad" />
	<meta name="author" content="http://ctinmx.com" />


	<!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Ligas de Estilos -->
	<link rel="stylesheet" type="text/css" href="css/main.css" />

	<!-- Iconos -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Metadata for Facebook -->
		<meta property="og:title" content="Cadáver Exquisito - Un recorrido visual por los lugares más icónicos de la ciudad de México desde el punto de vista de todos los capitalinos." />
	    <meta property="og:site_name" content="Cadáver Exquisito" />
	    <meta property="og:url" content="http://cadaveraldea.com" />
	    <meta property="og:description" content="El Museo Soumaya y Aldea Digital te invitan a formar parte del de esta actividad cultural en linea, comparte tus historias y vivencias en la Ciudad de México con ayuda del hasta #MiAldea." />
	    <meta property="og:type" content="article" />
	    <meta property="og:locale:alternate" content="es_ES" />
	    <meta property="article:author" content="http://batit.co" />
	    <meta property="article:publisher" content="http://cadaveraldea.com" />
	     <meta property="og:image" content="http://cadaveraldea.com/img/fb.png" />
	
	
		<!-- Metadata for Twitter -->
		<meta name="twitter:card" content="Cadáver Exquisito">
		<meta name="twitter:site" content="@CadaverAldea">
		<meta name="twitter:creator" content="@hola_miguelo">
		<meta name="twitter:title" content="Un recorrido visual por los lugares más icónicos de la ciudad de México desde el punto de vista de todos los capitalinos.">
		<meta name="twitter:description" content="El Museo Sumaya y Aldea Digital te invitan a formar parte del de esta actividad cultural en linea, comparte tus historias y vivencias en la Ciudad de México con ayuda del hasta #MiAldea.">
		<meta name="twitter:image" content="http://cadaveraldea.com/img/fb.png">

</head>
<body >
	<div class="container" style="margin: 0; padding: 0; width:100%;">


		<!-- HEADER -->
		<header class="codrops-header row-fluid">
			<div class="col-xs-6 text-left list-inline">
				<!-- Logo Menudesplegable -->
				<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="img/Menu.svg"></a>

		          <ul class="dropdown-menu" role="menu">
		            <li><a href="carousel.html">Explora</a></li>
		            <li><a href="form.html">Particia</a></li>
		            <li><a href="search.html">Encuentra</a></li>
		            </li><li><a href="info.html">Conoce más</a></li>
		            </li><li><a href="faq.html">Preguntas Frecuentes</a></li>
		          </ul>
		        </li>
				
				<!-- Logo Cadaver -->
				<li>
					<a href="index.html"><img src="img/LogoHome.svg" class="logo"   alt="logo"></a>
				</li>
			</div>
			<div id="logos" class="col-xs-6 text-right list-inline">
				<!-- Logo Aldea -->
				<li>
					<a href="http://www.aldeadigitalmx.com"><img src="img/LogoAldea.svg" class="logo"   alt="logo"></a>
				</li>

				<!-- Logo Soumaya -->
				<li>
					<a href="http://www.soumaya.com.mx/index.php/esp"><img src="img/LogoSoumaya.svg" class="logo"   alt="logo"></a>
				</li>

				<!-- Logo Ctin -->
				<a href="http://ctinmx.com"><img src="img/LogoCtin.svg" class="logo" alt="logo"></a>	
				
				
			</div>
		</header>

		<div class="col-xm-12 text-center oneItem">
			 Cargando ...
		</div>	
		
	</div>
	<!-- /container -->


	<!-- Bootstrap Core JavaScript -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="app/dependencies/mustache.min.js"></script>
    
</body>
</html>
<?php 
echo "<script type='text/javascript' src='app/init.js'></script>
<script>
	window.onload = function(){
		var images = new Load();
		images.getSingle(" . $_GET['cadaver'] . ")
	}
</script>"
?>