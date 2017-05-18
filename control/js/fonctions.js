function updateFrame(){
	$('form[name=upload] input[name=image]').replaceWith('<input type="file" name="image"/>');
	$('form[name=vimeo] input[name=miniature]').replaceWith('<input type="file" name="miniature"/>');
	$('form[name=vimeo] input[name=vimeo]').replaceWith('<input type="text" name="vimeo"/>');
	var id = $('form[name=upload] input[name=id]').val();
	var type = $('form[name=upload] input[name=type]').val();
	$.post('ajax/liste-images.php',{id : id, type : type},function(data){
		$('#liste_images').html(data);
		$('#loading').hide();
		tri();
	});
}

function tri(){
	var id = $('input[name=id]').val();
	var type = $('form[name=upload] input[name=type]').val();
	$('#liste_images').sortable({distance:30,update:function(){
		var order = $(this).sortable('serialize')+'&id='+id+'&type='+type;
		$.post('ajax/liste-images.php',order,function(data){
			$('#liste_images').html(data);
			tri();	
		});
	}});
	$('#liste_images').disableSelection();
}

$(function(){
	$('select[name=choix]').change(function(){
		$(location).attr('href','projets.php?i='+$(this).val());
	});

	$('.supprimer').click(function(){
		return confirm('Confirmez-vous cette suppression?');
	});

	$('#presentation').redactor({
		toolbar: 'custom',
		lang: 'fr'
	});
	
	$('#gestion_image').click(function(){
		$('form[name=upload]').toggle();
	});
	
	$('#gestion_vimeo').click(function(){
		$('form[name=vimeo]').toggle();
	});
	
	$('form[name=upload]').on('submit',function(){
		$('#loading').show();
		$(this).hide();
	});
	
	$('form[name=vimeo]').on('submit',function(){
		$('#loading').show();
		$(this).hide();
	});
	
	$('.visuel .supp').live('click',function(){
		var sup = $(this).attr('id');
		var id = $('form[name=upload] input[name=id]').val();
		var type = $('form[name=upload] input[name=type]').val();
		if(confirm('Êtes vous sur de vouloir supprimer ce visuel?')){
			$.post('ajax/liste-images.php',{sup : sup, id : id, type : type},function(data){
				$('#liste_images').html(data);
				tri();
			});
		}
	});
	
	tri();
	
});