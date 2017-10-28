<?php
Class Clientes extends Connection{
		
	private $id;
	private $nome;
	private $usuario;
	private $email;
	private $senha;
	private $id_nacionalidade;
	private $estado_civil;
	private $profissao;
	private $dt_nascimento;
	private $rg;
	private $cpf;
	private $titulo_eleitor;
	private $esocial;
	private $esocial_senha;
	private $ativo;
	private $dt_cadastro;
	private $dt_ativacao;
	private $id_planos;
		
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getNome(){
		return $this->nome;
	}
	public function setNome($value){
		$this->nome = $value;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
	public function setUsuario($value){
		$this->usuario = $value;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$email = strtolower($email);
		$this->email = $email;
	}
		
	public function getSenha(){
		return $this->senha;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getNacionalidade(){
		return $this->id_nacionalidade;
	}
	public function setNacionalidade($value){
		$this->id_nacionalidade = $value;
	}
	
	public function getEstadoCivil(){
		return $this->estado_civil;
	}
	public function setEstadoCivil($value){
		$this->estado_civil = $value;
	}
	
	public function getProfissao(){
		return $this->profissao;
	}
	public function setProfissao($value){
		$this->profissao = $value;
	}
		
	public function getDtNascimento(){
		return $this->dt_nascimento;
	}
	public function setDtNascimento($dt){
		$this->dt_nascimento = dt_banco($dt);
	}
	
	public function getRg(){
		return $this->rg;
	}
	public function setRg($value){
		$this->rg = $value;
	}
	
	public function getCpf(){
		return $this->cpf;
	}
	public function setCpf($cpf){
		$cpf = limpa_numero($cpf);
		$this->cpf = $cpf;
	}
	
	public function getTituloEleitor(){
		return $this->titulo_eleitor;
	}
	public function setTituloEleitor($value){
		$this->titulo_eleitor = $value;
	}
	
	public function getEsocial(){
		return $this->esocial;
	}
	public function setEsocial($value){
		$this->esocial = $value;
	}
	
	public function getEsocialSenha(){
		return $this->esocial_senha;
	}
	public function setEsocialSenha($value){
		$this->esocial_senha = $value;
	}
	
	public function getAtivo(){
		return $this->ativo;
	}
	public function setAtivo($value){
		$this->ativo = $value;
	}
	
	public function getDtCadastro(){
		return $this->dt_cadastro;
	}
	public function setDtCadastro($dt_cadastro){
		$this->dt_cadastro = dt_banco($dt_cadastro);
	}
	
	public function getDtAtivacao(){
		return $this->dt_ativacao;
	}
	public function setDtAtivacao($dt_ativacao){
		$this->dt_ativacao = dt_banco($dt_ativacao);
	}
	
	public function getIdPlanos(){
		return $this->id_planos;
	}
	public function setIdPlanos($value){
		$this->id_planos = $value;
	}
		
	public function setValues($values = array()){
		
		if(isset($values['id'])) 						$this->setId($values['id']);
		if(isset($values['nome'])) 						$this->setNome($values['nome']);
		if(isset($values['usuario'])) 					$this->setUsuario($values['usuario']);
		if(isset($values['email'])) 					$this->setEmail($values['email']);
		if(isset($values['senha'])) 					$this->setSenha($values['senha']);
		if(isset($values['id_nacionalidade']))			$this->setNacionalidade($values['id_nacionalidade']);
		if(isset($values['estado_civil']))				$this->setEstadoCivil($values['estado_civil']);
		if(isset($values['profissao']))					$this->setProfissao($values['profissao']);
		if(isset($values['dt_nascimento'])) 			$this->setDtNascimento($values['dt_nascimento']);
		if(isset($values['rg'])) 						$this->setRg($values['rg']);
		if(isset($values['cpf']))	 					$this->setCpf($values['cpf']);
		if(isset($values['titulo_eleitor']))			$this->setTituloEleitor($values['titulo_eleitor']);
		if(isset($values['esocial'])) 					$this->setEsocial($values['esocial']);
		if(isset($values['esocial_senha']))				$this->setEsocialSenha($values['esocial_senha']);
		if(isset($values['ativo']))						$this->setAtivo($values['ativo']);
		if(isset($values['dt_cadastro'])) 				$this->setDtCadastro($values['dt_cadastro']);
		if(isset($values['dt_ativacao'])) 				$this->setDtAtivacao($values['dt_ativacao']);
		if(isset($values['id_planos'])) 				$this->setIdPlanos($values['id_planos']);
				
	}
	
	public function getValues(){
		
		if(!empty($this->getId())) 						$values['id'] 			 			= $this->getId();
		if(!empty($this->getNome())) 					$values['nome'] 					= $this->getNome();
		if(!empty($this->getUsuario())) 				$values['usuario'] 					= $this->getUsuario();
		if(!empty($this->getEmail())) 					$values['email'] 					= $this->getEmail();
		if(!empty($this->getSenha())) 					$values['senha'] 					= $this->getSenha();
		if(!empty($this->getNacionalidade()))			$values['id_nacionalidade']			= $this->getNacionalidade();
		if(!empty($this->getEstadoCivil())) 			$values['estado_civil'] 			= $this->getEstadoCivil();
		if(!empty($this->getProfissao())) 				$values['profissao']				= $this->getProfissao();
		if(!empty($this->getDtNascimento())) 			$values['dt_nascimento'] 			= $this->getDtNascimento();
		if(!empty($this->getRg())) 						$values['rg'] 						= $this->getRg();
		if(!empty($this->getCpf()))		 				$values['cpf']		 				= $this->getCpf();
		if(!empty($this->getTituloEleitor()))			$values['titulo_eleitor']			= $this->getTituloEleitor();
		if(!empty($this->getEsocial()))					$values['esocial'] 					= $this->getEsocial();
		if(!empty($this->getEsocialSenha()))			$values['esocial_senha']			= $this->getEsocialSenha();
		if(!empty($this->getAtivo()))					$values['ativo']					= $this->getAtivo();
		if(!empty($this->getDtCadastro())) 				$values['dt_cadastro'] 	 			= $this->getDtCadastro();
		if(!empty($this->getDtAtivacao())) 				$values['dt_ativacao'] 	 			= $this->getDtAtivacao();
		if(!empty($this->getIdPlanos())) 				$values['id_planos'] 	 			= $this->getIdPlanos();
				
		return $values;
		
	}
	
	public function load($ativo=''){
		$retorno = '';	
		$conn = new Connection();
		
		if (!empty($status)) {
			$result = $conn->select("SELECT * FROM tb_clientes WHERE ativo = :ATIVO ORDER BY nome;",array(':ATIVO'=>$ativo));
		} else {
			$result = $conn->select("SELECT * FROM tb_clientes ORDER BY nome;",array());
		}	
		
		if (isset($result[0])) {
			$retorno = $result;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
	
	public function loadId($id){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_clientes WHERE id = :ID", array(':ID'=>$id));
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
		$insert = $conn->insert('tb_clientes', $arr);
		return $insert;
	}
	
	public function del($values=array()){
		$conn = new Connection();
		
		/*Excluir das tabelas que tem relacionamento*/		
		
		$delete = $conn->delete('tb_clientes', $values);
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
		$edit = $conn->update('tb_clientes', $arr, $where);
		
		return $edit;
	}
	
	/*
	public function qtdCliente(){
		$conn = new Connection();
		$result = $conn->select_exec("SELECT 
											(SELECT count(1) FROM tb_clientes WHERE ativo = 'S') AS ativo,
											(SELECT count(1) FROM tb_clientes WHERE ativo = 'N') AS inativo
									  from dual;");
		return $result[0]; 
	}
	*/
	
	//Classe de arquivos
	
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