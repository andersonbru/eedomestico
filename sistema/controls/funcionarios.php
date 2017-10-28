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