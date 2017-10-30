<?php
$app->get('/functionarios(/:ativo)', function($ativo='') use ($app){
	valida_logado();
	$ativo = (isset($_GET['ativo'])?$ativo=$_GET['ativo']:$ativo);
	$class = new Funcionarios();
	$result = $class->load($ativo);
	$app->render('funcionariosLst.php',array('result'=>$result));
});

$app->get('/funcionarios-lista/:id_clientes', function($id_clientes='') use ($app){
	valida_logado();
	$class = new Funcionarios();
	$result = $class->load($id_clientes);
	
	if ($result) {
		
		foreach ($result as $key => $value) {
			
			$acoes = '<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>			
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<a href="#" id="'.$value['id'].'" rel="funcionarios-arquivos">
											<i class="icon-file-upload"></i> Add Arquivos
										</a>
									</li>
									<li>
										<a href="#" id="'.$value['id'].'" rel="edit-funcionarios">
											<i class="glyphicon glyphicon-pencil"></i> Editar
										</a>
									</li>
									<li>
										<a href="#" id="'.$value['id'].'" rel="del-funcionarios">
											<i class="glyphicon glyphicon-remove"></i> Excluir
										</a>
									</li>
								</ul>
							</li>
						</ul>';
			
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
			
			$retorno['data'][] = array($value['id'],
									   dt_br($value['dt_cadastro']),
									   $value['nome'],
									   formata_cpf($value['cpf']),
									   $value['rg'],
									   '<span class="label label-'.$status_label.'">'.$status_desc.'</span>',
									   $acoes);
			
		}
		
	}else{
		$retorno['data'][] = array();
	}
	
	die(json_encode($retorno));
	
});

$app->get('/funcionarios-json(/:id_funcionarios)', function($id_funcionarios='') use ($app){
	valida_logado();
	$class = new Funcionarios();
	if (!empty($id_funcionarios)) {
		$lista = $class->loadId($id_funcionarios);
	} else {
		$lista = $class->load();
	}
	die(json_encode($lista));
});

$app->get('/funcionarios-add', function() use ($app){
	valida_logado();
	$app->render('funcionariosForm.php', array('acao'=>'add'));
});

$app->post('/funcionarios-add', function() use ($app){
	valida_logado();
	$class = new Funcionarios();
	if (isset($_POST['json'])) {
		$fg_json = TRUE;	
	}else{
		$fg_json = FALSE;
	}
	unset($_POST['id']);
	$_POST['cpf'] = limpa_numero($_POST['cpf']);
	if (!valida_cpf($_POST['cpf'])) {
		die(json_encode(array('error'=>TRUE, 'type'=>'warning', 'msg'=>'CPF invalido.')));
	}
	/*
	$valida_email = $cli->validaEmail($_POST['email'], $_POST['cpf']);
	if ($valida_email) {
		die(json_encode(array('success'=>TRUE, 'type'=>'warning', 'msg'=>'Esse E-mail já possui cadastro.')));
	}		
	*/
	if(isset($_POST)){
		//$_POST['senha'] = md5($_POST['senha']);
		$add = $class->add($_POST);		
		if ($add) {
			die(json_encode(array('success'=>TRUE, 'type'=>'success', 'msg'=>'Cadastro efetuado com sucesso.', 'id'=>$add)));
		} else {
			die(json_encode(array('error'=>TRUE, 'type'=>'danger', 'msg'=>'Erro ao fazer o cadastro tente novamente.')));
		}
	}
});

$app->get('/funcionarios-edit/:id(/:type/:msg)', function($id, $type='', $msg='') use ($app){
	valida_logado();
	$class = new Funcionarios();	
	$registro = $class->loadId($id);
	
	if (isset($type) && isset($msg)) {
		$aviso = array('type'=>$type, 'msg'=>$msg);
	}else{
		$aviso = array();
	}
	
	$app->render('funcionariosForm.php',array('acao'=>'edit','registro'=>$registro,'aviso'=>$aviso));	
});

$app->post('/funcionarios-edit', function() use ($app){
	valida_logado();
	
	$class = new Funcionarios();
	
	if(isset($_POST)){
		
		$id = $_POST['id'];
		unset($_POST['id']);
		$where[':ID'] = $id;
		
		$_POST['cpf'] = limpa_numero($_POST['cpf']);
	
		if (!valida_cpf($_POST['cpf'])) {
			die(json_encode(array('error'=>TRUE, 'type'=>'warning', 'msg'=>'CPF invalido.')));
		}
		
		$edit = $class->edit($_POST, $where);
		if ($edit) {			
			die(json_encode(array('success'=>TRUE, 'type'=>'success', 'msg'=>'Registro alterado com sucesso.')));
		} else {
			die(json_encode(array('error'=>TRUE, 'type'=>'danger', 'msg'=>'Erro ao fazer o alteração, tente novamente.')));
		}
				
	}
});


$app->get('/funcionarios-del/:id', function($id) use ($app){
	valida_logado();
	$class = new Funcionarios();
	$funcionario = $class->loadId($id);
	if($id){
		$del = $class->del(array(':ID'=>$id));
		if ($edit) {
			die(json_encode(array('success'=>TRUE, 'type'=>'success', 'msg'=>'Registro excluído com sucesso.')));
		} else {
			die(json_encode(array('error'=>TRUE, 'type'=>'danger', 'msg'=>'Erro ao excluír o registro, tente novamente.')));
		}
	}
});

$app->post('/funcionarios-arquivos-add', function() use ($app){
	valida_logado();
	$class = new Funcionarios();
	
	if(isset($_POST) && isset($_FILES['arquivo']) && $_FILES['arquivo']['size']>0){
		
		$arr['nome'] 				= $_FILES['arquivo']['name'];
		$arr['tipo'] 				= $_FILES['arquivo']['type'];
		$arr['tamanho'] 			= $_FILES['arquivo']['size'];
		$arr['extensao'] 			= mb_strtolower(end(explode('.', $_FILES['arquivo']['name'])));
		$arr['descricao'] 			= $_POST['descricao'];
		$arr['arquivo'] 			= $_FILES['arquivo']['tmp_name'];
		$arr['periodo'] 			= (!empty($_POST['periodo'])?$_POST['periodo']:0);
		$arr['id_clientes'] 		= $_POST['id_clientes'];
		$arr['observacao'] 			= (!empty($_POST['observacao'])?$_POST['observacao']:'');
		$arr['chave'] 				= md5(date('dmYHis').$_POST['id_clientes']);
		$arr['enviado'] 			= $_SESSION['usuario']['perfil'];
		$arr['id_funcionarios'] 	= $_POST['id_funcionarios'];
		$arr['id_categorias']		= $_POST['id_categorias'];
		
		if (!in_array($arr['extensao'], extensoes_permitidos())) {
			die(json_encode(array('error'=>TRUE, 'type'=>'warning', 'msg'=>'Extensões permitidas ('.implode(', ', extensoes_permitidos()).')')));
		}
				
		$arquivo = new Arquivos();
		
		$add = $arquivo->insertBlob($arr['nome'], 
									$arr['tipo'], 
									$arr['tamanho'], 
									$arr['extensao'], 
									$arr['descricao'], 
									$arr['arquivo'], 
									$arr['periodo'], 
									$arr['id_clientes'], 
									$arr['observacao'], 
									$arr['chave'], 
									$arr['enviado'],
									$arr['id_funcionarios'],
									$arr['id_categorias']);
		if ($add) {
			die(json_encode(array('success'=>TRUE, 'type'=>'success', 'msg'=>'Arquivo salvo com sucesso.', 'id'=>$add)));		
		} else {
			die(json_encode(array('error'=>TRUE, 'type'=>'danger', 'msg'=>'Erro ao salvar o arquivo, tente novamente.')));
		}
	}
	
});

$app->get('/funcionarios-arquivos-lista1/:id_funcionarios', function($id_funcionarios) use ($app){
	valida_logado();
	$arquivo 	= new Arquivos();
	$lista1 	= $arquivo->loadArquivosFuncionarios($id_funcionarios);
	
	$result = array();
	if($lista1){
		$desc_categoria = '';
		foreach ($lista1 as $key => $value) {
				
			$tipo = '';
			if ($value['tipo']=='image/png' || $value['tipo']=='image/jpeg') {
				$tipo = 'icon-image2';			
			} else if ($value['tipo']=='application/pdf') {
				$tipo = 'icon-file-pdf';
			} else if ($value['tipo']=='application/zip' || $value['tipo']=='application/rar') {
				$tipo = 'icon-file-zip';
			} else if ($value['tipo']=='application/word') {
				$tipo = 'icon-file-word';
			} else if ($value['tipo']=='text/plain') {
				$tipo = 'icon-file-xml';
			} else{
				$tipo = 'icon-file-empty';
			}
			
			$acoes = '<a href="'.site_url().'/arquivos-dowload/'.md5($value['id']).'" target="_blank" rel="download-arquivo" title="Download do arquivo">
						<i class="icon-file-download text-center"></i>
					  </a>';
			
			$desc_categoria = (!empty($value['desc_categoria'])?$value['desc_categoria']:'-');
			//'<i class="'.$tipo.'" title="'.$value['nome'].'"></i>',
			
			$result['data'][] = array($value['id'],
									  $value['dt_cadastro'],
									  '<a href="#" title="'.$value['observacao'].'">'.$value['descricao'].'</a>',
									  '<i class="'.$tipo.'" title="'.$value['nome'].'"></i>',
									  '<span class="label label-default">'.By2M($value['tamanho']).'</span>',
							  		  $acoes);
			
											  
		}
	}else{
		$result['data'][] = array('','','Nenhum arquivo cadastrado','','','');
	}		
		
	die(html_entity_decode(json_encode($result, JSON_UNESCAPED_UNICODE)));
});

$app->get('/dowload-arquivo/:id', function($id) use ($app){
	valida_logado();	
	$cli_img = new Clientes();
	$img = $cli_img->selectBlobMd5($id);
	
	$ext = explode('/', $img['type']);
	$ext = end($ext);
	
	header('Content-Description: File Transfer');
	header('Content-Disposition: attachment; filename="'.$img['nome'].'.'.$ext.'"');
	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Expires: 0');
	// Envia o arquivo para o cliente
	//readfile(base64_encode($img['arquivo']));
	echo $img['arquivo'];
	
});

$app->get('/visualiza-arquivo/:id', function($id) use ($app){
	valida_logado();	
	$cli_img = new Clientes();
	$img = $cli_img->selectBlobMd5($id);
	
	if ($img['type']=='image/png' || $img['type']=='image/jpeg') {
		echo '<img src="gerarArquivo.php?id='.$id.'">';
	}else{
		header("Content-Type: ".$img['type']."");
		echo base64_decode($img['arquivo']);
	}
	
});

$app->get('/arquivo/:id_usuarios/:chave', function($id_usuarios, $chave) use ($app){
	valida_logado();	
	$cli_img = new Clientes();
	$img = $cli_img->selectBlob($id_usuarios, $chave);
	header("Content-Type:" . $img['type']);
	echo $img['arquivo'];
});


?>