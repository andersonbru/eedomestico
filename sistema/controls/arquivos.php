<?php
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

?>