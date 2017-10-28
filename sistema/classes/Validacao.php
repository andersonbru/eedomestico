<?php
Class Validacao extends Connection{
		
	private $id;
	private $chave;
	private $dt_cadastro;
	private $dt_validade;
	private $id_clientes;
		
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getChave(){
		return $this->chave;
	}
	public function setChave($value){
		$this->chave = $value;
	}
	
	public function getDtCadastro(){
		return $this->dt_cadastro;
	}
	public function setDtCadastro($value){
		$this->dt_cadastro = dt_banco($value);
	}
	
	public function getDtValidade(){
		return $this->dt_validade;
	}
	public function setDtValidade($value){
		$this->dt_validade = $value;
	}
	
	public function getIdClientes(){
		return $this->id_clientes;
	}
	public function setIdClientes($value){
		$this->id_clientes = $value;
	}
		
	public function setValues($values = array()){
		
		if(isset($values['id'])) 						$this->setId($values['id']);
		if(isset($values['chave']))						$this->setChave($values['chave']);
		if(isset($values['dt_cadastro'])) 				$this->setDtCadastro($values['dt_cadastro']);
		if(isset($values['dt_validade'])) 				$this->setDtValidade($values['dt_validade']);
		if(isset($values['id_clientes'])) 				$this->setIdClientes($values['id_clientes']);
				
	}
	
	public function getValues(){
		
		if(!empty($this->getId())) 						$values['id'] 			 			= $this->getId();
		if(!empty($this->getChave())) 					$values['chave'] 					= $this->getChave();
		if(!empty($this->getDtCadastro())) 				$values['dt_cadastro'] 	 			= $this->getDtCadastro();
		if(!empty($this->getDtValidade())) 				$values['dt_validade'] 	 			= $this->getDtValidade();
		if(!empty($this->getIdClientes())) 				$values['id_clientes'] 	 			= $this->getIdClientes();
				
		return $values;
		
	}
	
	public function load($chave){
		$retorno = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT * FROM tb_validacao WHERE chave = :CHAVE;",array(":CHAVE"=>$chave));
		
		if (isset($result[0])) {
			$retorno = $result[0];
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
	
	public function loadId($id){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_validacao WHERE id = :ID", array(':ID'=>$id));
		return $lista[0];
	}
	
	public function add($values=array()){
		$conn = new Connection();
		$this->setValues($values);
		$arr = array();
		
		foreach ($this->getValues() as $key => $value) {
			if($value){
				$arr[':'.strtoupper($key)] = $value;
			}
		}
		$insert = $conn->insert('tb_validacao', $arr);
		return $insert;
	}
	
	public function del($values=array()){
		$conn = new Connection();
		
		$delete = $conn->delete('tb_validacao', $values);
		return $delete;
	}
	
	public function edit($values=array(), $where = array()){
		$conn = new Connection();
		$this->setValues($values);
		$arr = array();
		foreach ($this->getValues() as $key => $value) {
			if($value){
				$arr[':'.strtoupper($key)] = $value;
			}
		}		
		$edit = $conn->update('tb_validacao', $arr, $where);
		
		return $edit;
	}
	
	public function insertBlob($nome, $type, $size, $arquivo, $chave, $id_usuario) {
		$conn = new Connection();
		$arq = $conn->insertBlob($nome, $type, $size, $arquivo, $chave, $id_usuario);
        return $arq;
    }
	
	public function updateBlob($id, $nome, $type, $size, $arquivo, $chave, $id_usuario) {
		$conn = new Connection();
		$arq = $conn->updateBlob($id, $nome, $type, $size, $arquivo, $chave, $id_usuario);
        return $arq;
    }
	
	public function selectBlob($id_usuario, $chave) {
		$conn = new Connection();
		$arq = $conn->selectBlob($id_usuario, $chave);
        return $arq;
    }
	
	public function selectBlobMd5($id) {
		$conn = new Connection();
		$arq = $conn->selectBlobMd5($id);
        return $arq;
    }
	
	public function loadArquivos($usuario){
		$retorno = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT a.id,
									    a.nome,
								        a.type,
								        a.size,
								        date_format(a.dt_cadastro,'%d/%m/%Y') as dt_cadastro,
								        if(a.arquivo is not null, 1, 0) as fg_arquivo
								   FROM tb_arquivos a 
								  WHERE a.id_usuarios = :USUARIO;",array(
			":USUARIO" => $usuario
		));
		
		if (isset($result[0])) {
			$retorno = $result;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
	
	public function del_arquivo($values=array()){
		$conn = new Connection();		
		$delete = $conn->delete('tb_arquivos', $values);
		return $delete;
	}
	
	public function validaEmail($email){
		$retorno = '';	
		$conn = new Connection();
		
		if (isset($cpf)) {
			
			$result = $conn->select("SELECT * FROM tb_clientes WHERE email = :EMAIL",array(
				":EMAIL" => $email
			));
			
		} else {
			$result = $conn->select("SELECT * FROM tb_clientes WHERE email = :EMAIL;",array(
				":EMAIL" => $email
			));
		}			
		
		if (isset($result[0])) {
			$retorno = TRUE;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
	
	public function validaCpf($cpf=''){
		$retorno = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT * FROM tb_clientes WHERE cpf = :CPF;",array(
			":CPF"=>$cpf
		));
		
		if (isset($result[0])) {
			$retorno = TRUE;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
}
?>