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
			<img src="images/background-metier2.jpg" alt="background" />
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
							<img class="vers_menu" src="images/vers-menu.png" alt="vers menu" /><a class="sel vers_menu">MENU</a><span class="ligne1"></span><a class="vers_menu">AGENCE</a><span class="ligne2"></span><a class="vers_menu">L'EQUIPE</a><span class="ligne"></span><a href="architectes.php" class="sel">LES METIERS</a>
						</div>
						<div id="conteneur">
							<div id="metier_gauche">
								<h2>UNE EQUIPE<br/>PLURIDISCIPLINAIRE<br/>SOLIDAIRE</h2>
								<a href="organigramme-dunkerque.php" id="voir_orga">
									<span class="ouvrir"></span><br/>
									<img src="images/orga.png" alt="voir organigramme" /><br/>
									<span class="t14">VOIR<br/>L'ORGANIGRAMME</span>
								</a>
							</div>
							<div id="metier_droite">
								<div class="picto">
									<a href="architectes.php" id="architecte" class="sel"></a>
									<a href="metreurs.php" id="metreur" class="visu"></a>
									<a href="secretaires.php" id="secretaire" class="visu"></a>
									<a href="environnement.php" id="environnement" class="visu"></a>
									<a href="dessinateurs.php" id="dessinateur" class="visu"></a>
									<a href="techniciens.php" id="technicien" class="visu"></a>
									<a href="comptables.php" id="comptable" class="visu"></a>
								</div>
								<div class="fleche"><img src="images/vers-droite.png" alt=">"/></div>
								<div class="texte">
									<h3>DES ARCHITECTES</h3>
									<p>Notre équipe intègre plusieurs architectes issus de formations différentes (DESA, DPLG, DE/HMONP, DESLT…). Véritables « chefs de projet », ils vous suivent de la conception jusqu'à la réception du bâtiment. Ils sont vos interlocuteurs privilégiés et répondent à l’ensemble des questions que vous pourriez vous poser.</p>
								</div>
								<div class="pied"></div>
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