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
				
				<div class="page-header-content">
					<div class="page-title">
						<h6>
							<!-- <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Principal</span> - -->
							<?=($acao=='add'?'Cadastro':'Alteração')?> de Clientes
						</h6>
					</div>
					
					<!--
					<div class="heading-elements">
						<div class="heading-btn-group">
							<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
							<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
							<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
						</div>
					</div>
					-->
				</div>
				

				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="/"><i class="icon-arrow-left52 position-left"></i> Principal</a></li>
						<li class="active">Controle de Clientes</li>
					</ul>
					
					<ul class="breadcrumb-elements">
						<li>
							<a href="<?=site_url()?>/clientes" class=""><i class="icon-reply"></i> Voltar</a>
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
								<h6 class="panel-title">Informações</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<!-- <li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li> -->
				                	</ul>
			                	</div>
		                	</div>

							<div class="panel-body">
							<?php
							
							if (isset($aviso) && !empty($aviso['msg'])) {
								$template->gerarMensagem($aviso['type'], $aviso['msg']);
							}
														
							$template->iniciarForm(site_url().'/clientes-'.$acao);
								
								$template->gerarInputHidden('id', $data['id']);
								$template->gerarInputText('Nome', 'nome', $data['nome'], 'Nome Completo', TRUE, '', '', 2, 2, 6, 6);
								$template->gerarInputText('RG', 'rg', $data['rg'], 'RG', TRUE, '', '', 2, 2, 3, 3);
								$template->gerarInputText('CPF', 'cpf', (isset($data['cpf'])?formata_cpf($data['cpf']):''), 'XXX.XXX.XXX-XX', TRUE, 'mask-cpf', '', 2, 2, 3, 3);
								$template->gerarInputText('Título de Eleitor', 'titulo_eleitor', $data['titulo_eleitor'], '', TRUE, '', '', 2, 2, 3, 3);
								$template->gerarInputText('eSocial', 'esocial', $data['esocial'], '', TRUE, '', '', 2, 2, 3, 3);
								$template->gerarInputText('eSocial Senha', 'esocial_senha', $data['esocial_senha'], '', TRUE, '', '', 2, 2, 3, 3);
								$template->gerarInputText('E-mail', 'email', $data['email'], 'E-mail', TRUE, '', '', 2, 2, 5, 5);
								$template->gerarInputText('Senha', 'senha', $data['senha'], 'Senha de acesso ao sistema', TRUE, '', '', 2, 2, 4, 4, 'password');
								if ($acao=='edit') {
									$template->gerarInputHidden('senha_atual', $data['senha']);
								}
								
								$nacionalidade = new Nacionalidades();
								$nacionalidades = $nacionalidade->load();
								$arr_nacionalidades = array();
								if ($nacionalidades) {
									foreach ($nacionalidades as $key => $value) {
										$arr_nacionalidades[$value['id']] = strtoupper($value['descricao']); 
									}
								}
								$template->gerarSelect('Nacionalidade', 'id_nacionalidade', $arr_nacionalidades, $data['id_nacionalidade'], '', TRUE, 2, 2, 4, 4);
								
								$arr_estado_civil = array('S'=>'Solteiro(a)', 'C'=>'Casado(a)', 'D'=>'Divorciado(a)', 'U'=>'União Estavél', 'V'=>'Viuvo(a)');
								$template->gerarSelect('Estado Civil', 'estado_civil', $arr_estado_civil, $data['estado_civil'], '', TRUE, 2, 2, 3, 3);
								
								$template->gerarInputText('Profissão', 'profissao', $data['profissao'], 'Profissão', TRUE, '', '', 2, 2, 6, 6);								
								$template->gerarInputText('Data de Nascimento', 'dt_nascimento', (isset($data['dt_nascimento'])?dt_br($data['dt_nascimento']):''), 'DD/MM/YYYY', TRUE, 'mask-data', '', 2, 2, 2, 2);
								
								$plano = new Planos();
								$planos = $plano->load();
								$arr_planos = array();
								if ($planos) {
									foreach ($planos as $key => $value) {
										$arr_planos[$value['id']] = $value['descricao'].' ('.numberformat($value['valor']).')'; 
									}
								}
								$template->gerarSelect('Plano', 'id_planos', $arr_planos, $data['id_planos'], '', TRUE, 2, 2, 4, 4);
								
								$template->gerarSelect('Status', 'ativo', array('S'=>'Ativo', 'N'=>'Inativo'), $data['ativo'], '', TRUE, 2, 2, 2, 2);
								
								$template->buttonForm(($acao=='add'?'Salvar':'Alterar'));
								
							$template->finalizarForm();
							?>	
							</div>
						</div>
						
						
						<?php
						if($acao=='edit' && isset($data['id'])){
						?>
						
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Funcionários</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li>
											<a href="#" rel="nv-funcionario" title="Novo funcionário"><i class="icon-plus3"></i></a>
										</li>
				                		<li><a data-action="collapse"></a></li>
				                		<!-- <li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li> -->
				                	</ul>
			                	</div>
		                	</div>

							<div class="panel-body">
								
								<table id="table-funcionarios" class="table table-responsive table-funcionarios">
									<thead>
										<tr>
											<th>Código</th>
											<th>Cadastro</th>
											<th>Nome</th>
											<th>CPF</th>
											<th>RG</th>
											<th>Status</th>
											<th class="text-center">Ações</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
						
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Arquivos</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li>
											<a href="#" rel="nv-arquivos" title="Novo arquivo"><i class="icon-plus3"></i></a>
										</li>
				                		<li><a data-action="collapse"></a></li>
				                		<!-- <li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li> -->
				                	</ul>
			                	</div>
		                	</div>

							<div class="panel-body">
								<table class="table table-responsive table-arquivos">
									<thead>
										<tr>
											<th>Código</th>
											<th>Cadastro</th>
											<th>Descrição</th>
											<th>Tipo</th>
											<th>Tamanho</th>
											<th class="text-center">Ações</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Faturas</h6>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<!-- <li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li> -->
				                	</ul>
			                	</div>
		                	</div>

							<div class="panel-body">
								<table class="table table-paginacao table-responsive table-faturas">
									<thead>
										<tr>
											<th>Código</th>
											<th>Cadastro</th>
											<th>Vencimento</th>
											<th>Valor</th>
											<th>Status</th>
											<th class="text-center">Ações</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<?php
						}
						?>
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
<div class="modal fade" id="modal-funcionario" tabindex="-1" role="dialog" aria-labelledby="modalFuncionarioLabel">
	<div class="modal-dialog modal-full" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modalExcluirLabel">Controle de Funcionários</h4>
			</div>
			<div class="modal-body">
				<?php
				$template->iniciarForm('#','post','','name=form-funcionarios');
				?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
					<?php
					$template->gerarInputHidden('id_clientes', $data['id']);
					$template->gerarInputHidden('id', '');
					$template->gerarInputText('Nome', 'nome', '', 'Nome Completo', TRUE, '', '', 2, 2, 10, 10);
					$template->gerarInputText('RG', 'rg', '', 'RG', TRUE, '', '', 2, 2, 5, 5);
					$template->gerarInputText('CPF', 'cpf', '', 'XXX.XXX.XXX-XX', TRUE, 'mask-cpf', '', 2, 2, 6, 6);
					$template->gerarInputText('Título de Eleitor', 'titulo_eleitor', '', '', TRUE, '', '', 2, 2, 6, 6);
					$template->gerarInputText('Data de Nascimento', 'dt_nascimento', '', 'DD/MM/YYYY', TRUE, 'mask-data', '', 2, 2, 4, 4);
					$template->gerarSelect('Status', 'ativo', array('S'=>'Ativo', 'N'=>'Inativo'), '', '', TRUE, 2, 2, 4, 4);
					?>	
					</div>
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7" style="border-left: 1px solid grey">
						<h5 class="" id="">Arquivos</h5>
						<table class="table table-responsive table-funcionarios-arquivos">
							<thead>
								<tr>
									<th>Código</th>
									<th>Cadastro</th>
									<th>Descrição</th>
									<th>Tipo</th>
									<th>Tamanho</th>
									<th class="text-center">Ações</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
				
				<?php
				$template->finalizarForm();
				?>	
			</div>
			<div class="modal-footer">
				<button type="button" rel="cancel_exclusao" class="btn btn-default" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button" rel="add-funcionarios" class="btn btn-primary">
					Salvar
				</button>
			</div>
		</div>
	</div>
</div>	

<div class="modal fade" id="modal-arquivos" tabindex="-1" role="dialog" aria-labelledby="modalArquivosLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modalExcluirLabel">Controle de Arquivos</h4>
			</div>
			<div class="modal-body">
			<?php
			$template->iniciarForm('#','post','','name=form-arquivos');
				$template->gerarInputHidden('id_clientes', $data['id']);
				$template->gerarInputHidden('id', '');
				$template->gerarInputText('Descrição', 'descricao', '', 'Descrição', TRUE, '', '', 2, 2, 10, 10);
				$template->gerarInputText('Período', 'periodo', '', '99/9999', TRUE, 'mask-periodo', '', 2, 2, 2, 2);
				$template->gerarInputText('Arquivo', 'arquivo', '', 'Arquivos', TRUE, '', '', 2, 2, 10, 10, 'file');				
				$template->gerarTextArea('Observação', 'observacao', '', '');
				
			$template->finalizarForm();
			?>
			</div>
			<div class="modal-footer">
				<button type="button" rel="cancel_exclusao" class="btn btn-default" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button" rel="add-arquivos" class="btn btn-primary">
					Salvar
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-funcionarios-arquivos" tabindex="-1" role="dialog" aria-labelledby="modalFuncionariosArquivosLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="modalFuncionariosArquivosLabel">Controle de Arquivos</h4>
			</div>
			<div class="modal-body">
			<?php
			$template->iniciarForm('#','post','','name=form-funcionarios-arquivos');
				$template->gerarInputHidden('id_clientes', $data['id']);
				$template->gerarInputHidden('id_funcionarios', '');
				$template->gerarInputText('Descrição', 'descricao', '', 'Descrição', TRUE, '', '', 2, 2, 10, 10);
				$template->gerarInputText('Arquivo', 'arquivo', '', 'Arquivos', TRUE, '', '', 2, 2, 10, 10, 'file');				
				$template->gerarTextArea('Observação', 'observacao', '', '');
				
				$arquivosCategorias 		= new ArquivosCategorias();
				$arr_arquivos_categorias 	= $arquivosCategorias->load();
				$arr_values 				= array();
				if ($arr_arquivos_categorias) {
					foreach ($arr_arquivos_categorias as $key => $value) {
						$arr_values[$value['id']] = $value['descricao'];
					}
				}
				$template->gerarSelect('Tipo', 'id_categorias', $arr_values, '', '', TRUE, 2, 2, 6, 6);
				
			$template->finalizarForm();
			?>
			</div>
			<div class="modal-footer">
				<button type="button" rel="cancel_exclusao" class="btn btn-default" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button" rel="add-funcionarios-arquivos" class="btn btn-primary">
					Salvar
				</button>
			</div>
		</div>
	</div>
</div>
	
<script>

function tabela_funcionarios(cliente){
	$('#table-funcionarios').dataTable({		
		ajax: '<?=site_url()?>/funcionarios-lista/'+cliente,
		"language": {
						"url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
				},
		"destroy": true,
		"processing": true
    });    
}
function tabela_arquivos(cliente){
	$('.table-arquivos').dataTable({		
		ajax: '<?=site_url()?>/arquivos-lista/'+cliente,
		"language": {
						"url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
				},
		"destroy": true,
		"processing": true
    });    
}

function tabela_funcionarios_arquivos(funcionario){
	$('table-funcionarios-arquivos tbody').html('');
	$('.table-funcionarios-arquivos').dataTable({		
		ajax: '<?=site_url()?>/funcionarios-arquivos-lista1/'+funcionario,
		"language": {
						"url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
				},
		"destroy": true,
		"processing": true,
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]]
    });    
}

function carregaTabela(){
	//recarregar qual tabela
	
}

function limpaForm(form){
	$('.msg-'+form+'').remove();
	$('form[name='+form+']').find('input, select, textarea').each(function(){
		$(this).val('');
	});
}

function inserirCarregando(elemento){
	var carregando = '<p id="carregando" class="text-center"><center><img src="<?=site_url()?>/layout/assets/images/carregando.gif" alt="carregando"></center></p>';
	$(elemento).html(carregando);
}

function submitForm(formName, consoleLog=false){
	var resetForm = true;
	
	$('.msg-form-'+formName+'').remove();
	
	if('form-'+formName+'-edit'){
		resetForm = false;
	}
	
	$('form[name=form-'+formName+']').ajaxForm({
			
		success : function(data) {
			if(consoleLog) console.log(data);
		    if(data.success){
		    	if(data.id){
		    		$('form[name=form-'+formName+']').attr('action','<?=site_url()?>/'+formName+'-edit');
		    		$('form[name=form-'+formName+'] input[name=id]').val(data.id);
		    	}
		    	tabela_funcionarios(<?=$data['id']?>);
		    }
		    
		    $('form[name=form-'+formName+']').prepend('<div class="alert alert-'+data.type+' alert-styled-left alert-arrow-left alert-component msg-form-'+formName+'">'+
														'<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+
														'<h6 class="alert-heading text-semibold text-center">'+data.msg+'</h6>'+
    											  	  '</div>');
		    			    
		},
		error : function() {
			$('.carregando').remove();
			$('form[name=form-'+formName+']').prepend('<div class="alert alert-danger alert-styled-left alert-arrow-left alert-component msg-form-'+formName+'">'+
															'<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+
															'<h6 class="alert-heading text-semibold text-center">Erro na requisição</h6>'+
		    											'</div>');
		},
		type:'post',
		dataType:'json',
		url:$('form[name=form-'+formName+']').attr('action'),
		resetForm:resetForm
	}).submit();
	
}

$(document).ready(function(){
	
	if('<?=$data['id']?>'!='' && '<?=$acao?>'=='edit'){
		tabela_funcionarios('<?=$data['id']?>');
		tabela_arquivos('<?=$data['id']?>');
	}
	
	$('a[rel=nv-funcionario]').on('click',function(e){
		e.preventDefault();
		limpaForm('form-funcionarios');
		$('form[name=form-funcionarios] input[name=id_clientes]').val(<?=$data['id']?>);
		$('#modal-funcionario').modal('show');
		$('form[name=form-funcionarios]').attr('action','<?=site_url()?>/funcionarios-add');
	});
	
	$(document).on('click', 'a[rel=edit-funcionarios]', function(e){
		e.preventDefault();
		$.ajax({
			url:'<?=site_url()?>/funcionarios-json/'+$(this).attr('id'),
			dataType:'json',
			success:function(data){
				$('form[name=form-funcionarios] input[name=id]').val(data.id);
				$('form[name=form-funcionarios] input[name=id_clientes]').val(data.id_clientes);
				$('form[name=form-funcionarios] input[name=nome]').val(data.nome);
				$('form[name=form-funcionarios] input[name=rg]').val(data.rg);
				$('form[name=form-funcionarios] input[name=cpf]').val(data.cpf).mask("999.999.999-99");
				$('form[name=form-funcionarios] input[name=titulo_eleitor]').val(data.titulo_eleitor);
				$('form[name=form-funcionarios] input[name=dt_nascimento]').val(data.dt_nascimento);
				$('form[name=form-funcionarios] select[name=ativo]').val(data.ativo);
				
				tabela_funcionarios_arquivos($(this).attr('id'));
				
			}
		});
		
		$('#modal-funcionario').modal('show');
		$('form[name=form-funcionarios]').attr('action','<?=site_url()?>/funcionarios-edit');
	});
	
	$(document).on('click', 'a[rel=del-funcionarios]', function(e){
		e.preventDefault();
		$.ajax({
			url:'<?=site_url()?>/funcionarios-del/'+$(this).attr('id'),
			success:function(data){
				tabela_funcionarios('<?=$data['id']?>');
			}
		});
	});
	
	$('#modal-funcionario').on('hidden.bs.modal', function (e) {
		limpaForm('form-funcionarios');
	})
	
	$('button[rel=add-funcionarios]').on('click', function(e){
		e.preventDefault();
		submitForm('funcionarios');
	});
	
	$(document).on('click','a[rel=funcionarios-arquivos]', function(e){
		e.preventDefault();
		limpaForm('form-funcionarios-arquivos');
		$('form[name=form-funcionarios-arquivos] input[name=id_clientes]').val(<?=$data['id']?>);
		$('form[name=form-funcionarios-arquivos] input[name=id_funcionarios]').val($(this).attr('id'));
		$('#modal-funcionarios-arquivos').modal('show');
		$('form[name=form-funcionarios-arquivos]').attr('action','<?=site_url()?>/funcionarios-arquivos-add');
	});
	
	//funcionarios-arquivos
	$('button[rel=add-funcionarios-arquivos]').on('click', function(e){
		e.preventDefault();
		submitForm('funcionarios-arquivos', true);
	});
	
	
	//Ações arquivos
	$('a[rel=nv-arquivos]').on('click',function(e){
		e.preventDefault();
		limpaForm('form-arquivos');
		$('form[name=form-arquivos] input[name=id_clientes]').val(<?=$data['id']?>);
		$('#modal-arquivos').modal('show');
		$('form[name=form-arquivos]').attr('action','<?=site_url()?>/arquivos-add');
	});
	
	$('#modal-arquivos').on('hidden.bs.modal', function (e) {
		limpaForm('form-arquivos');
	})
	
	$('button[rel=add-arquivos]').on('click', function(e){
		e.preventDefault();
		submitForm('arquivos');
	});
	
});
</script>

<?php
require_once("rodape.php");
?>