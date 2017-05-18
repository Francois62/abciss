<?php
	include('../php/connect.inc.php');

	mysqli_query("SET NAMES 'utf8'");
	
	$cat = (!empty($_GET['i'])) ? intval($_GET['i']) : 0;
	
	$projets = array();
	
	$request = ($cat == 0) ? mysqli_query("SELECT * FROM projets ORDER BY projets_id DESC") : mysqli_query("SELECT * FROM projets INNER JOIN categories ON categories_id = projets_categorie WHERE categories_id = $cat ORDER BY projets_id DESC");

	while($val = mysqli_fetch_assoc($request)){
		$projets[] = array(intval($val['projets_id']), htmlspecialchars($val['projets_titre']), intval($val['projets_online']));
	}
	
	$liste = array(array(0,'TOUS'));
	$request = mysqli_query("SELECT * FROM categories WHERE categories_niveau = 1 ORDER BY categories_nom");
	while($val = mysqli_fetch_assoc($request)){
		$liste[] = array(intval($val['categories_id']),htmlspecialchars($val['categories_nom']));
	}
	mysqli_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="Description" content="" />
		<meta name="Keywords" content="" />
		<meta http-equiv="Content-Language" content="fr" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Abciss</title>
		<link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/fonctions.js"></script>
	</head>
	<body>
		<div id="trame">
			<div id="general">
				<h1><a href="./"><img src="../images/logo.png" alt="Abciss architectes" /></a></h1>
				<ul id="menu">
					<li><a href="./">ACTUS</a></li>
					<li><a href="projets.php" class="sel">PROJETS</a></li>
				</ul>
				<ul class="liste">
					<li><a href="creer-projet.php" class="bouton">Nouveau projet</a></li>
					<li></li>
					<li><select name="choix"><?php for($i=0;$i<count($liste);$i++){ if($liste[$i][0] == $cat){ echo '<option selected="selected" value="'.$liste[$i][0].'">'.$liste[$i][1].'</option>'; }else{ echo '<option value="'.$liste[$i][0].'">'.$liste[$i][1].'</option>';}} ?></select></li>
					<?php for($i=0;$i<count($projets);$i++){ ?> 
					<li>
						<p><?php echo $projets[$i][1]; ?></p>
						<a href="modifier-projet.php?i=<?php echo $projets[$i][0]; ?>" class="modifier">modifier</a>
						<a href="php/traitement-projet.php?i=<?php echo $cat; ?>&amp;s=<?php echo $projets[$i][0]; ?>" class="supprimer">supprimer</a>
						<?php if($projets[$i][2]){ ?><a href="php/traitement-projet.php?i=<?php echo $cat; ?>&amp;o=<?php echo $projets[$i][0]; ?>" class="online">V</a><?php }else{ ?><a href="php/traitement-projet.php?i=<?php echo $cat; ?>&amp;p=<?php echo $projets[$i][0]; ?>" class="offline">X</a><?php } ?>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</body>
</html>