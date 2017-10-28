<?php
include_once('sistema/funcoes.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>EEDomestico</title>

		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<h4>Cadastro de cliente</h4>
				
				<form class="form-horizontal" name="form-cadastro" action="sistema/clientes-add" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
						<label for="nome" class="col-sm-2 control-label">Nome</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo" maxlength="200">
						</div>
					</div>
					<div class="form-group">
						<label for="cpf" class="col-sm-2 control-label">CPF</label>
						<div class="col-sm-5">
							<input type="text" class="form-control mask-cpf" id="cpf" name="cpf" placeholder="999.999.999-99" maxlength="14">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">E-mail</label>
						<div class="col-sm-10">
							<input type="email" class="form-control text-lowercase" id="email" name="email" placeholder="E-mail" maxlength="200">
						</div>
					</div>
					<!--
					<div class="form-group">
						<label for="usuario" class="col-sm-2 control-label">Usuário</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" maxlength="100">
						</div>
					</div>
					-->
					<div class="form-group">
						<label for="senha" class="col-sm-2 control-label">Senha</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="#" class="btn btn-default btn-salvar">
								Salvar
							</a>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>			

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.3/datepicker.js"></script>
		
		<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/jquery.form.js"></script>
		<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/mask/jquery.maskedinput.min.js"></script>
		
		
		<script>
			$(document).ready(function(){
				$(".mask-cpf").mask("999.999.999-99");
				
				$('a.btn-salvar').on('click', function(e){
					e.preventDefault();
					
					$('form[name=form-cadastro]').ajaxForm({
			    		success : function(data) {
							console.log(data);
							//$('.carregando').remove();
							$('.msg-form-cadastro').remove();
							
							$('form[name=form-cadastro]').prepend('<div class="alert alert-'+data.type+' alert-styled-left alert-arrow-left alert-component msg-form-cadastro">'+
																	'<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+
																	'<h6 class="alert-heading text-semibold text-center">'+data.msg+'</h6>'+
				    											  '</div>');
							
						},
						error : function() {
							//$('.carregando').remove();
							$('form[name=form-cadastro]').prepend('<div class="alert alert-danger alert-styled-left alert-arrow-left alert-component msg-form-cadastro">'+
																				'<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+
																				'<h6 class="alert-heading text-semibold text-center">Erro na requisição</h6>'+
							    											'</div>');
							
						},
						type:'post',
						dataType:'json',
						url: 'sistema/clientes-add',
						resetForm:true
					}).submit();
					
					
				});
			});
		</script>
		
	</body>
</html>