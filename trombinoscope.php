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
		<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
		<script type="text/javascript" src="js/fonction.js"></script>
		<script type="text/javascript">
			$(function(){
				trombi();
			});
		</script>
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
			<img src="images/background-trombinoscope.jpg" alt="background" />
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
							<img class="vers_menu" src="images/vers-menu.png" alt="vers menu" /><a class="sel vers_menu">MENU</a><span class="ligne1"></span><a class="vers_menu">AGENCE</a><span class="ligne2"></span><a class="vers_menu">L'EQUIPE</a><span class="ligne"></span><a href="trombinoscope.php" class="sel">TROMBINOSCOPE</a>
						</div>
						<div id="trombinoscope">
							<table>
								<tr>
									<td></td>
									<td><a name="cyril-rose" class="info"><img src="trombi/cyril-rose.jpg" alt="Cyril Rose"/><div class="info_gauche"><div class="gauche"><h4>Cyril<br/>ROSE</h4><p>Thermicien</p></div><div class="droite"></div></div></a></td>
									<td><a name="hubert-wacheux" class="info"><img src="trombi/hubert-wacheux.jpg" alt="Hubert Wacheux"/><div class="info_droite"><div class="gauche"></div><div class="droite"><h4>Hubert<br/>WACHEUX</h4><p>Architecte (urbaniste)<br/>DESA - Gérant</p></div></div></a></td>
									<td></td>
									<td><a class="info" name="lucille-delmarre"><img src="trombi/lucille-delmarre.jpg" alt="Lucille Delmarre"/><div class="info_bas"><div class="gauche"></div><div class="droite"><h4>Lucille<br/>DELMARRE</h4><p>Architecte (urbaniste) DE / HMONP<br/>Directrice-adjointe de l'agence de Dunkerque</p></div></div></a></td>
									<td></td>
									<td><a class="info" name="juliette-poly"><img src="trombi/juliette-poly.jpg" alt="Juliette Poly"/><div class="info_gauche"><div class="gauche"><h4>Juliette<br/>POLY</h4><p>Architecte DESLT</p></div><div class="droite"></div></div></a></td>
									<td><a name="vincent-vermersch" class="info"><img src="trombi/vincent-vermersch.jpg" alt="Vincent Vermersh"/><div class="info_bas"><div class="gauche"></div><div class="droite"><h4>Vincent<br/>VERMERSH</h4><p>Ingénieur travaux / Directeur de la production<br/>Directeur de l'agence de Dunkerque</p></div></div></a></td>
								</tr>
								<tr>
									<td><a class="info" name="sylvain-lamare"><img src="trombi/sylvain-lamare.jpg" alt="Sylvain Lamare"/><div class="info_droite"><div class="gauche"></div><div class="droite"><h4>Sylvain<br/>LAMARE</h4><p>Ingénieur / Chef de projet<br/>Directeur-adjoint de l'agence de Calais</p></div></div></a></td>
									<td></td>
									<td><a class="info" name="celine-delbende"><img src="trombi/celine-delbende.jpg" alt="Céline Delbende"/><div class="info_bas"><div class="gauche"></div><div class="droite"><h4>Céline<br/>DELBENDE</h4><p>Urbaniste - Sociologue</p></div></div></a></td>
									<td><a class="info" name="francois-fournier"><img src="trombi/francois-fournier.jpg" alt="François Fournier"/><div class="info_droite"><div class="gauche"></div><div class="droite"><h4>François<br/>FOURNIER</h4><p>Conducteur de travaux</p></div></div></a></td>
									<td></td>
									<td><a class="info" name="dominique-volpoet"><img src="trombi/dominique-volpoet.jpg" alt="Dominique Volpoet"/><div class="info_bas"><div class="gauche"></div><div class="droite"><h4>Dominique<br/>VOLPOET</h4><p>Métreur</p></div></div></a></td>
									<td><a name="julien-pichon" class="info"><img src="trombi/julien-pichon.jpg" alt="Julien Pichon"/><div class="info_droite"><div class="gauche"></div><div class="droite"><h4>Julien<br/>PICHON</h4><p>Architecte (urbaniste) DPLG<br/>Chef de l'Agence de Calais</p></div></div></a></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td><a class="info" name="jocelyne-steiner"><img src="trombi/jocelyne-steiner.jpg" alt="Jocelyne Steiner"/><div class="info_gauche"><div class="gauche"><h4>Jocelyne<br/>STEINER</h4><p>Dessinateur Projeteur</p></div><div class="droite"></div></div></a></td>
									<td></td>
									<td><a name="josephine-del-medico" class="info"><img src="trombi/josephine-del-medico.jpg" alt="Josephine Del Médico"/><div class="info_bas"><div class="gauche"></div><div class="droite"><h4>Josephine<br/>DEL MEDICO</h4><p>Architecte DE</p></div></div></a></td>
									<td><a class="info" name="thierry-bomble"><img src="trombi/thierry-bomble.jpg" alt="Thierry Bomble"/><div class="info_bas"><div class="gauche"></div><div class="droite"><h4>Thierry<br/>BOMBLE</h4><p>Dessinateur Projeteur</p></div></div></a></td>
									<td></td>
									<td><a class="info" name="valerie-legentil"><img src="trombi/valerie-legentil.jpg" alt="Valérie Legentil"/><div class="info_droite"><div class="gauche"></div><div class="droite"><h4>Valérie<br/>LEGENTIL</h4><p>Assistante de direction</p></div></div></a></td>
									<td></td>
								</tr>
								<tr>
									<td><a class="info" name="willy-jonckere"><img src="trombi/willy-jonckere.jpg" alt="Willy Jonckere"/><div class="info_haut"><div class="gauche"><h4>Willy<br/>JONCKERE</h4><p>Conducteur de travaux</p></div><div class="droite"></div></div></a></td>
									<td><a class="info" name="sabine-wacheux"><img src="trombi/sabine-wacheux.jpg" alt="Sabine Wacheux"/><div class="info_droite"><div class="gauche"></div><div class="droite"><h4>Sabine<br/>WACHEUX</h4><p>Comptabilité / Gestion</p></div></div></a></td>
									<td></td>
									<td></td>
									<td></td>
									<td><a class="info" name="francois-rusconi"><img src="trombi/francois-rusconi.jpg" alt="François Rusconi"/><div class="info_droite"><div class="gauche"></div><div class="droite"><h4>François<br/>RUSCONI</h4><p>Economiste de la Construction</p></div></div></a></td>
									<td></td>
									<td><a class="info" name="morgane-gueguinou"><img src="trombi/morgane-gueguinou.jpg" alt="Morgane Gueguinou"/><div class="info_haut"><div class="gauche"><h4>Morgane<br/>GUEGUINOU</h4><p>Assistance de direction</p></div><div class="droite"></div></div></a></td>
								</tr>
							</table>
							<div id="zoom">
								<div><img id="image1" src="trombi/zoom1-celine-delbende.jpg"/><img id="image2" src="trombi/zoom2-celine-delbende.jpg"/><img id="image3" src="trombi/zoom3-celine-delbende.jpg"/></div>
								<h3 class="blanc">JOSEPHINE DEL MEDICO</h3>
								<p class="orange t21">Architecte DESLT</p>
								<a id="fermer">FERMER</a>
							</div>
						</div>
					</div>
				</div>
				<div class="pied"></div>
			</div>
		</div>
	</body>
</html>