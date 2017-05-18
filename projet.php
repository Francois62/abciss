<?php
	include('php/connect.inc.php');
	
	mysql_query("SET NAMES 'utf8'");
	
	if(!empty($_GET['i'])){
		$id = intval($_GET['i']);
	}else{
		header('Location:./');
	}
	
	$request = mysql_query("SELECT c1.categories_nom AS nom, c2.categories_nom AS parent, projets_categorie FROM projets INNER JOIN categories c1 ON c1.categories_id = projets_categorie INNER JOIN categories c2 ON c1.categories_parent = c2.categories_id WHERE projets_id = $id");
	$val = mysql_fetch_assoc($request);
	$projet_nom = htmlspecialchars($val['nom']);
	$projet_parent = htmlspecialchars($val['parent']);
	$projet_id = intval($val['projets_categorie']);
	
	
	$mem = false;
	$projet_visuel = array();
	$projet_vimeo = array();
	$projet_miniature = array();
	
	$request = mysql_query("SELECT * FROM projets INNER JOIN visuels_projet ON projets_id = visuels_projet_fk WHERE projets_online = 1 AND projets_id = $id ORDER BY visuels_projet_classement");
	while($val = mysql_fetch_assoc($request)){
		if($mem){
			$projet_visuel[] = $val['visuels_projet_nom'];
			$projet_vimeo[] = $val['visuels_projet_vimeo'];
			$projet_miniature[] = $val['visuels_projet_min'];
		}else{
			$mem = true;	
			$titre = htmlspecialchars($val['projets_titre']);
			$intro = htmlspecialchars($val['projets_intro']);
			$date = htmlspecialchars($val['projets_date']);
			$lieu = htmlspecialchars($val['projets_lieu']);
			$statut = htmlspecialchars($val['projets_status']);
			$surface = htmlspecialchars($val['projets_surface']);
			$cout = htmlspecialchars($val['projets_cout']);
			$presentation = $val['projets_presentation'];
			$pdf = 'pdf/'.$id.'.pdf';
			$projet_visuel[] = $val['visuels_projet_nom'];
			$projet_vimeo[] = $val['visuels_projet_vimeo'];
			$projet_miniature[] = $val['visuels_projet_min'];
		}
	}

	mysql_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Abciss</title>
		<meta name="description" content=""/>
		<meta name="viewport" content="width=device-width, initial-scale=0.6">
		<meta http-equiv="Content-Language" content="fr" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin' rel='stylesheet' type='text/css' />
		<link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="css/jquery.fancybox.css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
		<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
		<script type="text/javascript">		
			$(function(){
				$('.fancybox').fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',
					padding : 0,
					helpers : {
						overlay : {
							closeClick : false,
							opacity: 1
							
						}
					}	
				});
			
				$('#visuel').cycle({
					fx : 'fade',
					timeout : 0,
					pager : '#nav',
					pagerAnchorBuilder: function(idx, slide) { 
						return '#nav a:eq(' + idx + ') '; 
					}
				});
				$('#nav').on('click',function(){
					$('#visuel iframe').each(function(index){
						var source = $(this).attr('src');
						$(this).attr('src','').attr('src',source);
					});
				})
			});
		</script>
		<script type="text/javascript" src="js/fonction.js"></script>
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
			<img src="fond/<?php echo $id; ?>.jpg" alt="background" />
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
							<img class="vers_menu" src="images/vers-menu.png" alt="vers menu"><a class="sel vers_menu">MENU</a><span class="ligne1"></span><a class="vers_menu">PROJETS</a><span class="ligne2"></span><a class="vers_menu"><?php echo $projet_parent; ?></a><span class="ligne"></span><a href="projets.php?i=<?php echo $projet_id; ?>" class="sel"><?php echo $projet_nom; ?></a>
						</div>
						<div id="conteneur">
							<p class="t19 orange"><?php echo $date; ?></p>
							<h2><?php echo $titre; ?></h2>
							<p class="t14"><?php echo $intro; ?></p>
							<div id="projet">
								<div class="texte">
									<?php echo $presentation; ?>
									<p class="t19 orange" id="info1">INFOS</p>
									<p id="info2"> Lieu : <?php echo $lieu ?><br/>Statut : <?php echo $statut; ?><br/>Surface : <?php echo $surface; ?><br/>Coût : <?php echo $cout ?></p>
									<?php if(file_exists($pdf)){ ?><a id="pdf" href="php/download.php?i=<?php echo $id; ?>"><img src="images/pdf.png" alt="pdf"/> <span>Télécharger la fiche descriptive du projet</span></a><?php } ?>
								</div>
								<div class="visuel">
									<div id="visuel" class="image">
										<?php for($j=0;$j<count($projet_visuel);$j++){ if($projet_vimeo[$j] == 0){ echo '<a class="fancybox" rel="gallery" title=" '.$titre.'" href="'.$projet_visuel[$j].'"><img src="'.$projet_visuel[$j].'" alt="'.$titre.'" class="pic"/><img src="images/zoom.png" alt="zoomer" class="zoom"/></a>'; }else{ echo '<iframe src="http://player.vimeo.com/video/'.$projet_vimeo[$j].'" width="489px" height="275" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen class="pic"></iframe>'; }} ?>
									</div>
									<div id="nav"><?php for($j=0;$j<count($projet_miniature);$j++){ if($j%10 == 0 && $j != 0){ echo '<a href="#"><img src="'.$projet_miniature[$j].'" alt="miniature" class="miniature" style="margin:0;"/></a>';}else{ echo '<a href="#"><img src="'.$projet_miniature[$j].'" alt="miniature" class="miniature"/></a>'; }} ?></div>
								</div>
								<div class="pied"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="pied"></div>
			</div>
		</div>
	</body>
</html>