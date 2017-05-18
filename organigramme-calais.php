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
			<img src="images/background-organigramme.jpg" alt="background" />
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
							<img class="vers_menu" src="images/vers-menu.png" alt="vers menu" /><a class="sel vers_menu">MENU</a><span class="ligne1"></span><a class="vers_menu">AGENCE</a><span class="ligne2"></span><a class="vers_menu">L'EQUIPE</a><span class="ligne"></span><a href="organigramme-calais.php" class="sel">ORGANIGRAMME</a>
						</div>
						<div id="conteneur">
							<div id="organigramme">
								<p class="t19 orange">AGENCE DE</p>
								<h2 class="orga"><a href="organigramme-dunkerque.php">DUNKERQUE</a></h2>
								<h2 class="orga sel"><a href="organigramme-calais.php">CALAIS</a><br/><div class="montrer"></div></h2>
								<div id="ligne1">
									<img src="images/vers-droite.png" alt=">"/>
									<p><span class="orange t16">Hubert WACHEUX</span><br/>Architecte (urbaniste) DESA - Gérant</p>
								</div>
								<div id="ligne2">
									<img src="images/vers-droite.png" alt=">"/>
									<p><span class="orange t16">Julien PICHON</span><br/>Architecte (urbaniste) DPLG<br/>Directeur de l'agence de Calais</p>
									<p><span class="orange t16">Sylvain LAMARE</span><br/>Ingénieur / Chef de projet<br/>Directeur-adjoint de l'agence de Calais</p>
									<p><span class="orange t16">Sabine WACHEUX</span><br/>Comptabilité / Gestion<br/>&nbsp;</p>
								</div>
								<div id="ligne3">
									<img src="images/vers-droite.png" alt=">"/>
									<p><span class="orange t16">Juliette POLY</span><br/>Architecte DESLT</p>
									<p><span class="orange t16">Josephine DEL MEDICO</span><br/>Architecte DE</p>
									<p><span class="orange t16">Thierry BOMBLE</span><br/>Dessinateur projeteur</p>
								</div>
								<div id="ligne4">
									<img src="images/vers-droite.png" alt=">"/>
									<p><span class="orange t16">Valérie LEGENTIL</span><br/>Assistante de direction</p>
									<p><span class="orange t16">François FOURNIER</span><br/>Conducteur de travaux</p>
									<p><span class="orange t16">Cyril ROSE</span><br/>Thermicien</p>
								</div>
								<div id="photo">
									<h2 class="orange">2 AGENCES</h2>
									<h2>1 EQUIPE</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="pied"></div>
			</div>
		</div>
	</body>
</html>