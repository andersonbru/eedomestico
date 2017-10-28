<?php
class Connection extends PDO {
	private $conn;
	private $host 	= 'mysql.hostinger.com.br';
	private $dbname = 'u856889270_eedom';
	private $user 	= 'u856889270_eedom';
	private $pass 	= 'eedomestico2017';
	
	public function __construct()
	{
		try{
			//$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass,[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass,array(PDO::ATTR_PERSISTENT => TRUE,
																											  PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
																											 )
																											);    
		}catch(PDOException $e){
		    // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
		    //var_dump($e);
		    return 'Falha ao conectar no banco de dados: '.$e->getMessage();
		}
	}
	
	private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}
	}
	
	private function setParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);	
	}
	
	public function query($query, $params=array())
	{
		$stmt = $this->conn->prepare($query);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}
		
	public function select($query, $params=array())
	{
		$stmt = $this->query($query, $params);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function insert($tabela, $values=array()){
		$conn = $this->conn;
		$stmt = $conn->prepare("INSERT INTO ".$tabela." (".str_replace(':', '', strtolower(implode(',', array_keys($values)))).") 
							    VALUES(".implode(',', array_keys($values)).")");
		$this->setParams($stmt, $values);
		
		try {			 
	        $conn->beginTransaction(); 
	        $stmt->execute();
			$registro = $conn->lastInsertId(); 
	        $conn->commit();
			return $registro;
			 
	    } catch(PDOExecption $e) {
	        $erro = $e->getMessage();
	        $conn->rollback(); 
	        return "Error!: ".$erro."</br>"; 
	    }
	}
	
	public function delete($tabela, $values){
			
		foreach ($values as $key => $value) {
	        $fields[] = str_replace(':', '', strtolower($key))." = ".$value;
	    }
		$conn = $this->conn;
		$stmt = $conn->prepare("DELETE FROM ".$tabela." WHERE ".implode(' and ', $fields));
		$this->setParams($stmt, $values);
		
		try {			 
	        $conn->beginTransaction(); 
	        $stmt->execute(); 
	        $conn->commit();
			return TRUE;
			 
	    } catch(PDOExecption $e) {
	        	 
	        $conn->rollback(); 
	        return "Error!: ".$e->getMessage()."</br>"; 
	    }
	}
	
	public function update($tabela, $values=array(), $where=array()){
		$conn = $this->conn;
		
		foreach ($values as $key => $value) {
	        $fields[] = str_replace(':', '', strtolower($key))." = ".$key;
	    }
		
		foreach ($where as $key => $value) {
	        $condicao[] = str_replace(':', '', strtolower($key))." = ".$key;
	    }
		
		$stmt = $conn->prepare("UPDATE ".$tabela." SET ".implode(', ', $fields)." WHERE ".implode(' and ', $condicao));
		$this->setParams($stmt, array_merge($values, $where));
				
		try {			 
	        $conn->beginTransaction(); 
	        $stmt->execute(); 
	        $conn->commit();
			return TRUE;
			 
	    } catch(PDOExecption $e) {
	        	 
	        $conn->rollback(); 
	        return "Error!: ".$e->getMessage()."</br>"; 
	    }
	}
	
	public function insertBlob($nome, $tipo, $tamanho, $descricao, $arquivo, $periodo, $id_clientes, $observacao, $chave, $enviado) {
		$conn = $this->conn;
        $blob = file_get_contents($arquivo);
		
		$sql = "INSERT INTO tb_arquivos(nome,tipo,tamanho,descricao,arquivo,periodo,id_clientes,observacao,chave, enviado) 
								 VALUES(:NOME,:TTIPO,:TAMANHO,:DESCRICAO,:ARQUIVO,:PERIODO,:ID_CLIENTES,:OBSERVACAO,:CHAVE, :ENVIADO)";
        $stmt = $conn->prepare($sql);
 
        $stmt->bindParam(':NOME', $nome);
		$stmt->bindParam(':TIPO', $tipo);
		$stmt->bindParam(':TAMANHO', $tamanho);
		$stmt->bindParam(':DESCRICAO', $descricao);
		$stmt->bindParam(':ARQUIVO', $blob, PDO::PARAM_LOB);
		$stmt->bindParam(':PERIODO', $periodo);
		$stmt->bindParam(':ID_CLIENTES', $id_clientes);
		$stmt->bindParam(':OBSERVACAO', $observacao);
		$stmt->bindParam(':CHAVE', $chave);
		$stmt->bindParam(':ENVIADO', $enviado);
 		
		try {			 
	        $conn->beginTransaction(); 
	        $stmt->execute(); 
	        $conn->commit();
			return TRUE;
			 
	    } catch(PDOExecption $e) {
	        	 
	        $conn->rollback(); 
	        return "Error!: ".$e->getMessage()."</br>"; 
	    }		
    }
	
	public function updateBlob($id, $nome, $tipo, $tamanho, $descricao, $arquivo, $periodo, $id_clientes, $observacao, $chave, $enviado) {
 		$conn = $this->conn;
        $blob = file_get_contents($arquivo);
		
        $sql = "UPDATE tb_arquivos
                SET nome 		= :NOME,
                	tipo 		= :TIPO,
                	tamanho		= :TAMANHO,
                	descricao	= :DESCRICAO,
                	arquivo		= :ARQUIVO,
                	periodo		= :PERIODO,
                	id_clientes	= :ID_CLIENTES,
                	observacao	= :OBSERVACAO,
                	chave		= :CHAVE,
                	enviado		= :ENVIADO
                	
                WHERE id = :ID";
 
        $stmt = $conn->prepare($sql);
 
        $stmt->bindParam(':ID', $id);
        $stmt->bindParam(':NOME', $nome);
		$stmt->bindParam(':TIPO', $tipo);
		$stmt->bindParam(':TAMANHO', $tamanho);
		$stmt->bindParam(':DESCRICAO', $descricao);
		$stmt->bindParam(':ARQUIVO', $blob, PDO::PARAM_LOB);
		$stmt->bindParam(':PERIODO', $periodo);
		$stmt->bindParam(':ID_CLIENTES', $id_clientes);
		$stmt->bindParam(':OBSERVACAO', $observacao);
		$stmt->bindParam(':CHAVE', $chave);		        
		$stmt->bindParam(':ENVIADO', $enviado);
 		
		try {			 
	        $conn->beginTransaction(); 
	        $stmt->execute(); 
	        $conn->commit();
			return TRUE;
			 
	    } catch(PDOExecption $e) {
	        $conn->rollback(); 
	        return "Error!: " . $e->getMessage() . "</br>"; 
	    }
    }
	
	public function selectBlob($id_clientes, $chave) {
 		$conn = $this->conn;
        $sql = "SELECT id, nome, tipo, tamanho. descricao, arquivo, dt_cadastro, periodo, id_clientes, observacao, chave, enviado
                  FROM tb_arquivos
                 WHERE id_clientes = :ID_CLIENTES AND chave=:CHAVE;";
 
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":ID_CLIENTES"=>$id_clientes, ':CHAVE'=>$chave));
        $stmt->bindColumn(1, $id);
        $stmt->bindColumn(2, $nome);
        $stmt->bindColumn(3, $tipo);
        $stmt->bindColumn(4, $tamanho);
		$stmt->bindColumn(5, $descricao);
        $stmt->bindColumn(6, $arquivo, PDO::PARAM_LOB);
		$stmt->bindColumn(7, $dt_cadastro);
		$stmt->bindColumn(8, $periodo);
		$stmt->bindColumn(9, $id_clientes);
		$stmt->bindColumn(10, $observacao);
		$stmt->bindColumn(11, $chave);
		$stmt->bindColumn(12, $enviado);
 
        $stmt->fetch(PDO::FETCH_BOUND);
 
        return array('id'=>$id, 
        		     'nome'=>$nome, 
        		     'tipo'=>$tipo, 
        		     'tamanho'=>$tamanho, 
        		     'descricao'=>$descricao,
        		     'arquivo'=>$arquivo, 
        		     'dt_cadastro'=>$dt_cadastro,
        		     'periodo'=>$periodo,
        		     'id_clientes'=>$id_clientes,
        		     'observacao'=>$observacao,
        		     'chave'=>$chave,
					 'enviado'=>$enviado);
    }
	
	public function selectBlobMd5($id) {
 		$conn = $this->conn;
        $sql = "SELECT id, nome, tipo, tamanho. descricao, arquivo, dt_cadastro, periodo, id_clientes, observacao, chave, enviado
                  FROM tb_arquivos
                 WHERE md5(id) = :ID;";
 
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":ID"=>$id));
        $stmt->bindColumn(1, $id);
        $stmt->bindColumn(2, $nome);
        $stmt->bindColumn(3, $tipo);
        $stmt->bindColumn(4, $tamanho);
		$stmt->bindColumn(5, $descricao);
        $stmt->bindColumn(6, $arquivo, PDO::PARAM_LOB);
		$stmt->bindColumn(7, $dt_cadastro);
		$stmt->bindColumn(8, $periodo);
		$stmt->bindColumn(9, $id_clientes);
		$stmt->bindColumn(10, $observacao);
		$stmt->bindColumn(11, $chave);
		$stmt->bindColumn(12, $enviado);
 
        $stmt->fetch(PDO::FETCH_BOUND);
 
        return array('id'=>$id, 
        		     'nome'=>$nome, 
        		     'tipo'=>$tipo, 
        		     'tamanho'=>$tamanho, 
        		     'descricao'=>$descricao,
        		     'arquivo'=>$arquivo, 
        		     'dt_cadastro'=>$dt_cadastro,
        		     'periodo'=>$periodo,
        		     'id_clientes'=>$id_clientes,
        		     'observacao'=>$observacao,
        		     'chave'=>$chave,
        		     'enviado'=>$enviado);
    }
	
	
}
?>
