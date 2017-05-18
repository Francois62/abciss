<?php
	include('connect.inc.php');
	
	mysqli_query("SET NAMES 'utf8'");
	
	$categories = array();
	$request = mysqli_query("SELECT c1.categories_nom AS nom_p, c2.categories_nom AS nom_f, c2.categories_id AS id_f FROM categories c1 INNER JOIN categories c2 ON c1.categories_id = c2.categories_parent WHERE c1.categories_niveau = 0");
	while($val = mysqli_fetch_assoc($request)){
		if(array_key_exists($val['nom_p'], $categories)){
			$categories[$val['nom_p']][] = array($val['nom_f'],$val['id_f']);
		}else{
			$categories[$val['nom_p']] = array(array($val['nom_f'],$val['id_f']));
		}
	}
	
	mysqli_close();
?>

<div id="lemenu">
	<ul>
		<li class="first">
			<a href="actus.php" class="link">ACTUALITES</a><span class="menu1"></span><a class="sel vers_principal">RETOUR</a><img class="vers_principal" src="images/vers-principal.png" alt="vers principal" />
		</li>
		<li>
			<a>AGENCE</a><span class="menu2"></span><a href="l-agence.php" class="link">ESPRIT</a><span class="menu3"></span>
		</li>
		<li class="rub">
			<a>L'EQUIPE</a><span class="menu4"></span><a href="les-associes.php" class="link">LES ASSOCIES</a>
		</li>
		<li class="sousrub">
			<a href="architectes.php" class="link">LES METIERS</a>
		</li>
		<li class="sousrub">
			<a href="organigramme-dunkerque.php" class="link">ORGANIGRAMME</a>
		</li>
		<li class="sousrubfin">
			<a href="trombinoscope.php" class="link">TROMBINOSCOPE</a>
		</li>
		<li>
			<a>PROJETS</a><span class="menu5"></span><a href="selection.php" class="link">NOTRE SELECTION</a><span class="menu6"></span>
		</li>
		<?php 
			$mem = '';
			$fin1 = end(array_keys($categories));
			$fin2 = count($categories[$fin1])-1;
			foreach($categories as $key => $value){ 
				for($i=0;$i<count($value);$i++){
					if($key != $mem){												
		?>
		<li class="rub" <?php if($mem != ''){ echo 'style="margin-top:5px"';} ?>>
			<a class="test"><?php echo $key; ?></a><span class="menu7"></span><a class="link" href="projets.php?i=<?php echo $value[$i][1]; ?>"><?php echo $value[$i][0]; ?></a>
		</li>
		<?php $mem = $key; }else{ ?>
		<li class="<?php if($fin1 == $key && $fin2  == $i){ ?>sousrubfin<?php }else{ ?>sousrub<?php } ?>">
			<a class="link" href="projets.php?i=<?php echo $value[$i][1]; ?>"><?php echo $value[$i][0]; ?></a>
		</li>
		<?php }}} ?>
		<li>
			<a class="link" href="contact.php">CONTACT</a><span class="menu8"></span>
		</li>
	</ul>
</div>