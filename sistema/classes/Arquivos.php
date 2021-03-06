<?php
Class Arquivos extends Connection{
		
	private $id;
	private $nome;
	private $tipo;
	private $tamanho;
	private $extensao;
	private $descricao;
	private $arquivo;
	private $dt_cadastro;
	private $periodo;
	private $id_clientes;
	private $observacao;
	private $chave;
	private $enviado;
	private $id_funcionarios;
	private $id_categorias; 
		
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
		
	public function getTipo(){
		return $this->tipo;
	}
	public function setTipo($value){
		$this->tipo = $value;
	}
	
	public function getTamanho(){
		return $this->tamanho;
	}
	public function setTamanho($value){
		$this->tamanho = $value;
	}
	
	public function getExtensao(){
		return $this->extensao;
	}
	public function setExtensao($value){
		$this->extensao = $value;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
	public function setDescricao($value){
		$this->descricao = $value;
	}
	
	public function getArquivo(){
		return $this->arquivo;
	}
	public function setArquivo($value){
		$this->arquivo = $value;
	}
	
	public function getDtCadastro(){
		return $this->dt_cadastro;
	}
	public function setDtCadastro($dt_cadastro){
		$this->dt_cadastro = $dt_cadastro;
	}
	
	public function getPeriodo(){
		return $this->periodo;
	}
	public function setPeriodo($value){
		$this->periodo = $value;
	}
		
	public function getIdClientes(){
		return $this->id_clientes;
	}
	public function setIdClientes($value){
		$this->id_clientes = $value;
	}
	
	public function getObservacao(){
		return $this->observacao;
	}
	public function setObservacao($value){
		$this->observacao = $value;
	}
	
	public function getChave(){
		return $this->chave;
	}
	public function setChave($value){
		$this->chave = $value;
	}
	
	public function getEnviado(){
		return $this->enviado;
	}
	public function setEnviado($value){
		$this->enviado = $value;
	}
	
	public function getIdFuncionarios(){
		return $this->id_funcionarios;
	}
	public function setIdFuncionarios($value){
		$this->id_funcionarios = $value;
	}
	
	public function getIdCategorias(){
		return $this->id_categorias;
	}
	public function setIdCategorias($value){
		$this->id_categorias = $value;
	}
	
	public function setValues($values = array()){
		
		if(isset($values['id'])) 						$this->setId($values['id']);
		if(isset($values['nome'])) 						$this->setNome($values['nome']);
		if(isset($values['tipo'])) 						$this->setTipo($values['tipo']);
		if(isset($values['tamanho']))					$this->setTamanho($values['tamanho']);
		if(isset($values['extensao']))					$this->setExtensao($values['extensao']);
		if(isset($values['descricao']))					$this->setDescricao($values['descricao']);
		if(isset($values['arquivo'])) 					$this->setArquivo($values['arquivo']);
		if(isset($values['dt_cadastro']))				$this->setDtCadastro($values['dt_cadastro']);
		if(isset($values['periodo']))					$this->setPeriodo($values['periodo']);
		if(isset($values['id_clientes'])) 				$this->setIdClientes($values['id_clientes']);
		if(isset($values['observacao'])) 				$this->setObservacao($values['observacao']);	
		if(isset($values['chave']))		 				$this->setChave($values['chave']);
		if(isset($values['enviado']))	 				$this->setEnviado($values['enviado']);
		if(isset($values['id_funcionarios']))			$this->setIdFuncionarios($values['id_funcionarios']);
		if(isset($values['id_categorias']))				$this->setIdCategorias($values['id_categorias']);
		
	}
	
	public function getValues(){
		
		if(!empty($this->getId())) 						$values['id'] 			 			= $this->getId();
		if(!empty($this->getNome()))					$values['nome']			 			= $this->getNome();
		if(!empty($this->getTipo())) 					$values['tipo']			 			= $this->getTipo();
		if(!empty($this->getTamanho()))					$values['tamanho']		 			= $this->getTamanho();
		if(!empty($this->getExtensao()))				$values['extensao']		 			= $this->getExtensao();
		if(!empty($this->getDescricao()))				$values['descricao']	 			= $this->getDescricao();
		if(!empty($this->getArquivo()))					$values['arquivo'] 		 			= $this->getArquivo();
		if(!empty($this->getDtCadastro()))				$values['dt_cadastro']	 			= $this->getDtCadastro();
		if(!empty($this->getPeriodo()))					$values['periodo']		 			= $this->getPeriodo();
		if(!empty($this->getIdClientes()))				$values['id_clientes']	 			= $this->getIdClientes();
		if(!empty($this->getObservacao()))				$values['observacao']	 			= $this->getObservacao();
		if(!empty($this->getChave))						$values['chave']		 			= $this->getChave();
		if(!empty($this->getEnviado()))					$values['enviado']		 			= $this->getEnviado();
		if(!empty($this->getIdFuncionarios()))			$values['id_funcionarios'] 			= $this->getIdFuncionarios();
		if(!empty($this->getIdCategorias()))			$values['id_categorias'] 			= $this->getIdCategorias();
		
		return $values;
		
	}
	
	public function insertBlob($nome, $tipo, $tamanho, $extensao, $descricao, $arquivo, $periodo, $id_clientes, $observacao, $chave, $enviado, $id_funcionarios, $id_categorias) {
		$conn = new Connection();
		$arq = $conn->insertBlob($nome, $tipo, $tamanho, $extensao, $descricao, $arquivo, $periodo, $id_clientes, $observacao, $chave, $enviado, $id_funcionarios, $id_categorias);
        return $arq;
    }
	
	public function updateBlob($id, $nome, $tipo, $tamanho, $extensao, $descricao, $arquivo, $periodo, $id_clientes, $observacao, $chave, $enviado, $id_funcionarios, $id_categorias) {
		$conn = new Connection();
		$arq = $conn->updateBlob($id, $nome, $tipo, $tamanho, $extensao, $descricao, $arquivo, $periodo, $id_clientes, $observacao, $chave, $enviado, $id_funcionarios, $id_categorias);
        return $arq;
    }
	
	public function selectBlob($id_clientes='', $chave='') {
		$conn = new Connection();
		$arq = $conn->selectBlob($id_clientes, $chave);
        return $arq;
    }
	
	public function selectBlobMd5($id) {
		$conn = new Connection();
		$arq = $conn->selectBlobMd5($id);
        return $arq;
    }
	
	public function loadArquivos($id_clientes){
		$retorno = '';	
		$conn = new Connection();
		$result = $conn->select("SELECT a.id,
									    a.nome,
								        a.tipo,
								        a.tamanho,
								        a.extensao,
								        a.descricao,								        
								        date_format(a.dt_cadastro,'%d/%m/%Y') as dt_cadastro,
								        if(a.arquivo is not null, 1, 0) as fg_arquivo,
								        a.periodo,
								        a.observacao,
								        a.chave,
								        a.enviado,
								        a.id_funcionarios, 
								        a.id_categorias
								   FROM tb_arquivos a 
								  WHERE a.id_clientes = :ID_CLIENTES AND a.id_funcionarios = :ID_FUNCIONARIOS;",array(
			":ID_CLIENTES" => $id_clientes,
			":ID_FUNCIONARIOS"=>0
		));
		
		if (isset($result[0])) {
			$retorno = $result;
		}else {
			$retorno = FALSE;
		}
		
		return $retorno;
	}
	
	public function loadArquivosFuncionarios($id_funcionarios){
		$retorno = '';	
		$conn = new Connection();
		$result = $conn->select("SELECT a.id,
									    a.nome,
								        a.tipo,
								        a.tamanho,
								        a.extensao,
								        a.descricao,								        
								        date_format(a.dt_cadastro,'%d/%m/%Y') as dt_cadastro,
								        if(a.arquivo is not null, 1, 0) as fg_arquivo,
								        a.periodo,
								        a.observacao,
								        a.chave,
								        a.enviado,
								        a.id_funcionarios, 
								        a.id_categorias,
								       	c.descricao as desc_categorias
								       	
								   FROM tb_arquivos a
								   LEFT JOIN tb_arquivos_categorias c on c.id = a.id_categorias 
								  WHERE a.id_funcionarios = :ID_FUNCIONARIOS",array(
			":ID_FUNCIONARIOS"=>$id_funcionarios
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