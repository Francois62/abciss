<?php
	session_start();

	include('../../php/connect.inc.php');
	
	mysql_query("SET NAMES UTF8");
	
	$id = intval($_POST['id']);
	if(!empty($_POST['sup']) && $id!=0 && isset($_POST['type'])){
		$sup = intval($_POST['sup']);
		$type = intval($_POST['type']);
		if($type == 0){
			$request = mysql_query("SELECT * FROM visuels_projet WHERE visuels_projet_id = $sup LIMIT 1");
			$val = mysql_fetch_assoc($request);
			$classement = $val['visuels_projet_classement'];
			if(file_exists('../../'.$val['visuels_projet_nom'])){
				unlink('../../'.$val['visuels_projet_nom']);
			}
			unlink('../../'.$val['visuels_projet_min']);
			mysql_query("DELETE FROM visuels_projet WHERE visuels_projet_id = $sup");
			mysql_query("UPDATE visuels_projet SET visuels_projet_classement = (visuels_projet_classement-1) WHERE visuels_projet_fk = $id AND visuels_projet_classement > $classement");
		}else{
			$request = mysql_query("SELECT * FROM visuels_actu WHERE visuels_actu_id = $sup LIMIT 1");
			$val = mysql_fetch_assoc($request);
			$classement = $val['visuels_actu_classement'];
			if(file_exists('../../'.$val['visuels_actu_nom'])){	
				unlink('../../'.$val['visuels_actu_nom']);
			}
			unlink('../../'.$val['visuels_actu_min']);
			mysql_query("DELETE FROM visuels_actu WHERE visuels_actu_id = $sup");
			mysql_query("UPDATE visuels_actu SET visuels_actu_classement = (visuels_actu_classement-1) WHERE visuels_actu_fk = $id AND visuels_actu_classement > $classement");
		}
	}else if(!empty($_POST['sup'])){
		$sup = $_POST['sup'];
		if(file_exists('../tmp/'.$sup.'.jpg')){
			unlink('../tmp/'.$sup.'.jpg');
		}
		unlink('../tmp/'.$sup.'-min.jpg');
		for($i=0; $i<count($_SESSION['images']); $i++){
			if($sup == $_SESSION['images'][$i]){
				array_splice($_SESSION['images'],$i,1);
				array_splice($_SESSION['vimeo'],$i,1);
			}
		}
	}else if(!empty($_POST['img']) && $id!=0 && isset($_POST['type'])){
		$type = intval($_POST['type']);
		$order = $_POST['img'];
		if($type == 0){
			for($i=0; $i<count($order); $i++){
				mysql_query("UPDATE visuels_projet SET visuels_projet_classement = $i WHERE visuels_projet_id = $order[$i]");
			}
		}else{
			for($i=0; $i<count($order); $i++){
				mysql_query("UPDATE visuels_actu SET visuels_actu_classement = $i WHERE visuels_actu_id = $order[$i]");
			}
		}
	}else if(!empty($_POST['img'])){
		$order = $_POST['img'];
		$tab_temp = array();
		$tab_temp_vid = array();
		for($i=0; $i<count($_SESSION['images']); $i++){
			$tab_temp[] = $_SESSION['images'][$order[$i]];
			$tab_temp_vid[] = $_SESSION['vimeo'][$order[$i]];
		}
		$_SESSION['images'] = $tab_temp;
		$_SESSION['vimeo'] = $tab_temp_vid;
	}
		
	if($id==0){
		for($i=0; $i<count($_SESSION['images']); $i++){
?>
	<div class="visuel" id="img_<?php echo $i;?>">
		<img src="tmp/<?php echo $_SESSION['images'][$i]; ?>-min.jpg" />
		<img id="<?php echo $_SESSION['images'][$i];?>" src="../images/supprimer.gif" alt="supprimer" title="supprimer" class="supp" />
	</div>
<?php
		}
	}else if(isset($_POST['type'])){
		$type = intval($_POST['type']);
		if($type == 0){
			$request = mysql_query("SELECT * FROM visuels_projet WHERE visuels_projet_fk = $id ORDER BY visuels_projet_classement");
			while($val = mysql_fetch_assoc($request)){
?>
	<div class="visuel" id="img_<?php echo intval($val['visuels_projet_id']); ?>">
		<img src="../<?php echo htmlspecialchars($val['visuels_projet_min']); ?>?i=<?php echo rand(); ?>" />
		<img id="<?php echo intval($val['visuels_projet_id']); ?>" src="../images/supprimer.gif" alt="supprimer" title="supprimer" class="supp" />
	</div>
<?php
			}
		}else{
			$request = mysql_query("SELECT * FROM visuels_actu WHERE visuels_actu_fk = $id ORDER BY visuels_actu_classement");
			while($val = mysql_fetch_assoc($request)){
?>
	<div class="visuel" id="img_<?php echo intval($val['visuels_actu_id']); ?>">
		<img src="../<?php echo htmlspecialchars($val['visuels_actu_min']); ?>?i=<?php echo rand(); ?>" />
		<img id="<?php echo intval($val['visuels_actu_id']); ?>" src="../images/supprimer.gif" alt="supprimer" title="supprimer" class="supp" />
	</div>
<?php
			}
		}
	}
	mysql_close();
?>
	<div class="pied"></div>