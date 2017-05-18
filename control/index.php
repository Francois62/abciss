<?php
	include('../php/connect.inc.php');

	mysqli_query("SET NAMES 'utf8'");
	
	$actus = array();
	$request = mysqli_query("SELECT * FROM actus ORDER BY actus_id DESC");
	while($val = mysqli_fetch_assoc($request)){
		$actus[] = array(intval($val['actus_id']), htmlspecialchars($val['actus_titre']), intval($val['actus_online']));
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
					<li><a href="./" class="sel">ACTUS</a></li>
					<li><a href="projets.php">PROJETS</a></li>
				</ul>
				<ul class="liste">
					<li><a href="creer-actu.php" class="bouton">Nouvelle actu</a></li>
					<li></li>
					<?php for($i=0;$i<count($actus);$i++){ ?> 
					<li>
						<p><?php echo $actus[$i][1]; ?></p>
						<a href="modifier-actu.php?i=<?php echo $actus[$i][0]; ?>" class="modifier">modifier</a>
						<a href="php/traitement-actu.php?s=<?php echo $actus[$i][0]; ?>" class="supprimer">supprimer</a>
						<?php if($actus[$i][2]){ ?><a href="php/traitement-actu.php?o=<?php echo $actus[$i][0]; ?>" class="online">V</a><?php }else{ ?><a href="php/traitement-actu.php?p=<?php echo $actus[$i][0]; ?>" class="offline">X</a><?php } ?>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</body>
</html>