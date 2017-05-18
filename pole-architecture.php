<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Abciss</title>
		<meta name="description" content=""/>
		<meta name="viewport" content="width=device-width, initial-scale=0.6">
		<meta http-equiv="Content-Language" content="fr" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin' rel='stylesheet' type='text/css' />
		<link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/fonction.js"></script>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-34965000-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
	</head>
	<body>
		<div id="background">
			<img src="images/background-archi.jpg" alt="background" />
		</div>
		<div id="trame"></div>
		<div id="focus">
			<div id="general">
				<div id="menu">
					<div class="centre">
						<h1><a href="./"><img src="images/logo.png" alt="abciss architectes" /></a></h1>
						<?php include('php/menu.php'); ?>
					</div>
				</div>
				<div id="principal">
					<div class="centre">
						<h1><a href="./"><img src="images/logo.png" alt="abciss architectes" /></a></h1>
						<div id="ariane">
							<img class="vers_menu" src="images/vers-menu.png" alt="vers menu" /><a class="sel vers_menu">MENU</a><span class="ligne"></span><a href="pole-architecture.php" class="sel">L'ESPRIT</a>
						</div>
						<div id="conteneur">
							<div id="esprit_gauche">
								<a href="l-agence.php" >L'AGENCE <img src="images/fleche-bas.png" alt=">"/></a>
								<a href="pole-urbanisme.php">PÔLE URBANISME <img src="images/fleche-bas.png" alt=">"/></a>
								<a href="pole-architecture.php" class="orange"><img src="images/vers-droite.png" alt=">"/> PÔLE ARCHITECTURE</a>
								<h3>La démarche de conception architecturale de l’agence est avant tout pragmatique.</h3>
								<p>La forme, l’écriture architecturale, pour ABCISS-Architectes, n’est pas un but en soit mais la résultante intrinsèque à la question posée par le programme, le contexte, l’environnement et l’usage. Ainsi l’expression architecturale, « l’écriture » varie d’un projet à l’autre. Cette grande variabilité d’expression fait que l’on ne peut pas identifier de « style ABCISS », chaque projet étant unique et particulier. Unique, car nous mettons l’humain ainsi qu’une fonctionnalité assimilée et intégrée comme axes majeurs de conception de nos projets ; notre but étant de créer des espaces agréables à vivre tout en étant optimisés, modulaires et adaptés à toute évolution dans le temps. Notre approche privilégie par ailleurs, une conception architecturale bioclimatique afin de répondre aux enjeux environnementaux de la manière la plus naturelle et la plus optimisée qui soit. Afin d’optimiser notre conception « climatique » dès le premier coup de crayon, nous avons intégré à notre équipe un thermicien prenant part à l’élaboration de tous nos projets.</p>
							</div>
							<div id="esprit_droite">
								<img src="images/visuel-architecture.png" alt="pôle architecture"/>
							</div>
							<div class="pied"></div>
						</div>
					</div>
				</div>
				<div class="pied"></div>
			</div>
		</div>
	</body>
</html>