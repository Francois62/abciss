<?php
	session_start();
	include('../../php/connect.inc.php');

	mysql_query("SET NAMES 'utf8'");
	
	if(!empty($_POST['titre']) && !empty($_POST['categorie']) && isset($_POST['online']) && isset($_POST['id'])){	
		$images = $_SESSION['images'];
		$vimeo = $_SESSION['vimeo'];
		$id = intval($_POST['id']);
		$titre = mysql_real_escape_string($_POST['titre']);
		$introduction = (!empty($_POST['introduction'])) ? mysql_real_escape_string($_POST['introduction']) : '';
		$date = (!empty($_POST['date'])) ? mysql_real_escape_string($_POST['date']) : '';
		$lieu = (!empty($_POST['lieu'])) ? mysql_real_escape_string($_POST['lieu']) : '';
		$status = (!empty($_POST['status'])) ? mysql_real_escape_string($_POST['status']) : '';
		$surface = (!empty($_POST['surface'])) ? mysql_real_escape_string($_POST['surface']) : '';
		$cout = (!empty($_POST['cout'])) ? mysql_real_escape_string($_POST['cout']) : '';
		$presentation = (!empty($_POST['presentation'])) ? mysql_real_escape_string($_POST['presentation']) : '';
		$selection = intval($_POST['selection']);
		$categorie = intval($_POST['categorie']);
		$online = intval($_POST['online']);
		
		if($id == 0){
			mysql_query("INSERT INTO projets VALUES('','$titre','$introduction','$date','$lieu','$status','$surface','$cout','$presentation','$categorie','$selection','$online')");			
			$id = mysql_insert_id();
			for($i=0; $i<count($images); $i++){
				$vid = $vimeo[$i];
				if($vid == 0){
					rename('../tmp/'.$images[$i].'.jpg','../../projets/'.$id.'-'.$i.'.jpg');
				}
				rename('../tmp/'.$images[$i].'-min.jpg','../../projets/'.$id.'-'.$i.'-min.jpg');
				mysql_query("INSERT INTO visuels_projet VALUES ('','projets/$id-$i.jpg','projets/$id-$i-min.jpg','$vid','$id','$i')");
			}
		}else{
			mysql_query("UPDATE projets SET projets_titre = '$titre', projets_intro = '$introduction', projets_date = '$date', projets_lieu = '$lieu', projets_status = '$status', projets_surface = '$surface', projets_cout = '$cout', projets_presentation = '$presentation', projets_categorie = '$categorie', projets_selection = $selection, projets_online = '$online' WHERE projets_id = $id");
		}
		
		if(isset($_POST['effacer_pdf'])){
			unlink('../../pdf/'.$id.'.pdf');
		}
		
		if(isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0){
			if($_FILES['pdf']['size'] <= 20000000){
				$infosfichier = pathinfo($_FILES['pdf']['name']);
				$extension_upload = $infosfichier['extension'];
				$extensions_autorisees = array('pdf', 'PDF');
				if(in_array($extension_upload, $extensions_autorisees)){
					move_uploaded_file($_FILES['pdf']['tmp_name'], '../../pdf/'.$id.'.pdf');
				}
			}
		}
		
		if(isset($_POST['effacer_fond'])){
			unlink('../../fond/'.$id.'.jpg');
		}
		
		if(isset($_FILES['background']) && $_FILES['background']['error'] == 0){
			if($_FILES['background']['size'] <= 10000000){
				$infosfichier = pathinfo($_FILES['background']['name']);
				$extension_upload = $infosfichier['extension'];
				$extensions_autorisees = array('jpg', 'jpeg', 'JPG', 'JPEG');
				$tmp = $_FILES['background']['tmp_name'];
				$infos_img = getimagesize($tmp);
				$longueur = $infos_img[0];
				$hauteur = $infos_img[1];
				if($longueur == 1600 && $hauteur == 900){
					if(in_array($extension_upload, $extensions_autorisees)){
						move_uploaded_file($tmp, '../../fond/'.$id.'.jpg');
					}
				}
			}
		}
	}else if(!empty($_GET['o'])){
		$id = intval($_GET['o']);
		mysql_query("UPDATE projets SET projets_online = 0 WHERE projets_id = $id");
	}else if(!empty($_GET['p'])){
		$id = intval($_GET['p']);
		mysql_query("UPDATE projets SET projets_online = 1 WHERE projets_id = $id");
	}else if(!empty($_GET['s'])){
		$id = intval($_GET['s']);
		if(file_exists('../../pdf/'.$id.'.pdf')){
			unlink('../../pdf/'.$id.'.pdf');
		}
		if(file_exists('../../fond/'.$id.'.jpg')){
			unlink('../../fond/'.$id.'.jpg');
		}
		$request = mysql_query("SELECT * FROM visuels_projet WHERE visuels_projet_fk = $id");
		while($val = mysql_fetch_assoc($request)){
			if(file_exists('../../'.$val['visuels_projet_nom'])){
				unlink('../../'.$val['visuels_projet_nom']);
			}
			unlink('../../'.$val['visuels_projet_min']);
		}
		mysql_query("DELETE FROM visuels_projet WHERE visuels_projet_fk = $id");
		mysql_query("DELETE FROM projets WHERE projets_id = $id ");

	}
	
	mysql_close();
	if(!empty($_GET['i'])){
		$i = intval($_GET['i']);
		header('Location:../projets.php?i='.$i);
	}else{
		header('Location:../projets.php');
	}
?>