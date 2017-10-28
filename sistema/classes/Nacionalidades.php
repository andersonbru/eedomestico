<?php
Class Nacionalidades extends Connection{
		
	private $id;
	private $descricao;
		
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
			
	public function setValues($values = array()){
		
		if(isset($values['id'])) 						$this->setId($values['id']);
		if(isset($values['descricao']))					$this->setDescricao($values['descricao']);		
				
	}
	
	public function getValues(){
		
		if(!empty($this->getId())) 						$values['id'] 			 			= $this->getId();
		if(!empty($this->getDescricao()))				$values['descricao']				= $this->getDescricao();
				
		return $values;
		
	}
	
	public function load(){
		$retorno = '';	
		$conn = new Connection();
		
		$result = $conn->select("SELECT * FROM tb_nacionalidades ORDER BY descricao",array());
		
		if (isset($result[0])) {
			$retorno = $result;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
	
	public function loadId($id){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_nacionalidades WHERE id = :ID", array(':ID'=>$id));
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
		$insert = $conn->insert('tb_nacionalidades', $arr);
		return $insert;
	}
	
	public function del($values=array()){
		$conn = new Connection();
		
		$delete = $conn->delete('tb_nacionalidades', $values);
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
		$edit = $conn->update('tb_nacionalidades', $arr, $where);
		
		return $edit;
	}
}
?>