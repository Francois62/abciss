<?php
	session_start();

	function random($car) {
		$string = "";
		$chaine = "ABCDEFGHJKLMNPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		for($i=0; $i<$car; $i++) {
			$string .= $chaine[rand()%strlen($chaine)];
		}
		return $string;
	}
	
	function recrop($tmp,$destination_image,$destination_redim,$destination_recrop,$taillemax, $longueur_crop, $hauteur_crop){
		$infos_img = getimagesize($tmp);
		$longueur = $infos_img[0];
		$hauteur = $infos_img[1];
		
		if ($hauteur < $taillemax && $longueur < $taillemax){
			if (move_uploaded_file($tmp, $destination_redim)){
				centre_image_auto($destination_redim,$destination_recrop,$longueur_crop,$hauteur_crop);
				return true;
			}else{
				return false;
			}
		} else {
			if (move_uploaded_file($tmp, $destination_image)){
				if($longueur > $hauteur){
					$nouvelle_hauteur = $hauteur*($taillemax/$longueur);
					$source = imagecreatefromjpeg($destination_image); 
					$redim = imagecreatetruecolor($taillemax,$nouvelle_hauteur);
					imagecopyresampled($redim, $source, 0, 0, 0, 0, $taillemax, $nouvelle_hauteur, $longueur, $hauteur);
				} else {
					$nouvelle_longueur = $longueur*($taillemax/$hauteur);
					$source = imagecreatefromjpeg($destination_image); 
					$redim = imagecreatetruecolor($nouvelle_longueur,$taillemax);
					imagecopyresampled($redim, $source, 0, 0, 0, 0, $nouvelle_longueur, $taillemax, $longueur, $hauteur);
				}
				imagejpeg($redim,$destination_redim,75);
				centre_image_auto($destination_image,$destination_recrop,$longueur_crop,$hauteur_crop);
				unlink($destination_image);
				return true;
			}else{
				return false;
			}
		}
	}
	
	function centre_image_auto($tmp, $destination_recrop, $longueur_crop, $hauteur_crop){
		$infos_img = getimagesize($tmp);
		$longueur = $infos_img[0];
		$hauteur = $infos_img[1];
		$source = imagecreatefromjpeg($tmp); 
		$recrop = imagecreatetruecolor($longueur_crop, $hauteur_crop);
		if ($longueur > $hauteur && ($longueur/$hauteur > $longueur_crop/$hauteur_crop)){
			$x = ($longueur-(($hauteur * $longueur_crop)/$hauteur_crop)) / 2;
			$ratio = $hauteur_crop/$hauteur;
			imagecopyresampled($recrop, $source, 0, 0, $x, 0, $longueur*$ratio, $hauteur_crop, $longueur, $hauteur);
		} else {
			$y = ($hauteur-(($longueur * $hauteur_crop)/$longueur_crop)) / 2;
			$ratio = $longueur_crop/$longueur;
			imagecopyresampled($recrop, $source, 0, 0, 0, $y, $longueur_crop, $hauteur*$ratio, $longueur, $hauteur);
		}
		imagejpeg($recrop,$destination_recrop,75);
	}
	
	$nom = random(9);
	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && isset($_POST['id'])){
		$id = intval($_POST['id']);
		if($_FILES['image']['size'] <= 20000000){
			$infosfichier = pathinfo($_FILES['image']['name']);
			$extension_upload = $infosfichier['extension'];
			$extensions_autorisees = array('jpg', 'jpeg', 'JPG', 'JPEG');
			if(in_array($extension_upload, $extensions_autorisees)){
				if($id == 0){
					if(recrop($_FILES['image']['tmp_name'],'../tmp/'.$nom.'-temp.jpg','../tmp/'.$nom.'.jpg','../tmp/'.$nom.'-min.jpg',489, 35, 35)){
						$_SESSION['images'][] = $nom;
						$_SESSION['vimeo'][] = 0;
						echo '<script type="text/javascript">window.parent.updateFrame();</script>';
					}
				}else{
					include('../../php/connect.inc.php');
					mysql_query("SET NAMES UTF8");
					$request = mysql_query("SELECT MAX(visuels_actu_id) AS max FROM visuels_actu");
					$val = mysql_fetch_assoc($request);
					$max = $val['max']+1;
					$request = mysql_query("SELECT MAX(visuels_actu_classement) AS classement FROM visuels_actu WHERE visuels_actu_fk = $id");
					$val = mysql_fetch_assoc($request);
					$classement = $val['classement']+1;
					$request = mysql_query("SELECT COUNT(*) AS nb FROM visuels_actu WHERE visuels_actu_fk = $id");
					$val = mysql_fetch_assoc($request);
					$nb = $val['nb'];
					if($nb == 0){
						$classement = 0;
					}
					mysql_query("INSERT INTO visuels_actu VALUES ('','actus/$id-$max.jpg','actus/$id-$max-min.jpg','0','$id','$classement')");
					mysql_close();
					if(recrop($_FILES['image']['tmp_name'],'../../actus/'.$id.'-'.$max.'-temp.jpg','../../actus/'.$id.'-'.$max.'.jpg','../../actus/'.$id.'-'.$max.'-min.jpg',1005, 35, 35)){
						echo '<script type="text/javascript">window.parent.updateFrame();</script>';
					}
				}
			}
		}
	}
	
	if(isset($_FILES['miniature']) && $_FILES['miniature']['error'] == 0 && isset($_POST['id']) && !empty($_POST['vimeo'])){
		$id = intval($_POST['id']);
		$video = $_POST['vimeo'];
		if($_FILES['miniature']['size'] <= 20000000){
			$infosfichier = pathinfo($_FILES['miniature']['name']);
			$extension_upload = $infosfichier['extension'];
			$extensions_autorisees = array('jpg', 'jpeg', 'JPG', 'JPEG');
			if(in_array($extension_upload, $extensions_autorisees)){
				if($id == 0){
					if(move_uploaded_file($_FILES['miniature']['tmp_name'],'../tmp/'.$nom.'-min.jpg')){
						$_SESSION['images'][] = $nom;
						$_SESSION['vimeo'][] = $video;
						echo '<script type="text/javascript">window.parent.updateFrame();</script>';
					}
				}else{
					include('../../php/connect.inc.php');
					mysql_query("SET NAMES UTF8");
					$request = mysql_query("SELECT MAX(visuels_actu_id) AS max FROM visuels_actu");
					$val = mysql_fetch_assoc($request);
					$max = $val['max']+1;
					$request = mysql_query("SELECT MAX(visuels_actu_classement) AS classement FROM visuels_actu WHERE visuels_actu_fk = $id");
					$val = mysql_fetch_assoc($request);
					$classement = $val['classement']+1;
					$request = mysql_query("SELECT COUNT(*) AS nb FROM visuels_actu WHERE visuels_actu_fk = $id");
					$val = mysql_fetch_assoc($request);
					$nb = $val['nb'];
					if($nb == 0){
						$classement = 0;
					}
					mysql_query("INSERT INTO visuels_actu VALUES ('','actus/$id-$max.jpg','actus/$id-$max-min.jpg','$video','$id','$classement')");
					mysql_close();
					if(move_uploaded_file($_FILES['miniature']['tmp_name'],'../../actus/'.$id.'-'.$max.'-min.jpg')){
						echo '<script type="text/javascript">window.parent.updateFrame();</script>';
					}
				}
			}
		}
	}
?>