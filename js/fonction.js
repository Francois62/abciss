/*Données relatives à la taille de l'écran*/
var largeurEcran;
var hauteurEcran;
var ratioEcran;

/*Données relatives à la taille de l'image servant de fond*/
var largeurImage = 1600;
var hauteurImage = 900;
var ratioImage = largeurImage/hauteurImage;

/*Données relatives au fond*/
var largeurFond;
var hauteurFond;
var gaucheFond;

/*Mode menu oumode principal*/
var etat = 0;

/*Fonction de stretch du fond*/
function calculeFond(){
	largeurEcran = $(window).width();
	hauteurEcran = ($(window).height()>$('body').height()) ? $(window).height() : $('body').height();
	ratioEcran = largeurEcran/hauteurEcran;
	if(ratioImage < ratioEcran){
		largeurFond = largeurEcran;
		hauteurFond = largeurEcran/ratioImage;
		gaucheFond = 0;
	}else{
		largeurFond = ratioImage*hauteurEcran;
		hauteurFond = hauteurEcran;
		gaucheFond = (largeurEcran - largeurFond)/2;
	}
	$('#background img').css({'width':largeurFond,'height':hauteurFond,'left':gaucheFond});
	$('#background').css('height',hauteurEcran);
	$('#trame').css('height',hauteurEcran);
	$('#general').css('width',2*largeurEcran);
	if(!etat) $('#general').css('left',-largeurEcran);
}

function calculeAriane(){
	var size = 1146;
	var cpt = 0;
	$('#ariane a').each(function(index){
		size -= $(this).outerWidth();
		cpt++;
	});
	if(cpt == 2){
		$('.ligne').width(size);
	}else if(cpt == 4){
		$('.ligne').width(size-18-192);
	}
}

function calculeMenu(){
	$('#lemenu .menu7').each(function(index){
		var size = 245-$(this).prev().width();
		$(this).width(size);
	});
}

function redirection(){
	$(location).attr('href','actu.php');
}

function redirection2(){
	$(location).attr('href','actus.php?r=1');
}

function hauteurLogo(){
	$('#prehome').css('top',((hauteurEcran/2)-112));
}

function hauteurActu(){
	var noborder = $('#noborder');
	noborder.css('top',((hauteurEcran/2)-(noborder.height()/2)));
}

function fondu(){
	$('#fondu').css({'width':largeurFond,'height':hauteurFond});
}

function animFondu(){
	$('#fondu').css('z-index',30).animate({'opacity':1},1000);
}

function trombi(){
	$('#trombinoscope table a').click(function(){
		var nom = $(this).attr('name');
		$('#image1').attr('src','trombi/zoom1-' + nom + '.jpg');
		$('#image2').attr('src','trombi/zoom2-' + nom + '.jpg');
		$('#image3').attr('src','trombi/zoom3-' + nom + '.jpg');
		$.get('trombi/nom-' + nom + '.txt',function(data){
			$('#zoom h3').text(data);
		});
		$.get('trombi/metier-' + nom + '.txt',function(data){
			$('#zoom p').text(data);
		});
		$('#zoom').fadeIn();
	});
	$('#zoom div').cycle({
		speed: 800,
		timeout: 700,
		fx: 'fade'
	});
	$('#zoom #fermer').click(function(){
		$('#zoom').fadeOut();
	});
}

$(function(){
	calculeFond();
	calculeAriane();
	
	$(window).resize(function(){
		calculeFond();
	});
	
	$('.vers_menu').click(function(){
		$('#general').animate({'left':0},500);
		etat = 1;
	});
	
	$('.vers_principal').click(function(){
		$('#general').animate({'left':-largeurEcran},500);
		etat = 0;
	});
	
	$('.ouvrir').live('click',function(){
		$('.fermer').parent().find('.masque').slideUp('fast');
		$('.fermer').removeClass('fermer').addClass('ouvrir');
		$(this).removeClass('ouvrir').addClass('fermer');
		$(this).parent().find('.masque').slideDown('fast',function(){
			calculeFond();
		});
	});
	
	$('.fermer').live('click',function(){
		$(this).removeClass('fermer').addClass('ouvrir');
		$(this).parent().find('.masque').slideUp('fast',function(){
			calculeFond();
		});

	});

	$('#associes a').hover(function(){
		var classe = $(this).attr('class');
		$('#associes p.'+classe).show();
	},function(){
		$('#associes p').hide();
	});
	
	setTimeout("calculeMenu()",300);
});