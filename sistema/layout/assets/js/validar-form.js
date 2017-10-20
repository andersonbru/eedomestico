function validar_form(form){
	var form_this = $('form[name='+form+']');
	
	if($('div.aviso').is(':visible')){
		$('div.aviso').remove();
	}
	
	var erros = 0;
	$(form_this).find('.obrigatorio').each(function(){
		if((!$(this).val() || $(this).val()=='') && $(this).is(':visible')){
			$(this).addClass('inputErro');
			erros++;
		}
	});
	
	if(erros>=1){
		$('.carregando').remove();
		/*
		$(form_this).prepend('<div class="alert alert-danger alert-dismissible text-center aviso" role="alert">'+
					  						'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  						'<strong>Existem campos obrigatórios sem preencher.</strong>'+
					  				 '</div>');
		*/
		$(form_this).prepend('<div class="alert alert-danger alert-styled-left alert-arrow-left alert-component aviso">'+
								'<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+
								'<h6 class="alert-heading text-semibold">Existem campos obrigatórios sem preencher.</h6>'+
							'</div>');
		
		$('html,body').animate({scrollTop: $('.aviso').offset().top},'slow');
		return false;
	}else {
		return true;
	}
}