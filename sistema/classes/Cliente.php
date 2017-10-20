<?php
Class Cliente extends Connection{
		
	private $id;
	private $nome;
	private $senha;
	private $email;
	private $cpf_cnpj;
	private $nome_fantasia;
	private $tipo;
	private $logradouro;
	private $numero;
	private $bairro;
	private $complemento;
	private $cep;
	private $cidade;
	private $estado;
	private $status;
	private $ibge;
	private $dt_cadastro;	
	private $celular;
	private $tel_comercial;
	private $tel_outros;
	private $dt_nascimento;
	private $id_usuarios;
	private $id_cliente_rastreador;
	private $rg;
	private $usuario;
	private $dica_senha;
	private $fg_sincronizar;
	private $observacao;
		
	public function getId(){
		return $this->id();
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
		
	public function getSenha(){
		return $this->senha;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$email = strtolower($email);
		$this->email = $email;
	}
	
	public function getCpf_Cnpj(){
		return $this->cpf_cnpj;
	}
	public function setCpf_Cnpj($cpf_cnpj){
		$cpf_cnpj = limpa_numero($cpf_cnpj);
		$this->cpf_cnpj = $cpf_cnpj;
	}
	
	public function getNomeFantasia(){
		return $this->nome_fantasia;
	}
	public function setNomeFantasia($nome_fantasia){
		$this->nome_fantasia = $nome_fantasia;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function getLogradouro(){
		return $this->logradouro;
	}
	public function setLogradouro($logradouro){
		$this->logradouro = $logradouro;
	}
	
	public function getNumero(){
		return $this->numero;
	}
	public function setNumero($numero){
		$this->numero = $numero;
	}
	
	public function getBairro(){
		return $this->bairro;
	}
	public function setBairro($bairro){
		$this->bairro = $bairro;
	}
	
	public function getComplemento(){
		return $this->complemento;
	}
	public function setComlemento($complemento){
		$this->complemento = $complemento;
	}
	
	public function getCep(){
		return $this->cep;
	}
	public function setCep($cep){
		$cep = limpa_numero($cep);
		$this->cep = $cep;
	}
	
	public function getCidade(){
		return $this->cidade;
	}
	public function setCidade($cidade){
		$this->cidade = $cidade;
	}
	
	public function getEstado(){
		return $this->estado;
	}
	public function setEstado($estado){
		$this->estado = $estado;
	}
	
	public function getStatus(){
		return $this->status;
	}
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getIbge(){
		return $this->ibge;
	}
	public function setIbge($ibge){
		$this->ibge = $ibge;
	}
	
	public function getDtCadastro(){
		return $this->dt_cadastro;
	}
	public function setDtCadastro($dt_cadastro){
		$this->dt_cadastro = $dt_cadastro;
	}
	
	public function getCelular(){
		return $this->celular;
	}
	public function setCelular($celular){
		$this->celular = limpa_numero($celular);
	}
	
	public function getTelComercial(){
		return $this->tel_comercial;
	}
	public function setTelComercial($num){
		$this->tel_comercial = limpa_numero($num);
	}
	
	public function getTelOutros(){
		return $this->tel_outros;
	}
	public function setTelOutros($num){
		$this->tel_outros = limpa_numero($num);
	}
	
	public function getDtNascimento(){
		return $this->dt_nascimento;
	}
	public function setDtNascimento($dt){
		$this->dt_nascimento = dt_banco($dt);
	}
	
	public function getIdUsuarios(){
		return $this->id_usuarios;
	}
	public function setIdUsuarios($value){
		$this->id_usuarios = $value;
	}
	
	public function getIdClienteRastreador(){
		return $this->id_cliente_rastreador;
	}
	public function setIdClienteRastreador($value){
		$this->id_cliente_rastreador = $value;
	}
	
	public function getRg(){
		return $this->rg;
	}
	public function setRg($value){
		$this->rg = $value;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
	public function setUsuario($value){
		$this->usuario = $value;
	}
	
	public function getDicaSenha(){
		return $this->dica_senha;
	}
	public function setDicaSenha($value){
		$this->dica_senha = $value;
	}
	
	public function getFgSincronizar(){
		return $this->fg_sincronizar;
	}
	public function setFgSincronizar($value){
		$this->fg_sincronizar = $value;
	}
	
	public function getObservacao(){
		return $this->observacao;
	}
	public function setObservacao($value){
		$this->observacao = $value;
	}
	
	public function setValues($values = array()){
		
		if(isset($values['nome'])) 						$this->setNome($values['nome']);
		if(isset($values['email'])) 					$this->setEmail($values['email']);
		if(isset($values['cpf_cnpj'])) 					$this->setCpf_Cnpj($values['cpf_cnpj']);
		if(isset($values['tipo'])) 						$this->setTipo($values['tipo']);
		if(isset($values['logradouro'])) 				$this->setLogradouro($values['logradouro']);
		if(isset($values['numero'])) 					$this->setNumero($values['numero']);
		if(isset($values['bairro'])) 					$this->setBairro($values['bairro']);
		if(isset($values['cep'])) 						$this->setCep($values['cep']);
		if(isset($values['cidade'])) 					$this->setCidade($values['cidade']);
		if(isset($values['estado'])) 					$this->setEstado($values['estado']);
		if(isset($values['ibge'])) 						$this->setIbge($values['ibge']);
		if(isset($values['celular'])) 					$this->setCelular($values['celular']);
		if(isset($values['status']))					$this->setStatus($values['status']);		
		if(isset($values['dt_cadastro'])) 				$this->setDtCadastro($values['dt_cadastro']);
		if(isset($values['id'])) 						$this->setId($values['id']);
		if(isset($values['nome_fantasia'])) 			$this->setNomeFantasia($values['nome_fantasia']);
		if(isset($values['senha'])) 					$this->setSenha($values['senha']);
		if(isset($values['tel_comercial'])) 			$this->setTelComercial($values['tel_comercial']);
		if(isset($values['tel_outros'])) 				$this->setTelOutros($values['tel_outros']);
		if(isset($values['complemento'])) 				$this->setComlemento($values['complemento']);
		if(isset($values['dt_nascimento'])) 			$this->setDtNascimento($values['dt_nascimento']);
		if(isset($values['id_usuarios'])) 				$this->setIdUsuarios($values['id_usuarios']);
		if(isset($values['id_cliente_rastreador'])) 	$this->setIdClienteRastreador($values['id_cliente_rastreador']);
		if(isset($values['rg'])) 						$this->setRg($values['rg']);
		if(isset($values['usuario'])) 					$this->setUsuario($values['usuario']);
		if(isset($values['dica_senha'])) 				$this->setDicaSenha($values['dica_senha']);
		if(isset($values['fg_sincronizar']))			$this->setFgSincronizar($values['fg_sincronizar']);
		if(isset($values['observacao']))				$this->setObservacao($values['observacao']);
		
	}
	
	public function getValues(){
		if(!empty($this->getNome())) 					$values['nome'] 					= $this->getNome();
		if(!empty($this->getSenha())) 					$values['senha'] 					= $this->getSenha();
		if(!empty($this->getEmail())) 					$values['email'] 					= $this->getEmail();
		if(!empty($this->getCpf_Cnpj())) 				$values['cpf_cnpj'] 				= $this->getCpf_Cnpj();
		if(!empty($this->getTipo())) 					$values['tipo'] 					= $this->getTipo();
		if(!empty($this->getLogradouro())) 				$values['logradouro'] 				= $this->getLogradouro();
		if(!empty($this->getNumero())) 					$values['numero'] 					= $this->getNumero();
		if(!empty($this->getBairro())) 					$values['bairro'] 					= $this->getBairro();
		if(!empty($this->getCep())) 					$values['cep'] 						= $this->getCep();
		if(!empty($this->getCidade())) 					$values['cidade'] 					= $this->getCidade();
		if(!empty($this->getEstado())) 					$values['estado'] 					= $this->getEstado();
		if(!empty($this->getIbge())) 					$values['ibge'] 					= $this->getIbge();
		if(!empty($this->getCelular())) 				$values['celular'] 					= $this->getCelular();
		if(!empty($this->getStatus())) 					$values['status'] 					= $this->getStatus();		
		if(!empty($this->getDtCadastro())) 				$values['dt_cadastro'] 	 			= $this->getDtCadastro();
		//if(!empty($this->getId())) 				$values['id'] 			 		= $this->getId();
		if(!empty($this->getNomeFantasia())) 			$values['nome_fantasia'] 			= $this->getNomeFantasia();
		if(!empty($this->getTelComercial())) 			$values['tel_comercial'] 			= $this->getTelComercial();
		if(!empty($this->getTelOutros())) 				$values['tel_outros'] 	 			= $this->getTelOutros();
		if(!empty($this->getComplemento())) 			$values['complemento'] 	 			= $this->getComplemento();
		if(!empty($this->getDtNascimento())) 			$values['dt_nascimento'] 			= $this->getDtNascimento();
		if(!empty($this->getIdUsuarios())) 				$values['id_usuarios'] 				= $this->getIdUsuarios();
		if(!empty($this->getIdClienteRastreador())) 	$values['id_cliente_rastreador'] 	= $this->getIdClienteRastreador();
		if(!empty($this->getRg())) 						$values['rg'] 						= $this->getRg();
		if(!empty($this->getUsuario())) 				$values['usuario'] 					= $this->getUsuario();
		if(!empty($this->getDicaSenha())) 				$values['dica_senha'] 				= $this->getDicaSenha();
		if(!empty($this->getFgSincronizar()))			$values['fg_sincronizar']			= $this->getFgSincronizar();
		if(!empty($this->getObservacao()))				$values['observacao']				= $this->getObservacao();
		
		return $values;
		
	}
	
	public function load($id_usuarios=''){
		$retorno = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT * FROM tb_clientes WHERE id_usuarios = :ID_USUARIOS;",array(
			":ID_USUARIOS"=>$id_usuarios
		));
		
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
	
	public function validaEmail($email, $id_usuarios=''){
		$retorno = '';	
		$conn = new Connection();
		
		if (isset($id_usuarios)) {
			
			$result = $conn->select("SELECT * FROM tb_clientes WHERE email = :EMAIL and id <> :ID_USUARIOS;",array(
				":EMAIL" => $email,
				":ID_USUARIOS"=>$id_usuarios
			));
			
		} else {
			$result = $conn->select("SELECT * FROM tb_clientes WHERE email = :EMAIL;",array(
				":EMAIL" => $email
			));
		}			
		
		if (isset($result[0])) {
			$retorno = $result;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
}
?>