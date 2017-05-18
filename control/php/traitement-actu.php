<?php
	session_start();
	include('../../php/connect.inc.php');

	mysql_query("SET NAMES 'utf8'");
	
	if(!empty($_POST['titre']) && isset($_POST['online']) && isset($_POST['id'])){	
		$images = $_SESSION['images'];
		$vimeo = $_SESSION['vimeo'];
		$id = intval($_POST['id']);
		$titre = mysql_real_escape_string($_POST['titre']);
		$introduction = (!empty($_POST['introduction'])) ? mysql_real_escape_string($_POST['introduction']) : '';
		$date = (!empty($_POST['date'])) ? mysql_real_escape_string($_POST['date']) : '';
		$presentation = (!empty($_POST['presentation'])) ? mysql_real_escape_string($_POST['presentation']) : '';
		$online = intval($_POST['online']);
		
		if($id == 0){
			mysql_query("INSERT INTO actus VALUES('','$titre','$introduction','$date','$presentation','$online')");			
			$id = mysql_insert_id();
			for($i=0; $i<count($images); $i++){
				$vid = $vimeo[$i];
				if($vid == 0){
					rename('../tmp/'.$images[$i].'.jpg','../../actus/'.$id.'-'.$i.'.jpg');
				}
				rename('../tmp/'.$images[$i].'-min.jpg','../../actus/'.$id.'-'.$i.'-min.jpg');
				mysql_query("INSERT INTO visuels_actu VALUES ('','actus/$id-$i.jpg','actus/$id-$i-min.jpg','$vid','$id','$i')");
			}
		}else{
			mysql_query("UPDATE actus SET actus_titre = '$titre', actus_sous_titre = '$introduction', actus_date = '$date', actus_commentaire = '$presentation', actus_online = '$online' WHERE actus_id = $id");
		}
		
		if(isset($_POST['effacer_fond'])){
			unlink('../../fond/a'.$id.'.jpg');
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
						move_uploaded_file($tmp, '../../fond/a'.$id.'.jpg');
					}
				}
			}
		}
	}else if(!empty($_GET['o'])){
		$id = intval($_GET['o']);
		mysql_query("UPDATE actus SET actus_online = 0 WHERE actus_id = $id");
	}else if(!empty($_GET['p'])){
		$id = intval($_GET['p']);
		mysql_query("UPDATE actus SET actus_online = 1 WHERE actus_id = $id");
	}else if(!empty($_GET['s'])){
		$id = intval($_GET['s']);
		$request = mysql_query("SELECT * FROM visuels_actu WHERE visuels_actu_fk = $id");
		if(file_exists('../../fond/a'.$id.'.jpg')){
			unlink('../../fond/a'.$id.'.jpg');
		}
		while($val = mysql_fetch_assoc($request)){
			if(file_exists('../../'.$val['visuels_actu_nom'])){
				unlink('../../'.$val['visuels_actu_nom']);
			}
			unlink('../../'.$val['visuels_actu_min']);
		}
		mysql_query("DELETE FROM visuels_actu WHERE visuels_actu_fk = $id");
		mysql_query("DELETE FROM actus WHERE actus_id = $id ");

	}
	
	mysql_close();
	
	header('Location:../');
?>