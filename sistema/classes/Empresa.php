<?php
Class Empresa extends Connection{
		
	private $id;
	private $nome;
	private $email;
	private $saldo;
	private $titulo;
	private $smtp_email;
	private $smtp;
	private $smtp_porta;
	private $smtp_senha;
	private $id_usuarios;
	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getSaldo(){
		return $this->saldo;
	}
	public function setSaldo($saldo){
		$saldo = (!isset($saldo)?0:$saldo);
		$saldo = str_replace(',', '.', str_replace('.', '', $saldo));
		$this->saldo = $saldo;
	}
	
	public function getTitulo(){
		return $this->titulo;
	}
	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	
	public function getSmtpEmail(){
		return $this->smtp_email;
	}
	public function setSmtpEmail($value){
		$this->smtp_email = $value;
	}
	
	public function getSmtp(){
		return $this->smtp;
	}
	public function setSmtp($value){
		$this->smtp = $value;
	}
	
	public function getSmtpPorta(){
		return $this->smtp_porta;
	}
	public function setSmtpPorta($value){
		$this->smtp_porta = $value;
	}
	
	public function getSmtpSenha(){
		return $this->smtp_senha;
	}
	public function setSmtpSenha($value){
		$this->smtp_senha = $value;
	}
	
	public function getIdUsuarios(){
		return $this->id_usuarios;
	}
	public function setIdUsuarios($value){
		$this->id_usuarios = $value;
	}
	
	public function setValues($values = array()){
		$this->setNome($values['nome']);
		$this->setEmail($values['email']);
		$this->setTitulo($values['titulo']);
		$this->setSmtpEmail($values['smtp_email']);
		$this->setSmtp($values['smtp']);
		$this->setSmtpPorta($values['smtp_porta']);
		$this->setSmtpSenha($values['smtp_senha']);
		
		if(isset($values['saldo'])) 		$this->setSaldo($values['saldo']);
		if(isset($values['id_usuarios'])) 	$this->setIdUsuarios($values['id_usuarios']);
		
	}
	
	public function getValues(){
		$values['nome']			= $this->getNome();
		$values['email']		= $this->getEmail();
		$values['titulo']		= $this->getTitulo();
		$values['smtp_email']	= $this->getSmtpEmail();
		$values['smtp_porta']	= $this->getSmtpPorta();
		$values['smtp']			= $this->getSmtp();
		$values['smtp_senha']	= $this->getSmtpSenha();
		
		
		if(!empty($this->getSaldo())) 		$values['saldo']		= $this->getSaldo();
		if(!empty($this->getIdUsuarios()))  $values['id_usuarios']	= $this->getIdUsuarios();
		
		return $values;
	}
	
	
	public function carregaEmpresa(){
		$empresa = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT * FROM tb_empresa WHERE id = :ID;",array(
			":ID" => '1'
		));
		
		if (isset($result[0])) {
			$empresa = $result[0];
			/*
			$this->setId($empresa['id']);
			$this->setNome($empresa['nome']);
			$this->setEmail($empresa['email']);
			$this->setTitulo($empresa['titulo']);
			$this->setSaldo($empresa['saldo']);
			*/
		}else{
			$empresa = array();
		}		
		return $empresa;
	}
	
	public function loadId($id_usuarios){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_empresa WHERE id_usuarios = :ID_USUARIOS", array(':ID_USUARIOS'=>$id_usuarios));
		if (!empty($lista[0])) {
			$lista = $lista[0];
		} else {
			$lista = array('nome'=>'',
						   'email'=>'',
						   'titulo'=>'',
						   'saldo'=>'',
						   'smtp_email'=>'',
						   'smtp'=>'',
						   'smtp_porta'=>'',
						   'smtp_senha'=>'',
						   'id_usuarios'=>'');
		}
		
		return $lista;
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
		$insert = $conn->insert('tb_empresa', $arr);
		return $insert;
	}
	
	public function del($values=array()){
		$conn = new Connection();
		$delete = $conn->delete('tb_empresa', $values);
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
		$edit = $conn->update('tb_empresa', $arr, $where);
		return $edit;
	}	
	
}
?>