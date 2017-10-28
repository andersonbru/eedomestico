<?php
require_once("topo.php");
require_once("cabecalho.php");
$template = new Template();
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
				<!--
				<div class="page-header-content">
					<div class="page-title">
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Principal</h4>
					</div>
					
				</div>
				-->
				
				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="/"><i class="icon-home2 position-left"></i> Home</a></li>
						<li class="active">Controle de Clientes</li>
					</ul>
					
					<ul class="breadcrumb-elements">
						<li>
							<a href="clientes-add" class=""><i class="glyphicon glyphicon-user"></i> Novo Cliente</a>
						</li>
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
								<h6 class="panel-title">Controle de Clientes</h6>
								<div class="heading-elements">
									<!-- <span class="label bg-success heading-text">28 active</span> -->
									<!-- 
									<form class="heading-form" name="filtros" action="/clientes" method="get">
										<div class="form-group">
											<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
												<input type="checkbox" class="switchery" <?=(isset($_GET['status'])?in_array('I', $_GET['status'])?'checked="checked"':'':'checked="checked"')?> name="status[]" value="I">
												Inativo:
											</label>
										</div>
										
										<div class="form-group">
											<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
												<input type="checkbox" class="switchery" <?=(isset($_GET['status'])?in_array('A', $_GET['status'])?'checked="checked"':'':'checked="checked"')?> name="status[]" value="A">
												Ativo:
											</label>
										</div>
										<!--
										<div class="form-group">
											<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
												<input type="checkbox" class="switchery" <?=(isset($_GET['status'])?in_array('B', $_GET['status'])?'checked="checked"':'':'checked="checked"')?> name="status[]" value="B">
												Bloqueado:
											</label>
										</div>
										-- >
									</form>
									<!--
									<ul class="icons-list">
										<li class="dropdown">
				                			<a href="/cliente-add" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Cadastro Novo</a>								
				                		</li>
				                	</ul>
				                	-->
			                	</div>
			                	
							</div>
							
							<div class="panel-body">
								
								<!--
								<h6 class="panel-title">Filtros</h6>
								<form action="/clientes" method="get" class="form-inline">												
									<div class="form-group">
								    	<label for="status" class="col-sm-2 control-label">Status</label>
									    <div class="col-sm-2">
									      	<select id="status" name="status" class="form-control obrigatorio">
												<option value="" <?=(!isset($_GET['status'])?'selected="selected"':'')?> >--Selecione--</option>
												<option value="I" <?=(isset($_GET['status'])&&$_GET['status']=='I'?'selected="selected"':'')?> >Inativo</option>
												<option value="A" <?=(isset($_GET['status'])&&$_GET['status']=='A'?'selected="selected"':'')?> >Ativo</option>
												<option value="B" <?=(isset($_GET['status'])&&$_GET['status']=='B'?'selected="selected"':'')?> >Bloqueado</option>
											</select>
									    </div>
								  	</div>
								  	<div class="form-group">
								  		<button type="submit" class="btn btn-default">Filtrar</button>
								  	</div>
									
								</form>
								-->
								
							</div>
							
							<?php
		                	if(isset($retorno)){
		                		$template->gerarMensagem($retorno['type'], $retorno['msg']);
		                	}
		                	?>
							
							<table class="table table-paginacao table-responsive table-clientes">
							<thead>
								<tr>
									<th>Código</th>
									<th>Cadastro</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Status</th>
									<th class="text-center">Ações</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if ($result) {
								foreach ($result as $key => $value) {
									
									$status_desc 	= '';
									$status_label	= '';
									if ($value['ativo']=='S') {
										$status_desc 	= 'Ativo';
										$status_label	= 'success';
									} else if ($value['ativo']=='N'){
										$status_desc 	= 'Inativo';
										$status_label	= 'danger';
									} else if ($value['ativo']=='B'){
										$status_desc 	= 'Bloqueado';
										$status_label	= 'warning';
									}
									
									echo '<tr>';
										echo '<td>'.$value['id'].'</td>';
										echo '<td>'.dt_br($value['dt_cadastro']).'</td>';
										echo '<td><a href="clientes-edit/'.$value['id'].'">'.$value['nome'].'</a></td>';
										echo '<td>'.$value['email'].'</td>';
										echo '<td><span class="label label-'.$status_label.'">'.$status_desc.'</span></td>';
										echo '<td><ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															<i class="icon-menu9"></i>
														</a>			
														<ul class="dropdown-menu dropdown-menu-right">
															<li>
																<a href="clientes-edit/'.$value['id'].'">
																	<i class="glyphicon glyphicon-pencil"></i> Editar
																</a>
															</li>
															<li>
																<a href="'.$value['id'].'" rel="excluir">
																	<i class="glyphicon glyphicon-remove"></i> Excluir
																</a>
															</li>
														</ul>
													</li>
												</ul>
											  </td>';
									echo '</tr>';
								}
							}
							?>
								
							</tbody>
						</table>
							
							
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
	
<!-- Modal -->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modalExcluirLabel">Confirmação de exclusão</h4>
			</div>
			<div class="modal-body">				
				<h3>Você realmente deseja excluir esse registro?</h3>
				<input type="hidden" name="reg_excluir" value="" />
			</div>
			<div class="modal-footer">
				<button type="button" rel="cancel_exclusao" class="btn btn-default" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button" rel="confir_exclusao" class="btn btn-primary">
					Confirmar
				</button>
			</div>
		</div>
	</div>
</div>
	
<?php
require_once("rodape.php");
?>
<script>
$(document).ready(function(){
		
	$(document).on('click','a[rel=excluir]',function(e){
		e.preventDefault();
		var id = $(this).attr('href');
		console.log(id);
		$('input[name=reg_excluir]').val(id);
		$('#modalExcluir').modal('show');
	});
	
	$(document).on('click','button[rel=cancel_exclusao]',function(e){
		e.preventDefault();
		$('input[name=reg_excluir]').val('');
		$('#modalExcluir').modal('hide');
	});
	
	$(document).on('click','button[rel=confir_exclusao]',function(e){
		e.preventDefault();
		var id = $('input[name=reg_excluir]').val();
		window.location = '/cliente-del/'+id;
	});
	
	$('input[type=checkbox][name^=status]').on('click', function(){
		console.log($(this).val());
		$('form[name=filtros]').submit();
	});
	
	
	
});
</script>