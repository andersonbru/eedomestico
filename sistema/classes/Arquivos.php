<?php
Class Arquivos extends Connection{
		
	private $id;
	private $nome;
	private $type;
	private $size;
	private $arquivo;
	private $chave;
	private $id_usuarios;
	private $dt_cadastro;
		
	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id = $value;
	}
	
	public function getNome(){
		return $this->nome;
	}
	public function setNome($value){
		$this->nome = $value;
	}
		
	public function getType(){
		return $this->type;
	}
	public function setType($value){
		$this->type = $value;
	}
	
	public function getSize(){
		return $this->size;
	}
	public function setSize($value){
		$this->size = $value;
	}
	
	public function getArquivo(){
		return $this->arquivo;
	}
	public function setArquivo($value){
		$this->arquivo = $value;
	}
	
	public function getChave(){
		return $this->chave;
	}
	public function setChave($value){
		$this->chave = $value;
	}
	
	public function getIdUsuarios(){
		return $this->id_usuarios;
	}
	public function setIdUsuarios($value){
		$this->id_usuarios = $value;
	}
	
	public function getDtCadastro(){
		return $this->dt_cadastro;
	}
	public function setDtCadastro($dt_cadastro){
		$this->dt_cadastro = $dt_cadastro;
	}
	
	public function setValues($values = array()){
		
		$this->setNome($values['nome']);
		$this->setType($values['type']);
		$this->setSize($values['size']);
		$this->setArquivo($values['arquivo']);
		$this->setChave($values['chave']);
		$this->setIdUsuarios($values['id_usuarios']);
		
		if(isset($values['dt_cadastro'])) $this->setDtCadastro($values['dt_cadastro']);
	}
	
	public function getValues(){
		$values['nome'] 	= $this->getNome();
		$values['type'] 	= $this->getType();
		$values['size'] 	= $this->getSize();
		$values['arquivo'] 	= $this->getArquivo();
		$values['chave'] 	= $this->getChave();
		
		if(!empty($this->getDtCadastro())) 		$values['dt_cadastro'] 	 = $this->getDtCadastro();
		
		return $values;
		
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
	
}
?>