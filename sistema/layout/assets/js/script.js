$(document).ready(function(){
	//Validar Form
	$('.obrigatorio').change(function(){
		if($(this).val() || $(this).val()!=''){
			$(this).removeClass('inputErro');
		}
	});
	
	$('form.validarForm').submit(function(){
		
		var form_this = $(this);
		
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
		}
	});
	
	//$(function() {
		//$.mask.definitions['~'] = "[+-]";
	    $("#date").mask("99/99/9999",{completed:function(){alert("completed!");}});
	    $("#phoneExt").mask("(999) 999-9999? x99999");
	    $("#iphone").mask("+33 999 999 999");
	    $("#tin").mask("99-9999999");
	    $("#ssn").mask("999-99-9999");
	    $("#product").mask("a*-999-a999", { placeholder: " " });
	    $("#eyescript").mask("~9.99 ~9.99 999");
	    $("#po").mask("PO: aaa-999-***");
		$("#pct").mask("99%");
		/*
	    $("input").blur(function() {
	        $("#info").html("Unmasked value: " + $(this).mask());
	    }).dblclick(function() {
	        $(this).unmask();
	    });
	    */
	    //Mask
	    
	    $(".mask-data").mask("99/99/9999");
	    $(".mask-placa").mask("aaa-9999");
	    $(".mask-periodo").mask("99/9999");
	    $(".mask-cep").mask("99999-999");
	    
	    $(".mask-cnpj").mask("99.999.999/9999-99");
	    $(".mask-cpf").mask("999.999.999-99");
	    
	    $(".mask-telefone").mask("(99) 9999-9999");
	    $(".mask-celular")
	          .mask("(99) 9999-9999?9")
	          .focusout(function (event) {  
	            	var target, phone, element;  
	            	target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
	            	phone = target.value.replace(/\D/g, '');
	            	element = $(target);  
	            	element.unmask();  
	            	if(phone.length > 10) {  
	               		element.mask("(99) 99999-999?9");  
	            	} else {  
	                	element.mask("(99) 9999-9999?9");  
	            	}  
	        	});
	//});
	
	function soNums(e){
	    //teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda)
	    keyCodesPermitidos = new Array(8,9,37,39,46);	     
	    //numeros e 0 a 9 do teclado alfanumerico
	    for(x=48;x<=57;x++){
	        keyCodesPermitidos.push(x);
	    }	     
	    //numeros e 0 a 9 do teclado numerico
	    for(x=96;x<=105;x++){
	        keyCodesPermitidos.push(x);
	    }	     
	    //Pega a tecla digitada
	    keyCode = e.which;	     
	    //Verifica se a tecla digitada é permitida
	    if ($.inArray(keyCode,keyCodesPermitidos) != -1){
	        return true;
	    }    
	    return false;
	}
	
	$(function(){
	    $('.somente_numeros').bind('keydown',soNums); // o "#input" é o input que vc quer aplicar a funcionalidade
	});
	
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	
	$('.table-paginacao').DataTable({
		"language": {
						"url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
				},
		"destroy": true,
		"processing": true
	});
	
	//$('.editor-html').summernote();
	/*
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
    	language: 'pt-BR'
	});
	*/
	$(".datepicker").datepicker({
		dateFormat: 'dd/mm/yy',
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		nextText: 'Próximo',
		prevText: 'Anterior'
	});
	
	$(document).on('focus',".datepicker", function(){
	    $(this).datepicker({
			dateFormat: 'dd/mm/yy',
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			nextText: 'Próximo',
			prevText: 'Anterior'
		});
	});
	
	$('.table-datatable').dataTable({
		"language": {"url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"}
	});
	
	$(".moeda_real").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
	$(".valor-decimal").maskMoney({thousands:'.', decimal:','});
	
	$(".switch").bootstrapSwitch();
	$(".switchery-double").bootstrapSwitch();
	
	if (Array.prototype.forEach) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
    else {
        var elems = document.querySelectorAll('.switchery');
        for (var i = 0; i < elems.length; i++) {
            var switchery = new Switchery(elems[i]);
        }
    }
	$(".switch").bootstrapSwitch();
	
	// Styled checkboxes, radios
    $('.styled, .multiselect-container input').uniform({
        radioClass: 'choice',
        wrapperClass: 'border-primary text-primary'
    });
	
	$('[data-popup="tooltip"]').tooltip();
	$('.tooltipt').tooltip();
	
});
