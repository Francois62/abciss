<?php
	session_start();
	
	if(empty($_GET['i']))
		header('Location:projets.php');
	
	include('../php/connect.inc.php');

	mysql_query("SET NAMES 'utf8'");
	
	$id = intval($_GET['i']);
	$request = mysql_query("SELECT * FROM actus WHERE actus_id = $id");
	$val = mysql_fetch_assoc($request);
	$titre = htmlspecialchars($val['actus_titre']);
	$intro = htmlspecialchars($val['actus_sous_titre']);
	$date = ($val['actus_date'] != '') ? htmlspecialchars($val['actus_date']) : date('d/m/Y');
	$presentation = $val['actus_commentaire'];
	$online = intval($val['actus_online']);
	
	$images = array();
	$request = mysql_query("SELECT * FROM visuels_actu WHERE visuels_actu_fk = $id ORDER BY visuels_actu_classement");
	while($val = mysql_fetch_assoc($request)){
		$images[] = array(intval($val['visuels_actu_id']),htmlspecialchars($val['visuels_actu_min']));
	}
	$fond = (file_exists('../fond/a'.$id.'.jpg')) ? '../fond/a'.$id.'.jpg' : '' ;
	mysql_close();
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
		<link type="text/css" rel="stylesheet" href="css/redactor.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.ui.js"></script>
		<script type="text/javascript" src="js/redactor.min.js"></script>
		<script type="text/javascript" src="js/fonctions.js"></script>
	</head>
	<body>
		<div id="trame">
			<div id="general">
				<h1><a href="./"><img src="../images/logo.png" alt="Abciss architectes" /></a></h1>
				<ul id="menu">
					<li><a href="./" class="sel">ACTUS</a></li>
					<li><a href="projets.php" >PROJETS</a></li>
				</ul>
				<div id="formulaire-gauche">
					<form name="creer-actu" method="post" action="php/traitement-actu.php" enctype="multipart/form-data">
						<p><label for="titre" class="titre-form">Titre</label><br/><input type="text" class="long" id="titre" name="titre" value="<?php echo $titre; ?>"/></p>
						<p><label for="introduction" class="titre-form">Introduction</label><br/><textarea class="long" rows="2" cols="20" id="introduction" name="introduction"><?php echo $intro; ?></textarea></p>
						<p><label for="date" class="titre-form">Date</label><br/><input type="text" class="court" id="date" name="date" value="<?php echo $date; ?>"/></p>
						<p><label for="presentation" class="titre-form">Présentation</label><br/><textarea class="long" rows="10" cols="20" id="presentation" name="presentation"><?php echo $presentation; ?></textarea></p>
						<p><label for="fond" class="titre-form">Image de fond (.jpg, 1600*900)</label><br/><input type="file" name="background"  class="court" id="fond"/><?php if($fond != ''){ ?><br/><br/><label for="effacer_fond">Supprimer le fond</label> <input type="checkbox" name="effacer_fond" id="effacer_fond"/>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../fond/a<?php echo $id ?>.jpg?i=<?php echo rand(); ?>" target="_blank">Voir le fond</a><?php } ?></p>
						<p><span class="titre-form">En ligne</span><br/><label for="oui">Oui</label> <input type="radio" id="oui" name="online" value="1" <?php if($online){ ?>checked="checked"<?php } ?>/>&nbsp;&nbsp;&nbsp;&nbsp;<label for="non">Non</label> <input type="radio" id="non" name="online" value="0" <?php if(!$online){ ?>checked="checked"<?php } ?>/></p>
						<p class="bouton-formulaire"><a href="./" class="bouton">Retour</a></p>
						<p><input type="submit" class="bouton" value="Valider"/></p>
						<div class="pied"></div>
						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
					</form>
				</div>
				<div id="formulaire-droit">
					<div id="ajout_image">
						<p class="titre-form">Liste des visuels</p>
						<p id="gestion_image">Ajouter une image</p>
						<p id="gestion_vimeo">Ajouter une video</p>
						<form target="hiddeniframe" action="php/upload-actu.php" name="upload" method="post" enctype="multipart/form-data">
							Sélectionnez votre image (.jpg, 489*275)<br/>
							<input type="file" name="image"/><br/><br/>
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<input type="hidden" name="type" value="1" />
							<input type="submit"  class="bouton" value="Enregistrer" />
						</form>
						<form target="hiddeniframe" action="php/upload-actu.php" name="vimeo" method="post" enctype="multipart/form-data">
							Inscrivez le numéro Vimeo<br/>
							<input type="text" name="vimeo"/><br/><br/>
							Sélectionnez votre image (.jpg, 35*35)<br/>
							<input type="file" name="miniature"/><br/><br/>
							<input type="hidden" name="id" value=<?php echo $id; ?>" />
							<input type="submit"  class="bouton" value="Enregistrer" />
						</form>
					</div>
					<div id="liste_images">
					<?php for($i=0; $i<count($images); $i++){ ?>
						<div class="visuel" id="img_<?php echo $images[$i][0]; ?>">
							<img src="../<?php echo $images[$i][1]; ?>" />
							<img id="<?php echo $images[$i][0]; ?>" src="../images/supprimer.gif" alt="supprimer" title="supprimer" class="supp" />
						</div>
					<?php } ?>
					</div>
					<iframe name="hiddeniframe" src="about:blank" style="width:0px;height:0px;border:0px;"></iframe>
					<div id="loading">Chargement</div>
				</div>
				<div class="pied"></div>
			</div>
		</div>
	</body>
</html>