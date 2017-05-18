<?php
	include('php/connect.inc.php');
	
	mysqli_query("SET NAMES 'utf8'");
	
	$actus_titre = array();
	$actus_sous_titre = array();
	$actus_date = array();
	$actus_commentaire = array();
	$actus_visuel = array();
	$actus_vimeo = array();
	$actus_miniature = array();
	$mem = 0;
	$cpt = -1;
	
	$request = mysqli_query("SELECT * FROM actus INNER JOIN visuels_actu ON visuels_actu_fk = actus_id WHERE actus_online = 1 ORDER BY actus_id DESC, visuels_actu_classement");
	while($val = mysqli_fetch_assoc($request)){
		if($mem == $val['actus_id']){
			$actus_visuel[$cpt][] = $val['visuels_actu_nom'];
			$actus_vimeo[$cpt][] = $val['visuels_actu_vimeo'];
			$actus_miniature[$cpt][] = $val['visuels_actu_min'];
		}else{
			$mem = intval($val['actus_id']);
			if($cpt == -1){
				$id = $mem;
			}
			$cpt++;
			$actus_titre[] = htmlspecialchars($val['actus_titre']);
			$actus_sous_titre[] = htmlspecialchars($val['actus_sous_titre']);
			$actus_date[] = htmlspecialchars($val['actus_date']);
			$actus_commentaire[] = $val['actus_commentaire'];
			$actus_visuel[] = array($val['visuels_actu_nom']);
			$actus_vimeo[] = array($val['visuels_actu_vimeo']);
			$actus_miniature[] = array($val['visuels_actu_min']);
		}
	}
	
	mysqli_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Abciss</title>
		<meta name="description" content=""/>
		<meta http-equiv="Content-Language" content="fr" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=0.6">
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin' rel='stylesheet' type='text/css' />
		<link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
		<script type="text/javascript" src="js/fonction.js"></script>
		<?php if(!empty($_GET['r'])){ ?>
		<script type="text/javascript">
			$(function(){
				$('#general').css('left',0);
			})
		</script>
		<?php } ?>
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
			<img src="fond/a<?php echo $id; ?>.jpg" alt="background" />
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
							<img class="vers_menu" src="images/vers-menu.png" alt="vers menu" /><a class="sel vers_menu">MENU</a><span class="ligne"></span><a href="actus.php" class="sel">ACTUALITES</a>
						</div>
						<div id="conteneur">
							<?php for($i=0;$i<count($actus_titre);$i++){ ?>
							<script type="text/javascript">		
								$(function(){
									$('#visuel<?php echo $i; ?>').cycle({
										fx : 'fade',
										timeout : 0,
										pager : '#nav<?php echo $i; ?>',
										pagerAnchorBuilder: function(idx, slide) { 
											return '#nav<?php echo $i; ?> a:eq(' + idx + ') '; 
										}
									});
									$('#nav<?php echo $i; ?>').on('click',function(){
										$('#visuel<?php echo $i; ?> iframe').each(function(index){
											var source = $(this).attr('src');
											$(this).attr('src','').attr('src',source);
										});
									})
								});
							</script>
							<div class="actu <?php if($i == 0){ echo 'first'; } ?>">
								<?php if($i != 0){?><a class="ouvrir"></a><?php }else{ ?><a class="fermer"></a><?php } ?>
								<p class="t19 orange"><?php echo $actus_date[$i]; ?></p>
								<h2><?php echo $actus_titre[$i]; ?></h2>
								<p class="t14"><?php echo $actus_sous_titre[$i]; ?></p>
								<div class="masque" <?php if($i == 0){?>style="display:block"<?php } ?>>
									<div class="visuel">
										<div id="visuel<?php echo $i; ?>" class="image">
											<?php for($j=0;$j<count($actus_visuel[$i]);$j++){ if($actus_vimeo[$i][$j] == 0){ echo '<img src="'.$actus_visuel[$i][$j].'" alt="'.$actus_titre[$i].'" class="pic"/>'; }else{ echo '<iframe src="http://player.vimeo.com/video/'.$actus_vimeo[$i][$j].'" width="491px" height="277" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen class="pic"></iframe>'; }} ?>
										</div>
										<div id="nav<?php echo $i; ?>"><?php for($j=0;$j<count($actus_miniature[$i]);$j++){ echo '<a href="#"><img src="'.$actus_miniature[$i][$j].'" alt="miniature" class="miniature"/></a>'; } ?></div>
									</div>
									<div class="texte">
										<?php echo $actus_commentaire[$i]; ?>
									</div>
									<div class="pied"></div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="pied"></div>
			</div>
		</div>
	</body>
</html>