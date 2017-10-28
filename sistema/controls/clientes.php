<?php
$app->get('/clientes(/:ativo)', function($ativo='') use ($app){
	valida_logado();
	$ativo = (isset($_GET['ativo'])?$ativo=$_GET['ativo']:$ativo);
	$cli = new Clientes();
	$result = $cli->load($ativo);
	$app->render('clienteLst.php',array('result'=>$result));
});

$app->get('/clientes-json', function() use ($app){
	valida_logado();
	$cli = new Clientes();
	$lista = $cli->load($_SESSION['usuario']['id']);
	die(json_encode($lista));
});

$app->get('/clientes-add', function() use ($app){
	valida_logado();
	$app->render('clienteForm.php', array('acao'=>'add'));
});

$app->post('/clientes-add', function() use ($app){
	if (isset($_SESSION['usuario'])) {
		valida_logado();
	}
	
	$cli = new Clientes();
	
	unset($_POST['id']);
	$_POST['cpf'] = limpa_numero($_POST['cpf']);
	
	if (!valida_cpf($_POST['cpf'])) {
		die(json_encode(array('error'=>TRUE, 'type'=>'warning', 'msg'=>'CPF invalido.')));
	}else {
		$consulta_cpf = $cli->validaCpf($_POST['cpf']);
		if ($consulta_cpf) {
			die(json_encode(array('success'=>TRUE, 'type'=>'warning', 'msg'=>'Esse CPF já possui cadastro.')));
		}
	}
	
	$valida_email = $cli->validaEmail($_POST['email'], $_POST['cpf']);
	if ($valida_email) {
		die(json_encode(array('success'=>TRUE, 'type'=>'warning', 'msg'=>'Esse E-mail já possui cadastro.')));
	}		
		
	if(isset($_POST)){
		$_POST['senha'] = md5($_POST['senha']);		
		$add = $cli->add($_POST);		
		if ($add) {
			
			/*Chave de validação*/
			$chave = md5(date('d/m/Y H:i:s').$add);
			$validacao 	= new Validacao();
			$validade 	= $validacao->add(array('chave'=>$chave,
												'dt_validade'=>somar_data(2, 'd'),
												'id_clientes'=>$add
											   ));
			
			/*Criar a função para disparar e-mail de confirmação do cadastro com o link*/			
			
			
			if (isset($_SESSION['usuario'])) {
				$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Registro adiconado com sucesso.','id'=>$add);
				$app->redirect('/cliente-edit/'.$add.'/success/Registro adiconado com sucesso.', $retorno);
			} else {
				die(json_encode(array('success'=>TRUE, 'type'=>'success', 'msg'=>'Cadastro efetuado com sucesso, verifique seu e-mail que você receberá um link de confirmação.')));
			}
			
		} else {
			if (isset($_SESSION['usuario'])) {
				$app->render('clienteForm.php', array('acao'=>'add','aviso'=>array('type'=>'danger', 'msg'=>'Erro ao tentar cadastrar o cliente. '.$add)));
			} else {
				die(json_encode(array('error'=>TRUE, 'type'=>'danger', 'msg'=>'Erro ao fazer o cadastro tente novamente.')));
			}
						
		}
		
	}
		
});

$app->get('/clientes-edit/:id(/:type/:msg)', function($id, $type='', $msg='') use ($app){
	valida_logado();
	$cli = new Clientes();	
	$registro = $cli->loadId($id);
	if (isset($type) && isset($msg)) {
		$aviso = array('type'=>$type, 'msg'=>$msg);
	}else{
		$aviso = array();
	}
	$app->render('clienteForm.php',array('acao'=>'edit','data'=>$registro,'aviso'=>$aviso));	
});

$app->post('/clientes-edit', function() use ($app){
	valida_logado();
	
	$cli = new Clientes();
	
	if(isset($_POST)){
		
		$id = $_POST['id'];
		unset($_POST['id']);
		$where[':ID'] = $id;
		
		if (isset($_POST['senha_atual']) && $_POST['senha_atual']==$_POST['senha']) {
			$senha = $_POST['senha'];
			unset($_POST['senha']);
		} else {
			$_POST['senha'] = md5($_POST['senha']);
		}
		unset($_POST['senha_atual']);
		
		$edit = $cli->edit($_POST, $where);
		
		if ($edit) {
			
			$app->redirect(site_url().'/clientes-edit/'.$id.'/success/Registro alterado com sucesso.');		
		} else {
			$app->render('clientesForm.php',array('acao'=>'edit','aviso'=>array('type'=>'danger', 'msg'=>'Erro ao tentar alterar o cliente. '.$edit)));		
		}		
	}
	$app->render('clienteLst.php',array('lista'=>$lista,'retorno'=>$retorno));
});

$app->post('/cliente-add-arquivo', function() use ($app){
	valida_logado();
	
	if(isset($_POST)){
		
		if (isset($_FILES['arquivo_cliente']) && $_FILES['arquivo_cliente']['size']>0) {
			
			$ext = explode('.', $_FILES['arquivo_cliente']['name']);
			$ext = end($ext);
			
			if (in_array(strtolower($ext), extensoes_permitidos())) {
				
				$cli = new Cliente;				
				$id_usuarios 	= $_POST['id_usuarios'];
				$titulo 		= $_POST['titulo'];				
				$add = $cli->insertBlob($titulo, 
										$_FILES['arquivo_cliente']['type'], 
										$_FILES['arquivo_cliente']['size'], 
										$_FILES['arquivo_cliente']['tmp_name'], 
										'CLI-ARQ', 
										$id_usuarios);
				if ($add) {
					$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Arquivo salvo com sucesso.');
					$lista = $cli->load();		
				} else {
					$retorno = array('success'=>TRUE,'type'=>'danger','msg'=>'Erro ao salvar o arquivo ('.$add.').');		
				}
				unset($_POST);
				unset($_FILES);
				
			} else {
				$retorno = array('error'=>TRUE,'type'=>'warning','msg'=>'Extensões permitidas '.implode(', ', extensoes_permitidos()).'.');
			}
			
		} else {
			$retorno = array('erro'=>TRUE,'type'=>'warning','msg'=>'É necessário anexar um arquivo.');
		}
	}
			
	die(json_encode($retorno));
});

$app->post('/cliente-valida', function() use ($app){
	valida_logado();
	
	if(isset($_POST['email'])){
		
		$id_usuarios = (isset($_POST['id_usuarios'])?$_POST['id_usuarios']:'');
		
		$cli = new Cliente;
		$cliente = $cli->validaEmail(strtolower($_POST['email']),$id_usuarios);
		
		if ($cliente) {
			$retorno = array('error'=>TRUE,'type'=>'danger','msg'=>'Existe cliente cadastrado utilizando esse e-mail.');
		} else {
			$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'E-mail liberado.');
		}
		
	}
			
	die(json_encode($retorno));
});

$app->get('/cliente-del/:id', function($id) use ($app){
	valida_logado();
	
	$cli = new Clientes();	
	$cliente = $cli->loadId($id);
	
	if($id){
		$del = $cli->del(array(':ID'=>$id));
		if($del){
			
			//integracao
			$admin = new Admin();
			$adm = $admin->loadId($_SESSION['usuario']['id']);
			
			if (!empty($adm['chave']) && isset($cliente['id_cliente_rastreador'])) {
				$arr['chave'] 		= $adm['chave'];
				$arr['cliente_id']	= $cliente['id_cliente_rastreador'];
				
				$integracao = integracaoClienteExcluir($arr);
				$msg_integracao = $integracao['msg'];
				
			}
			
			$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Registro excluído com sucesso.');
		}else{
			$retorno = array('error'=>TRUE,'type'=>'danger','msg'=>'Erro ao excluir o registro ('.$del.')');
		}			
	}else{
		$retorno = array('error'=>TRUE,'type'=>'warning','msg'=>'Selecione um registro para ser deletado.');
	}
	$lista = $cli->load($_SESSION['usuario']['id']);
	$app->render('clienteLst.php',array('lista'=>$lista,'retorno'=>$retorno));

});

$app->post('/cliente-del-arquivo', function() use ($app){
	valida_logado();
	$cli = new Clientes();
	if(isset($_POST['id'])){
		$del = $cli->del_arquivo(array(':ID'=>$$_POST['id']));
		if($del){
			$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Registro excluído com sucesso.');
		}else{
			$retorno = array('error'=>TRUE,'type'=>'danger','msg'=>'Erro ao excluir o registro ('.$del.')');
		}			
	}else{
		$retorno = array('error'=>TRUE,'type'=>'warning','msg'=>'Selecione um registro para ser deletado.');
	}
	die(json_encode($retorno));
});

$app->get('/cliente-lista-arquivos/:usuario', function($usuario) use ($app){
	valida_logado();	
	$cliente = new Clientes();
	$lista 	 = $cliente->loadArquivos($usuario);
	$result = array();
	if($lista){
		foreach ($lista as $key => $value) {
			$tipo = '';
			if ($value['type']=='image/png' || $value['type']=='image/jpeg'){
				$tipo = '<span class="label label-warning">PNG</span>';			
			} else if ($value['type']=='application/pdf'){
				$tipo = '<span class="label label-warning">PDF</span>';
			}
			
			$acoes = '<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>			
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<a href="/dowload-arquivo/'.md5($value['id']).'" target="_blank" rel="download-arquivo" title="Download do arquivo">
											<i class="glyphicon glyphicon-cloud-download"></i> Download
										</a>
									</li>
									<!--
									<li>
										<a href="/visualiza-arquivo/'.md5($value['id']).'" target="_blank" rel="visualizar-arquivo" title="Visualizar o arquivo">
											<i class="glyphicon glyphicon-search"></i> Visualizar
										</a>
									</li>
									-->
									<li>
										<a href="'.$value['id'].'" rel="del-arquivo">
											<i class="glyphicon glyphicon-remove"></i> Excluir
										</a>
									</li>
								</ul>
							</li>
						</ul>';
					
			$result['data'][] = array($value['id'],
									  $value['dt_cadastro'],
									  $value['nome'],
							  		  '<span class="label label-default">'.By2M($value['size']).'</span>',
							  		  $tipo,
							  		  $acoes);
											  
		}
	}else{
		$result['data'][] = array('','','','','','');
	}		
		
	die(json_encode($result));
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

$app->post('/cliente-produto-add', function() use ($app){
	valida_logado();
	$cli = new Clientes();
	
	die(json_encode($_POST));
	
	if(isset($_POST)){
		//$add = $cli->(array(':ID'=>$$_POST['id']));
		if($del){
			$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Registro excluído com sucesso.');
		}else{
			$retorno = array('error'=>TRUE,'type'=>'danger','msg'=>'Erro ao excluir o registro ('.$del.')');
		}			
	}else{
		$retorno = array('error'=>TRUE,'type'=>'warning','msg'=>'Selecione um registro para ser deletado.');
	}
	die(json_encode($retorno));
});

$app->post('/clientes-receber-pagar-add', function() use ($app){
	valida_logado();
	
	$arr['nome'] 			= $_POST['nome'];
	$arr['email'] 			= $_POST['email'];
	$arr['tipo'] 			= $_POST['tipo_pessoa'];
	$arr['fg_sincronizar'] 	= 'N';
	$arr['status'] 			= 'A';
	$arr['id_usuarios'] 	= $_SESSION['usuario']['id'];
	$arr['id_categorias'] 	= (!empty($_POST['id_cli_categorias'])?$_POST['id_cli_categorias']:1);
	
	$cli = new Clientes();
	if(isset($_POST)){
		$add = $cli->add($arr);			
		if ($add) {
			$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Registro salvo com sucesso.');			
		} else {
			$retorno = array('error'=>TRUE,'type'=>'danger','msg'=>'Erro ao salvar o registro ('.$edit.').');			
		}
		unset($_POST);
	}	
	die(json_encode($retorno));
	
});
?>