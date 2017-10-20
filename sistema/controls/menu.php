<?php
$app->get('/menus', function() use ($app){
	valida_logado();
	$listaMenu = new Menu();
	$lista = $listaMenu->getList();
	
	$app->render('menuLst.php',array('listaDeMenu'=>$lista));
});

$app->get('/menu-del/:id', function($id) use ($app){
	valida_logado();
	$empresa = new Empresa();
	$data =  $empresa->carregaEmpresa();
	
	$menu = new Menu();	
	$lista = $menu->getList();
	
	if($id){		
		$values[':ID'] = $id;		
		$del = $menu->delMenu(array(':ID' => $id));
		if($del){
			$lista = $menu->getList();
			$app->render('menuLst.php',array('empresa'=>$data,'listaDeMenu'=>$lista,'retorno'=>array('success'=>TRUE,'type'=>'success','msg'=>'Registro excluído com sucesso.')));
		}else{
			$app->render('menuLst.php',array('empresa'=>$data,'listaDeMenu'=>$lista,'retorno'=>array('error'=>TRUE,'type'=>'danger','msg'=>'Erro ao excluir o registro ('.$del.')')));
		}			
	}else{
		$app->render('menuLst.php',array('empresa'=>$data,'listaDeMenu'=>$lista,'retorno'=>array('error'=>TRUE,'type'=>'warning','msg'=>'Selecione um registro para ser deletado.')));	
	}
});

$app->get('/menu-add', function() use ($app){
	valida_logado();
	$empresa = new Empresa();
	$data =  $empresa->carregaEmpresa();
	
	$app->render('menuForm.php',array('empresa'=>$data,'acao'=>'add'));
});

$app->post('/menu-add', function() use ($app){
	valida_logado();
	$empresa = new Empresa();
	$data =  $empresa->carregaEmpresa();
	
	$root_permissao = (isset($_POST['root'])?$_POST['root']:'');
	unset($_POST['root']);
	$admin_permissao = (isset($_POST['admin'])?$_POST['admin']:'');
	unset($_POST['admin']);
	$cliente_permissao = (isset($_POST['cliente'])?$_POST['cliente']:'');
	unset($_POST['cliente']);
	
	$tp_acesso = $_POST['tp_acesso'];
	
	$menu = new Menu();
	$lista = $menu->getList();
	
	$values = array();
	foreach ($_POST as $key => $value) {
		if($value){
			$values[':'.strtoupper($key)] = $value;
		}
	}
	unset($_POST);
	
	$add = $menu->addMenu($values);
	if ($add) {
		unset($values);		
		$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Registro adiconado com sucesso.');
		$lista = $menu->getList();
		
		if ($tp_acesso=='R') {
			//acessos.
			if ($root_permissao) {
				$menuUser = new MenuUsuarios();		
				$adm = array();
				foreach ($root_permissao as $key => $value) {
					if($value){
						$adm[':ID_USUARIO'] = $value;
						$adm[':ID_MENU'] = $add;
						$adm[':TIPO'] = 'R';
						$menuUser->add($adm);
					}
				}
			}
			
			if ($admin_permissao) {
				$menuUser = new MenuUsuarios();		
				$adm = array();
				foreach ($admin_permissao as $key => $value) {
					if($value){
						$adm[':ID_USUARIO'] = $value;
						$adm[':ID_MENU'] = $add;
						$adm[':TIPO'] = 'A';
						$menuUser->add($adm);
					}
				}
			}
			
			if ($cliente_permissao) {
				$menuUser = new MenuUsuarios();			
				$cli = array();
				foreach ($cliente_permissao as $key => $value) {
					if($value){
						$cli[':ID_USUARIO'] = $value;
						$cli[':ID_MENU'] = $add;
						$cli[':TIPO'] = 'C';
						$menuUser->add($cli);
					}
				}
			}
		}
							
	} else {
		$retorno = array('success'=>TRUE,'type'=>'danger','msg'=>'Erro ao criar o registro ('.$add.').');
		$app->render('menuLst.php',array('empresa'=>$data,'listaDeMenu'=>$lista,'retorno'=>$retorno));
	}
	
	$app->render('menuLst.php',array('empresa'=>$data,'listaDeMenu'=>$lista,'retorno'=>$retorno));
	
});

$app->get('/menu-edit/:id', function($id) use ($app){
	valida_logado();
	$empresa = new Empresa();
	$data =  $empresa->carregaEmpresa();
	
	$menu = new Menu();
	
	$setMenu = $menu->getCarregaId($id);
	
	$app->render('menuForm.php',array('empresa'=>$data,'acao'=>'edit','setMenu'=>$setMenu));
	
});

$app->post('/menu-edit', function() use ($app){
	valida_logado();
	
	$id = $_POST['id'];
	unset($_POST['id']);
	$where[':ID'] = $id;
	
	$root_permissao = (isset($_POST['root'])?$_POST['root']:'');
	unset($_POST['root']);
	$admin_permissao = (isset($_POST['admin'])?$_POST['admin']:'');
	unset($_POST['admin']);
	$cliente_permissao = (isset($_POST['cliente'])?$_POST['cliente']:'');
	unset($_POST['cliente']);
	
	$tp_acesso = $_POST['tp_acesso'];
	
	$empresa = new Empresa();
	$data =  $empresa->carregaEmpresa();
	
	$menu = new Menu();	
	$lista = $menu->getList();
	
	$values = array();
	foreach ($_POST as $key => $value) {
		if($value){
			$values[':'.strtoupper($key)] = $value;
		}
	}	
	$edit = $menu->editMenu($values, $where);
	if ($edit) {
		$retorno = array('success'=>TRUE,'type'=>'success','msg'=>'Registro ALTERADO com sucesso.');
		$lista = $menu->getList();
		
		if ($tp_acesso=='R') {
			
			//acessos.
			if ($root_permissao) {
				$menuUser = new MenuUsuarios();			
				//deleta as permissões para o menu
				$menuUser->delMenuUsuario(array(':ID_MENU'=>$id, ':TIPO'=>'R'));					
				$adm = array();
				foreach ($root_permissao as $key => $value) {
					if($value){
						$adm[':ID_USUARIO'] = $value;
						$adm[':ID_MENU'] = $id;
						$adm[':TIPO'] = 'R';
						$menuUser->add($adm);
					}
				}
			}
			
			if ($admin_permissao) {
				$menuUser = new MenuUsuarios();			
				//deleta as permissões para o menu
				$menuUser->delMenuUsuario(array(':ID_MENU'=>$id, ':TIPO'=>'A'));					
				$adm = array();
				foreach ($admin_permissao as $key => $value) {
					if($value){
						$adm[':ID_USUARIO'] = $value;
						$adm[':ID_MENU'] = $id;
						$adm[':TIPO'] = 'A';
						$menuUser->add($adm);
					}
				}
			}
			
			if ($cliente_permissao) {
				$menuUser = new MenuUsuarios();			
				//deleta as permissões para o menu
				$menuUser->delMenuUsuario(array(':ID_MENU'=>$id, ':TIPO'=>'C'));					
				$cli = array();
				foreach ($cliente_permissao as $key => $value) {
					if($value){
						$cli[':ID_USUARIO'] = $value;
						$cli[':ID_MENU'] = $id;
						$cli[':TIPO'] = 'C';
						$menuUser->add($cli);
					}
				}
			}
				
		}
			
	} else {
		$retorno = array('success'=>TRUE,'type'=>'danger','msg'=>'Erro ao ALTERAR o registro ('.$add.').');
		$app->render('menuLst.php',array('empresa'=>$data,'listaDeMenu'=>$lista,'retorno'=>$retorno));
	}	
	$app->render('menuLst.php',array('empresa'=>$data,'listaDeMenu'=>$lista,'retorno'=>$retorno));
});

?>