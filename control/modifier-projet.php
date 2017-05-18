<?php
	session_start();
	
	if(empty($_GET['i']))
		header('Location:projets.php');
	
	include('../php/connect.inc.php');

	mysql_query("SET NAMES 'utf8'");
	
	$id = intval($_GET['i']);
	$request = mysql_query("SELECT * FROM projets WHERE projets_id = $id");
	$val = mysql_fetch_assoc($request);
	$titre = htmlspecialchars($val['projets_titre']);
	$intro = htmlspecialchars($val['projets_intro']);
	$date = ($val['projets_date'] != '') ? htmlspecialchars($val['projets_date']) : date('d/m/Y');
	$lieu = htmlspecialchars($val['projets_lieu']);
	$status = htmlspecialchars($val['projets_status']);
	$surface = htmlspecialchars($val['projets_surface']);
	$cout = htmlspecialchars($val['projets_cout']);
	$presentation = $val['projets_presentation'];
	$categorie = intval($val['projets_categorie']);
	$selection = intval($val['projets_selection']);
	$online = intval($val['projets_online']);
	$tab_categorie = array();
	$request = mysql_query("SELECT * FROM categories ORDER BY categories_parent,categories_nom");
	while($val = mysql_fetch_assoc($request)){
		if($val['categories_parent']==0){
			$tab_categorie[$val['categories_id']] = array('nom'=>htmlspecialchars($val['categories_nom']));
		}else{
			$tab_categorie[$val['categories_parent']][$val['categories_id']] = htmlspecialchars($val['categories_nom']);
		}
	}
	
	$images = array();
	$request = mysql_query("SELECT * FROM visuels_projet WHERE visuels_projet_fk = $id ORDER BY visuels_projet_classement");
	
	while($val = mysql_fetch_assoc($request)){
		$images[] = array(intval($val['visuels_projet_id']),htmlspecialchars($val['visuels_projet_min']));
	}
	
	$pdf = (file_exists('../pdf/'.$id.'.pdf')) ? '../pdf/'.$id.'.pdf' : '' ;
	$fond = (file_exists('../fond/'.$id.'.jpg')) ? '../fond/'.$id.'.jpg' : '' ;
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
					<li><a href="./">ACTUS</a></li>
					<li><a href="projets.php" class="sel">PROJETS</a></li>
				</ul>
				<div id="formulaire-gauche">
					<form name="creer-projet" method="post" action="php/traitement-projet.php" enctype="multipart/form-data">
						<p><label for="titre" class="titre-form">Titre</label><br/><input type="text" class="long" id="titre" name="titre" value="<?php echo $titre; ?>"/></p>
						<p><label for="introduction" class="titre-form">Introduction</label><br/><textarea class="long" rows="2" cols="20" id="introduction" name="introduction"><?php echo $intro; ?></textarea></p>
						<p><label for="date" class="titre-form">Date</label><br/><input type="text" class="court" id="date" name="date" value="<?php echo $date; ?>"/></p>
						<div class="colonne">		
							<p><label for="lieu" class="titre-form">Lieu</label><br/><input type="text" class="court" id="lieu" name="lieu" value="<?php echo $lieu; ?>"/></p>						
							<p><label for="status" class="titre-form">Statut</label><br/><input type="text" class="court" id="status" name="status" value="<?php echo $status; ?>"/></p>
							<div class="pied"></div>
						</div>
						<div class="pied"></div>
						<div class="colonne">
							<p><label for="surface" class="titre-form">Surface</label><br/><input type="text" class="court" id="surface" name="surface" value="<?php echo $surface; ?>"/></p>			
							<p><label for="cout" class="titre-form">Coût</label><br/><input type="text" class="court" id="cout" name="cout" value="<?php echo $cout; ?>"/></p>
							<div class="pied"></div>
						</div>
						<p><label for="presentation" class="titre-form">Présentation</label><br/><textarea class="long" rows="10" cols="20" id="presentation" name="presentation"><?php echo $presentation; ?></textarea></p>
						<p><label for="categorie" class="titre-form">Catégorie</label><br/><select class="court" id="categorie" name="categorie"><?php foreach($tab_categorie as $value){ ?><optgroup label="<?php echo $value['nom']; ?>"><?php foreach($value as $key => $nom){ if($key != 'nom'){?><option value="<?php echo $key; ?>" <?php if($key == $categorie){ ?>selected="selected"<?php } ?>><?php echo $nom; ?></option><?php }} ?></optgroup><?php } ?></select></p>
						<p><span class="titre-form">Séléction</span><br/><label for="oui2">Oui</label> <input type="radio" id="oui2" name="selection" value="1"  <?php if($selection){ ?>checked="checked"<?php } ?>/>&nbsp;&nbsp;&nbsp;&nbsp;<label for="non2">Non</label> <input type="radio" id="non2" name="selection" value="0"  <?php if(!$selection){ ?>checked="checked"<?php } ?>/></p>
						<p><label for="fond" class="titre-form">Image de fond (.jpg, 1600*900)</label><br/><input type="file" name="background"  class="court" id="fond"/><?php if($fond != ''){ ?><br/><br/><label for="effacer_fond">Supprimer le fond</label> <input type="checkbox" name="effacer_fond" id="effacer_fond"/>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../fond/<?php echo $id ?>.jpg?i=<?php echo rand(); ?>" target="_blank">Voir le fond</a><?php } ?></p>
						<p><label for="pdf" class="titre-form">Pdf</label><br/><input type="file" class="court" name="pdf" id="pdf"/><?php if($pdf != ''){ ?><br/><br/><label for="effacer_pdf">Supprimer le pdf</label> <input type="checkbox" name="effacer_pdf" id="effacer_pdf"/>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../pdf/<?php echo $id ?>.pdf?i=<?php echo rand(); ?>" target="_blank">Voir le pdf</a><?php } ?></p>
						<p><span class="titre-form">En ligne</span><br/><label for="oui">Oui</label> <input type="radio" id="oui" name="online" value="1" <?php if($online){ ?>checked="checked"<?php } ?>/>&nbsp;&nbsp;&nbsp;&nbsp;<label for="non">Non</label> <input type="radio" id="non" name="online" value="0" <?php if(!$online){ ?>checked="checked"<?php } ?>/></p>
						<p class="bouton-formulaire"><a href="projets.php" class="bouton">Retour</a></p>
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
						<form target="hiddeniframe" action="php/upload-projet.php" name="upload" method="post" enctype="multipart/form-data">
							Sélectionnez votre image (.jpg, 1050*566)<br/>
							<input type="file" name="image"/><br/><br/>
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<input type="hidden" name="type" value="0" />
							<input type="submit"  class="bouton" value="Enregistrer" />
						</form>
						<form target="hiddeniframe" action="php/upload-projet.php" name="vimeo" method="post" enctype="multipart/form-data">
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