<?php
	include('php/connect.inc.php');
	
	mysql_query("SET NAMES 'utf8'");
	
	if(!empty($_GET['i'])){
		$id = intval($_GET['i']);
	}else{
		header('Location:./');
	}
	
	$background = '';
	switch($id){
		case 3:
			$background = 'etudes-urbaines'; break;
		case 4:
			$background = 'amenagements-urbains'; break;
		case 5:	
			$background = 'education'; break;
		case 6:
			$background = 'medico-social'; break;
		case 7:
			$background = 'habitat'; break;
		case 8:
			$background = 'activite'; break;
		case 9:
			$background = 'culture'; break;
		case 10:
			$background = 'equipement'; break;
		case 11:
			$background = 'particulier'; break;
		case 13:
			$background = 'rehabilitation'; break;
	}
			
			
	$request = mysql_query("SELECT c1.categories_nom AS nom, c2.categories_nom AS parent FROM categories c1 INNER JOIN categories c2 ON c1.categories_parent = c2.categories_id WHERE c1.categories_id = $id");
	$val = mysql_fetch_assoc($request);
	$projet_nom = htmlspecialchars($val['nom']);
	$projet_parent = htmlspecialchars($val['parent']);
	
	$projets_id = array();
	$projets_nom = array();
	$projets_images = array();
	
	$request = mysql_query("SELECT * FROM projets INNER JOIN visuels_projet ON projets_id = visuels_projet_fk WHERE visuels_projet_classement = 0 AND projets_online = 1 AND projets_categorie = $id LIMIT 16");
	$nb_projets = mysql_num_rows($request);
	while($val = mysql_fetch_assoc($request)){
		$i = intval($val['projets_id']);
		$projets_id[] = $i;
		$projets_nom[$i] = htmlspecialchars($val['projets_titre']);
		$projets_images[$i] = htmlspecialchars($val['visuels_projet_nom']);
		if(!file_exists($val['visuels_projet_nom'])){
			$projets_images[$i] = 'images/no-projet.png';
		}
	}
	if($nb_projets<16){
		for($i=0;$i<(16-$nb_projets);$i++){
			$projets_id[] = 0;
		}
		$projets_nom[0] = '';
		$projets_images[0] = 'images/no-projet.png';
	}
	shuffle($projets_id);
	
	mysql_close();
?>
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
			<img src="images/background-<?php echo $background; ?>.jpg" alt="background" />
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
							<img class="vers_menu" src="images/vers-menu.png" alt="vers menu"><a class="sel vers_menu">MENU</a><span class="ligne1"></span><a class="vers_menu">PROJETS</a><span class="ligne2"></span><a class="vers_menu"><?php echo $projet_parent; ?></a><span class="ligne"></span><a href="projets.php?i=<?php echo $id; ?>" class="sel"><?php echo $projet_nom; ?></a>
						</div>
						<div id="conteneur">
							<p class="t19 orange">SELECTION</p>
							<h2><?php echo $projet_nom; ?></h2>
							<div id="projets">
								<?php for($i=0;$i<16;$i++){ if($projets_id[$i] != 0){ ?>
								<a href="projet.php?i=<?php echo $projets_id[$i]; ?>" class="projet">
									<img src="<?php echo $projets_images[$projets_id[$i]]; ?>" alt="<?php echo $projets_nom[$projets_id[$i]]; ?>" class="visuel" />
									<p><?php echo $projets_nom[$projets_id[$i]]; ?></p>
								</a>
								<?php }else{ ?>
								<div class="projet">
									<img src="<?php echo $projets_images[$projets_id[$i]]; ?>" alt="<?php echo $projets_nom[$projets_id[$i]]; ?>" class="visuel" />
								</div>
								<?php }} ?>
							</div>
						</div>
					</div>
				</div>
				<div class="pied"></div>
			</div>
		</div>
	</body>
</html>