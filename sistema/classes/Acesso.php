<?php
class Acesso extends Connection {
		
	public function usuarioAcesso($usuario, $senha){
		
		$conn = new Connection();
		
		$usuario = $conn->select("select * from (select a.id, a.nome, a.email, a.ativo, a.senha, 'A' as perfil
												   from tb_admin a
												 union
												 select c.id, c.nome, c.email, c.ativo, c.senha, 'C' as perfil
												   from tb_clientes c
											    ) a where a.email = :USUARIO and senha = :SENHA",array(':USUARIO'=>strtolower($usuario),':SENHA'=>md5($senha)));
			
		if (isset($usuario[0])) {
			$user = $usuario[0];
		} else {
			$user = FALSE;
		}
		
		return $user;
	}
	
}
?>