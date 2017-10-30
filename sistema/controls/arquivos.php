<?php
$app->post('/arquivos-add', function() use ($app){
	valida_logado();
	
	if(isset($_POST) && isset($_FILES['arquivo']) && $_FILES['arquivo']['size']>0){
		
		$arr['nome'] 		= $_FILES['arquivo']['name'];
		$arr['tipo'] 		= $_FILES['arquivo']['type'];
		$arr['tamanho'] 	= $_FILES['arquivo']['size'];
		$arr['extensao'] 	= mb_strtolower(end(explode('.', $_FILES['arquivo']['name'])));
		$arr['descricao'] 	= $_POST['descricao'];
		$arr['arquivo'] 	= $_FILES['arquivo']['tmp_name'];
		$arr['periodo'] 	= $_POST['periodo'];
		$arr['id_clientes'] = $_POST['id_clientes'];
		$arr['observacao'] 	= $_POST['observacao'];
		$arr['chave'] 		= md5(date('dmYHis').$_POST['id_clientes']);
		$arr['enviado'] 	= $_SESSION['usuario']['perfil'];
		
		if (!in_array($arr['extensao'], extensoes_permitidos())) {
			die(json_encode(array('error'=>TRUE, 'type'=>'warning', 'msg'=>'Extensões permitidas '.implode(', ', extensoes_permitidos()).'.')));
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
									$arr['enviado']);
		
		if ($add) {
			die(json_encode(array('success'=>TRUE, 'type'=>'success', 'msg'=>'Arquivo salvo com sucesso.', 'id'=>$add)));		
		} else {
			die(json_encode(array('error'=>TRUE, 'type'=>'danger', 'msg'=>'Erro ao salvar o arquivo, tente novamente.')));
		}
	}
});

$app->get('/arquivos-del/:id', function($id='') use ($app){
	valida_logado();
	$arquivo = new Arquivos();	
	if(isset($id)){
		$del = $arquivo->del_arquivo(array(':ID'=>$id));
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

$app->get('/arquivos-lista/:id_clientes', function($id_clientes) use ($app){
	valida_logado();
	$arquivo = new Arquivos();
	$lista 	 = $arquivo->loadArquivos($id_clientes);
	$result = array();
	if($lista){
		foreach ($lista as $key => $value) {
			$tipo = '';
			if ($value['tipo']=='image/png' || $value['tipo']=='image/jpeg'){
				$tipo = 'icon-image2';			
			} else if ($value['tipo']=='application/pdf'){
				$tipo = 'icon-file-pdf';
			} else if ($value['tipo']=='application/zip' || $value['tipo']=='application/rar'){
				$tipo = 'icon-file-zip';
			} else if ($value['tipo']=='application/word'){
				$tipo = 'icon-file-word';
			} else if ($value['tipo']=='text/plain'){
				$tipo = 'icon-file-xml';
			} else{
				$tipo = 'icon-file-empty';
			}
			
			$acoes = '<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>			
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<a href="'.site_url().'/arquivos-dowload/'.md5($value['id']).'" target="_blank" rel="download-arquivo" title="Download do arquivo">
											<i class="glyphicon glyphicon-cloud-download"></i> Download
										</a>
									</li>
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
									  '<a href="#" title="'.$value['observacao'].'">'.$value['descricao'].'</a>',
									  '<i class="'.$tipo.'" title="'.$value['nome'].'"></i>',
							  		  '<span class="label label-default">'.By2M($value['tamanho']).'</span>',
							  		  $acoes);
											  
		}
	}else{
		$result['data'][] = array('','','Nenhum arquivo cadastrado','','','');
	}		
		
	die(json_encode($result));
});

$app->get('/arquivos-dowload/:id', function($id) use ($app){
	valida_logado();	
	$arquivos = new Arquivos();
	$arquivo = $arquivos->selectBlobMd5($id);
	
	header('Content-Description: File Transfer');
	header('Content-Disposition: attachment; filename="'.$arquivo['nome'].'"');
	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Expires: 0');
	// Envia o arquivo para o cliente
	//readfile(base64_encode($img['arquivo']));
	echo $arquivo['arquivo'];
	
});

$app->get('/arquivos-visualiza/:id', function($id) use ($app){
	valida_logado();	
	$arquivos = new Arquivos();
	$arquivo = $arquivos->selectBlobMd5($id);
	
	if ($img['type']=='image/png' || $img['type']=='image/jpeg') {
		echo '<img src="'.site_url().'/gerarArquivo.php?id='.$id.'">';
	}else{
		header("Content-Type: ".$arquivo['tipo']."");
		echo base64_decode($arquivo['arquivo']);
	}
	
});

$app->get('/arquivos/:id_clientes/:chave', function($id_clientes, $chave) use ($app){
	valida_logado();	
	$arquivos = new Arquivos();
	$arquivo = $arquivos->selectBlob($id_clientes, $chave);
	header("Content-Type:" . $arquivo['tipo']);
	echo $arquivo['arquivo'];
});

?>