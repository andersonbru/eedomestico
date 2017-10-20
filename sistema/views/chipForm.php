<?php
require_once("topo.php");
require_once("cabecalho.php");
$titulo = 'Chip';
?>

<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
		<?php
		require_once("menu.php");
		?>	
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-default">
				<div class="page-header-content">
					<div class="page-title">
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Principal</h4>
					</div>					
					
				</div>

				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="/"><i class="icon-home2 position-left"></i> Home</a></li>
						<li class="active">Controle de <?=$titulo?></li>
					</ul>					
										
				</div>
			</div>
			<!-- /page header -->

			<!-- Content area -->
			<div class="content">

				<!-- Dashboard content -->
				<div class="row">
					<div class="col-lg-12">

						<!-- principal -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Controle de <?=$titulo?> - <?=$acao=='add'?'Cadastro':'Alteração'?></h6>
								<div class="heading-elements">
									<!-- <span class="label bg-success heading-text">28 active</span> -->
									
									<ul class="icons-list">
				                		<li class="dropdown">
				                			<a href="/chip" class=""><i class="glyphicon glyphicon-arrow-left"></i> Voltar</a>										
				                		</li>
				                		<?php
				                		if($acao=='add'){
				                			echo '<li class="dropdown">
							                			<a href="#" rel="novo-campo" class=""><i class="glyphicon glyphicon-plus"></i> Novo</a>										
							                		</li>';	
				                		}
				                		?>
				                	</ul>
				                	
			                	</div>
							</div>
							<div class="panel-body">
								<?php
								if(isset($registro)){
									$data = $registro;
								}else{
									$data = array();
								}
																
								$form = new Template();
								
								$form->iniciarForm('/chip-'.$acao);
									
									if($acao=='add'){										
									?>
										<div class="form-group campos" id="1">
											<div class="row">
												
												<div class="col-md-6">
													<label>Fornecedores</label>
													<select id="id_fornecedores" name="id_fornecedores" class="bootstrap-select form-control" data-live-search="true" data-width="100%">
														<?php
														$fornecedor = new Fornecedores();
														$fornec_lst = $fornecedor->load($_SESSION['usuario']['id']);
														if ($fornec_lst) {
															foreach ($fornec_lst as $key => $value) {
																echo '<option value="'.$value['id'].'">'.$value['nome'].'</option>';
															}
														}
														?>																												
													</select>													
												</div>												
												
											</div>
										</div>
										<div class="form-group campos" id="1">
											<div class="row">
												
												<div class="col-md-2">
													<label>ID Chip</label>
													<input type="text" id="id_chip" name="id_chip[]" maxlength="100" value="<?=isset($registro)?$registro['id_chip']:''?>" class="form-control obrigatorio">
												</div>												
												<div class="col-md-1">
													<label>Modelo</label>
													<select id="id_modelo_chip" name="id_modelo_chip[]" class="bootstrap-select form-control" data-live-search="true" data-width="100%">
														<option value="">--Selecione--</option>														
													</select>													
												</div>												
												<div class="col-md-2">
													<label>Número</label>
													<input type="text" id="numero" name="numero[]" maxlength="16" value="<?=isset($registro)?$registro['numero']:''?>" class="form-control obrigatorio mask-celular">
												</div>
												<div class="col-md-2">
													<label>Operadora</label>
													<select id="id_operadoras" name="id_operadoras[]" class="bootstrap-select form-control" data-live-search="true" data-width="100%">
														<option value="">--Selecione--</option>														
													</select>													
												</div>
												<div class="col-md-2">
													<label>Dt. cadastro</label>
													<input type="text" id="dt_cadastro" name="dt_cadastro[]" maxlength="10" value="<?=isset($registro)?$registro['dt_cadastro']:''?>" class="form-control obrigatorio mask-data datepicker">
												</div>
												<div class="col-md-2">
													<label>Dt. ativação</label>
													<input type="text" id="dt_ativacao" name="dt_ativacao[]" maxlength="10" value="<?=isset($registro)?$registro['dt_ativacao']:''?>" class="form-control obrigatorio mask-data datepicker">
												</div>
												
											</div>
										</div>
										<div id="campos">
											
										</div>
									
									<?php									
									}else{
									?>	
									<div class="form-group campos" id="1">
											<div class="row">
												
												<div class="col-md-6">
													<label>Fornecedores</label>
													<select id="id_fornecedores" name="id_fornecedores" class="bootstrap-select form-control" data-live-search="true" data-width="100%">
														<?php
														$fornecedor = new Fornecedores();
														$fornec_lst = $fornecedor->load($_SESSION['usuario']['id']);
														if ($fornec_lst) {
															foreach ($fornec_lst as $key => $value) {
																echo '<option value="'.$value['id'].'" '.($value['id']==$registro['id_fornecedores']?'selected="selected"':'').' >'.$value['nome'].'</option>';
															}
														}
														?>														
													</select>													
												</div>												
												
											</div>
										</div>
										<div class="form-group campos" id="1">
											<div class="row">
												
												<div class="col-md-2">
													<label>ID Chip</label>
													<input type="text" id="id_chip" name="id_chip" maxlength="100" value="<?=isset($registro)?$registro['id_chip']:''?>" class="form-control obrigatorio">
													<input type="hidden" id="id" name="id" maxlength="100" value="<?=isset($registro)?$registro['id']:''?>">
												</div>												
												<div class="col-md-2">
													<label>Modelo</label>
													<select id="id_modelo_chip" name="id_modelo_chip" class="bootstrap-select form-control" data-live-search="true" data-width="100%">
														<?php
														$modelo = new ModeloChip();
														$modelo_lst = $modelo->load();
														if ($modelo_lst) {
															foreach ($modelo_lst as $key => $value) {
																echo '<option value="'.$value['id'].'" '.($value['id']==$registro['id_modelo_chip']).'>'.$value['descricao'].'</option>';	
															}
														}
														?>																												
													</select>													
												</div>												
												<div class="col-md-2">
													<label>Número</label>
													<input type="text" id="numero" name="numero" maxlength="16" value="<?=isset($registro)?$registro['numero']:''?>" class="form-control obrigatorio mask-celular">
												</div>
												<div class="col-md-2">
													<label>Operadora</label>
													<select id="id_operadoras" name="id_operadoras" class="bootstrap-select form-control" data-live-search="true" data-width="100%">
														<?php
														$operadora = new Operadoras();
														$operadora_lst = $operadora->load();
														if ($operadora_lst) {
															foreach ($operadora_lst as $key => $value) {
																echo '<option value="'.$value['id'].'" '.($value['id']==$registro['id_operadoras']).'>'.$value['descricao'].'</option>';	
															}
														}
														?>
													</select>													
												</div>
												<div class="col-md-2">
													<label>Dt. cadastro</label>
													<input type="text" id="dt_cadastro" name="dt_cadastro" maxlength="10" value="<?=isset($registro)?dt_br($registro['dt_cadastro']):''?>" class="form-control obrigatorio mask-data datepicker">
												</div>
												<div class="col-md-2">
													<label>Dt. ativação</label>
													<input type="text" id="dt_ativacao" name="dt_ativacao" maxlength="10" value="<?=isset($registro)?dt_br($registro['dt_ativacao']):''?>" class="form-control obrigatorio mask-data datepicker">
												</div>
												
											</div>
										</div>
									<?php	
									}									
										
									$form->buttonForm(($acao=='add'?'Salvar':'Alterar'));
												
								$form->finalizarForm();
								
								?>
							</div>
						</div>
						<!-- /principal -->
						
					</div>
					
				</div>
				<!-- /dashboard content -->				

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</div>
<!-- /page container -->
<?php
require_once("rodape.php");
?>
<script>

function combo_modelo_chip(id){
	var opt = '';
	$.ajax({
		url:'/modelos-chip-json',
		dataType:'json',
		success:function(data){			
			$.each(data, function(i, v){
				opt+= '<option value="'+v.id+'">'+v.descricao+'</option>';
			});
			$('select[id='+id+']').html(opt).selectpicker('refresh');
		}		
	});
}

function combo_operadora(id){
	var opt = '';
	$.ajax({
		url:'/operadoras-json',
		dataType:'json',
		success:function(data){			
			$.each(data, function(i, v){
				opt+= '<option value="'+v.id+'">'+v.descricao+'</option>';
			});
			$('select[id='+id+']').html(opt).selectpicker('refresh');
		}		
	});
}

$(document).ready(function(){
	if('<?=$acao?>'=='add'){
		combo_modelo_chip('id_modelo_chip');
		combo_operadora('id_operadoras');
	}
	
	$('a[rel=novo-campo]').on('click', function(e){
		e.preventDefault();
		
		var proximo = parseInt($('div.campos').length)+1;
		
		campo = '<div class="form-group campos" id="'+proximo+'">'+
						'<div class="row">'+							
							'<div class="col-md-2">'+
								'<label>ID Chip</label>'+
								'<input type="text" id="id_chip" name="id_chip[]" maxlength="100" value="" class="form-control obrigatorio">'+
							'</div>'+												
							'<div class="col-md-1">'+
								'<label>Modelo</label>'+
								'<select id="id_modelo_chip_'+proximo+'" name="id_modelo_chip[]" class="bootstrap-select form-control" data-live-search="true" data-width="100%">'+
									'<option value="">--Selecione--</option>'+						
								'</select>'+
							'</div>'+
							'<div class="col-md-2">'+
								'<label>Número</label>'+
								'<input type="text" id="numero" name="numero[]" maxlength="16" value="" class="form-control obrigatorio mask-celular">'+
							'</div>'+
							'<div class="col-md-2">'+
								'<label>Operadora</label>'+
								'<select id="id_operadoras_'+proximo+'" name="id_operadoras[]" class="bootstrap-select form-control" data-live-search="true" data-width="100%">'+
									'<option value="">--Selecione--</option>'+
								'</select>'+
							'</div>'+
							'<div class="col-md-2">'+
								'<label>Dt. cadastro</label>'+
								'<input type="text" id="dt_cadastro'+proximo+'" name="dt_cadastro[]" maxlength="10" value="" class="form-control obrigatorio mask-data datepicker">'+
							'</div>'+
							'<div class="col-md-2">'+
								'<label>Dt. ativação</label>'+
								'<input type="text" id="dt_ativacao'+proximo+'" name="dt_ativacao[]" maxlength="10" value="" class="form-control obrigatorio mask-data datepicker">'+
							'</div>'+
							'<div class="col-md-1">'+
								'<label>Ação</label>'+
								'<p>'+
									'<a href="'+proximo+'" class="btn btn-danger" rel="del-campo"><i class="glyphicon glyphicon-remove"></i></a>'+
								'</p>'+
							'</div>'+
						'</div>'+
					'</div>';
					
		$('div#campos').append(campo);
		$(".mask-data").mask("99/99/9999");
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
		
		combo_modelo_chip('id_modelo_chip_'+proximo);
		combo_operadora('id_operadoras_'+proximo);
		
	});
	
	$(document).on('click', 'a[rel=del-campo]', function(e){
		e.preventDefault();
		$('div.campos[id='+$(this).attr('href')+']').remove();
	});	
	
	
});
</script>	
