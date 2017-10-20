<?php
class Contas extends Connection {
	private $id;
	private $agencia;
	private $conta;
	private $digito;
	private $tipo;
	private $obs;
	private $id_bancos;
	private $id_usuarios;
	private $tipo_pf_pj;
	private $dt_cadastro;
	private $cpf_cnpj;
	
	public function setId($id){
		$this->id = $id;
	}	
	public function getId(){
		return $this->id;
	}
	
	public function setAgencia($value){
		$this->agencia = $value;
	}	
	public function getAgencia(){
		return $this->agencia;
	}
	
	public function setConta($value){
		$this->conta = $value;
	}	
	public function getConta(){
		return $this->conta;
	}
	
	public function setDigito($value){
		$this->digito = $value;
	}	
	public function getDigito(){
		return $this->digito;
	}
	
	public function setTipo($value){
		$this->tipo = $value;
	}	
	public function getTipo(){
		return $this->tipo;
	}
	
	public function setObs($value){
		$this->obs = $value;
	}	
	public function getObs(){
		return $this->obs;
	}
	
	public function setIdBancos($value){
		$this->id_bancos = $value;
	}	
	public function getIdBancos(){
		return $this->id_bancos;
	}
	
	public function setIdUsuarios($value){
		$this->id_usuarios = $value;
	}	
	public function getIdUsuarios(){
		return $this->id_usuarios;
	}
	
	public function setTipoPfPj($value){
		$this->tipo_pf_pj = $value;
	}	
	public function getTipoPfPj(){
		return $this->tipo_pf_pj;
	}
	
	public function setDtCadastro($value){
		$this->dt_cadastro = $value;
	}	
	public function getDtCadastro(){
		return $this->dt_cadastro;
	}
	
	public function setCpfCnpj($value){
		$cpf_cnpj = limpa_numero($value);
		$this->cpf_cnpj = $cpf_cnpj;
	}	
	public function getCpfCnpj(){
		return $this->cpf_cnpj;
	}
	
	public function setValues($values = array()){
		
		$this->setAgencia($values['agencia']);
		$this->setConta($values['conta']);
		$this->setDigito($values['digito']);
		$this->setTipo($values['tipo']);
		$this->setIdBancos($values['id_bancos']);
		$this->setIdUsuarios($values['id_usuarios']);
		$this->setTipoPfPj($values['tipo_pf_pj']);
		$this->setCpfCnpj($values['cpf_cnpj']);
		
		if(isset($values['obs'])) $this->setobs($values['obs']);
		if(isset($values['id'])) $this->setId($values['id']);
		if(isset($values['dt_cadastro'])) $this->setDtCadastro($values['dt_cadastro']);
	}
	
	public function getValues(){
		$values['agencia'] 					= $this->getAgencia();
		$values['conta'] 					= $this->getConta();
		$values['digito'] 					= $this->getDigito();
		$values['cpf_cnpj'] 				= $this->getCpfCnpj();
		$values['tipo'] 					= $this->getTipo();
		$values['id_bancos'] 				= $this->getIdBancos();
		$values['id_usuarios']				= $this->getIdUsuarios();
		$values['tipo_pf_pj']				= $this->getTipoPfPj();
		
		if($this->getId()) $values['id'] = $this->getId();
		if($this->getObs()) $values['obs'] = $this->getObs();
		if($this->getDtCadastro()) $values['dt_cadastro'] = $this->getDtCadastro();
		
		if($this->getCpfCnpj()) $values['cpf_cnpj'] = $this->getCpfCnpj();
		
		return $values;
	}
	
	public function loadId($id){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_contas WHERE id = :ID", array(':ID'=>$id));
		return $lista[0];
	}
	
	public function load($usuario){
		$conn = new Connection();
		$lista = $conn->select("SELECT c.id,
									   c.agencia,
								       c.conta,
								       c.digito,
								       b.codigo as banco_cod,
								       b.nome as banco,
								       c.tipo,
								       c.tipo_pf_pj,
								       c.cpf_cnpj,
								       date_format(c.dt_cadastro, '%d/%m/%Y') as dt_cadastro								       
								FROM tb_contas c
								LEFT JOIN tb_bancos b on b.id = c.id_bancos 
								 WHERE c.id_usuarios = :USUARIO 
								 ORDER BY c.dt_cadastro", array(':USUARIO'=>$usuario));
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
		
		$insert = $conn->insert('tb_contas', $arr);
		return $insert;
	}
	
	public function del($values=array()){
		$conn = new Connection();
		$delete = $conn->delete('tb_contas', $values);
		return $delete;
	}
	
	public function edit($values=array(), $where = array()){
		
		$this->setValues($values);
		$arr = array();
		foreach ($this->getValues() as $key => $value) {
			if($value){
				$arr[':'.strtoupper($key)] = $value;
			}
		}
		
		$conn = new Connection();
		$edit = $conn->update('tb_contas', $arr, $where);
		return $edit;
	}
}
?>