<?php
$app->post('/login', function() use ($app){
	
	$retorno = array();
	if(!$_POST['usuario'] || !$_POST['senha']){
		$retorno = array('tipo'=>'danger','msg'=>'informar o usuário e senha');
		$pagina  = 'login.php';
	}else{
		$user = new Acesso();
		$usuario = $user->usuarioAcesso($_POST['usuario'], $_POST['senha']);
		
		if($usuario){
			if($usuario['ativo']=='S'){
				
				$_SESSION['usuario']  = $usuario;
				//$pagina 			  = 'principal.php'; 	
				$app->redirect('principal');		
			}else{
				$retorno 	= array('tipo'=>'danger','msg'=>'Usuário inativo, entre em contato com o administrador do sistema.');
				$pagina 	= 'login.php';
				$app->render($pagina, array('retorno'=>$retorno));
			}
		}else{
			$retorno 	= array('tipo'=>'danger','msg'=>'Usuário não localizado.');
			$pagina 	= 'login.php';
			$app->render($pagina, array('retorno'=>$retorno));
		}	
	}
});
