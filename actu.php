<?php
	include('php/connect.inc.php');
	
	mysqli_query("SET NAMES 'utf8'");
	
	$request = mysqli_query("SELECT * FROM actus INNER JOIN visuels_actu ON visuels_actu_fk = actus_id WHERE actus_online = 1 ORDER BY actus_id DESC, visuels_actu_classement LIMIT 1");
	$val = mysqli_fetch_assoc($request);
	$actu_id = intval($val['actus_id']);
	$actus_titre = htmlspecialchars($val['actus_titre']);
	$actus_sous_titre = htmlspecialchars($val['actus_sous_titre']);
	$actus_date = htmlspecialchars($val['actus_date']);
	$actus_commentaire = $val['actus_commentaire'];
	$actus_visuel = $val['visuels_actu_nom'];
	
	mysqli_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Abciss</title>
		<meta name="description" content=""/>
		<meta http-equiv="Content-Language" content="fr" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin' rel='stylesheet' type='text/css' />
		<link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/fonction.js"></script>
		<script type="text/javascript">
			$(function(){
				fondu();
				setTimeout("hauteurActu()",100);
				setTimeout("animFondu()",5000);
				setTimeout("redirection2()",6000);
			})
		</script>
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
	<body class="relative">
		<div id="background">
			<img src="fond/a<?php echo $actu_id; ?>.jpg" alt="background" />
		</div>
		<div id="fondu"></div>
		<div id="trame"></div>
		<a href="actus.php" class="actu" id="noborder">
			<p class="t19 orange"><?php echo $actus_date; ?></p>
			<h2><?php echo $actus_titre ?></h2>
			<p class="t14"><?php echo $actus_sous_titre; ?></p>
			<?php if($actus_visuel != ''){ ?><img src="<?php echo $actus_visuel; ?>" alt="<?php echo $actus_titre; ?>" class="pic"/><?php } ?>
			<img id="savoir" src="images/bt-savoir.gif" alt="en savoir plus" />
		</a>
	</body>
</html>