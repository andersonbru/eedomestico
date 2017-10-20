<?php
Class MenuUsuarios extends Connection{
		
	public function load($menu, $tipo){
		$retorno = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT * FROM tb_menu_usuarios WHERE id_menu = :MENU AND tipo=:TIPO;",array(
			":MENU" => $menu,
			":TIPO"=>$tipo
		));
		
		if (isset($result[0])) {
			$retorno = $result;			
		}else {
			$retorno = FALSE;
		}
		return $retorno;
	}	
	
	public function add($values=array()){
		$conn = new Connection();
		$insert = $conn->insert('tb_menu_usuarios',$values);
		if ($insert) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function delMenuUsuario($values=array()){
		$conn = new Connection();
		$delete = $conn->delete('tb_menu_usuarios', $values);
		return $delete;
	}
	
}
?>