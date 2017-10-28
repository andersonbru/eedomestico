<?php
Class Funcionarios extends Connection{
		
	private $id;
	private $nome;
	private $rg;
	private $cpf;
	private $titulo_eleitor;
	private $dt_nascimento;
	private $dt_cadastro;
	private $id_clientes;
		
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
		
	public function getDtNascimento(){
		return $this->dt_nascimento;
	}
	public function setDtNascimento($dt){
		$this->dt_nascimento = dt_banco($dt);
	}
	
	public function getDtCadastro(){
		return $this->dt_cadastro;
	}
	public function setDtCadastro($dt_cadastro){
		$this->dt_cadastro = dt_banco($dt_cadastro);
	}
	
	public function getAtivo(){
		return $this->ativo;
	}
	public function setAtivo($value){
		$this->ativo = $value;
	}
	
	public function getIdClientes(){
		return $this->id_clientes;
	}
	public function setIdClientes($value){
		$this->id_clientes = $value;
	}	
		
	public function setValues($values = array()){
		
		if(isset($values['id'])) 						$this->setId($values['id']);
		if(isset($values['nome'])) 						$this->setNome($values['nome']);
		if(isset($values['rg'])) 						$this->setRg($values['rg']);
		if(isset($values['cpf']))	 					$this->setCpf($values['cpf']);
		if(isset($values['titulo_eleitor']))			$this->setTituloEleitor($values['titulo_eleitor']);
		if(isset($values['dt_nascimento'])) 			$this->setDtNascimento($values['dt_nascimento']);
		if(isset($values['dt_cadastro'])) 				$this->setDtCadastro($values['dt_cadastro']);
		if(isset($values['ativo']))						$this->setAtivo($values['ativo']);		
		if(isset($values['id_clientes'])) 				$this->setIdClientes($values['id_clientes']);
				
	}
	
	public function getValues(){
		
		if(!empty($this->getId())) 						$values['id'] 			 			= $this->getId();
		if(!empty($this->getNome())) 					$values['nome'] 					= $this->getNome();
		if(!empty($this->getRg())) 						$values['rg'] 						= $this->getRg();
		if(!empty($this->getCpf()))		 				$values['cpf']		 				= $this->getCpf();
		if(!empty($this->getTituloEleitor()))			$values['titulo_eleitor']			= $this->getTituloEleitor();
		if(!empty($this->getDtNascimento())) 			$values['dt_nascimento'] 			= $this->getDtNascimento();
		if(!empty($this->getDtCadastro())) 				$values['dt_cadastro'] 	 			= $this->getDtCadastro();
		if(!empty($this->getAtivo()))					$values['ativo']					= $this->getAtivo();
		if(!empty($this->getIdClientes())) 				$values['id_clientes'] 	 			= $this->getIdClientes();
				
		return $values;
		
	}
	
	public function load($id_clientes='', $ativo=''){
		$retorno = '';	
		$conn = new Connection();
		
		if (!empty($ativo)) {
			$result = $conn->select("SELECT * FROM tb_funcionarios WHERE id_clientes=:ID_CLIENTES AND ativo = :ATIVO ORDER BY nome;",array(':ATIVO'=>$ativo,':ID_CLIENTES'=>$id_clientes));
		} else {
			$result = $conn->select("SELECT * FROM tb_funcionarios WHERE id_clientes=:ID_CLIENTES ORDER BY nome;",array(':ID_CLIENTES'=>$id_clientes));
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
		$lista = $conn->select("SELECT f.id,
									   f.nome,
									   f.rg,
									   f.cpf,
									   f.titulo_eleitor,
									   DATE_FORMAT(f.dt_nascimento,'%d/%m/%Y') as dt_nascimento, 
									   DATE_FORMAT(f.dt_cadastro,'%d/%m/%Y %H:%i:%s') as dt_cadastro,
									   f.ativo,
									   f.id_clientes 
								  FROM tb_funcionarios f WHERE f.id = :ID", array(':ID'=>$id));
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
		$insert = $conn->insert('tb_funcionarios', $arr);
		return $insert;
	}
	
	public function del($values=array()){
		$conn = new Connection();
		
		/*Excluir das tabelas que tem relacionamento*/		
		
		$delete = $conn->delete('tb_funcionarios', $values);
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
		$edit = $conn->update('tb_funcionarios', $arr, $where);
		
		return $edit;
	}
	
}
?>