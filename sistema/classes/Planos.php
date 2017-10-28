<?php
Class Planos extends Connection{
		
	private $id;
	private $descricao;
	private $observacao;
	private $valor;
		
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
	public function setDescricao($value){
		$this->descricao = $value;
	}
	
	public function getObservacao(){
		return $this->observacao;
	}
	public function setObservacao($value){
		$this->observacao = $value;
	}
	
	public function getValor(){
		return $this->valor;
	}
	public function setValor($value){
		$valor = str_replace(',', '.', str_replace('.', '', $value));
		$this->valor = $valor;
	}
			
	public function setValues($values = array()){
		
		if(isset($values['id'])) 						$this->setId($values['id']);
		if(isset($values['descricao']))					$this->setDescricao($values['descricao']);
		if(isset($values['observacao']))				$this->setObservacao($values['observacao']);
		if(isset($values['valor']))		 				$this->setValor($values['valor']);
				
	}
	
	public function getValues(){
		
		if(!empty($this->getId())) 						$values['id'] 			 			= $this->getId();
		if(!empty($this->getDescricao()))				$values['descricao']				= $this->getDescricao();
		if(!empty($this->getObservacao()))				$values['observacao'] 	 			= $this->getObservacao();
		if(!empty($this->getValor()))	 				$values['valor'] 	 				= $this->getValor();
				
		return $values;
		
	}
	
	public function load(){
		$retorno = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT * FROM tb_planos WHERE ativo=:ATIVO ORDER BY descricao",array(':ATIVO'=>'S'));
		
		if (isset($result[0])) {
			$retorno = $result;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
	
	public function loadId($id){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_planos WHERE id = :ID", array(':ID'=>$id));
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
		$insert = $conn->insert('tb_planos', $arr);
		return $insert;
	}
	
	public function del($values=array()){
		$conn = new Connection();
		
		$delete = $conn->delete('tb_planos', $values);
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
		$edit = $conn->update('tb_planos', $arr, $where);
		
		return $edit;
	}
}
?>