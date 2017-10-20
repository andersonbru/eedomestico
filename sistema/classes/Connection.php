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
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass,[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);    
		}catch(PDOException $e){
		    // Caso ocorra algum erro na conexão com o banco, exibe a mensagem
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
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
	        return "Error!: " . $erro . "</br>"; 
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
	        return "Error!: " . $e->getMessage() . "</br>"; 
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
	        return "Error!: " . $e->getMessage() . "</br>"; 
	    }
	}
	
	public function insertBlob($nome, $type, $size, $arquivo, $chave, $id_usuario) {
		$conn = $this->conn;
        $blob = file_get_contents($arquivo);
		
		$sql = "INSERT INTO tb_arquivos(nome,type,size,arquivo, chave, id_usuarios) VALUES(:NOME,:TYPE,:SIZE,:ARQUIVO,:CHAVE,:ID_USUARIOS)";
        $stmt = $conn->prepare($sql);
 
        $stmt->bindParam(':NOME', $nome);
		$stmt->bindParam(':TYPE', $type);
		$stmt->bindParam(':SIZE', $size);
		$stmt->bindParam(':ARQUIVO', $blob, PDO::PARAM_LOB);
		$stmt->bindParam(':CHAVE', $chave);
		$stmt->bindParam(':ID_USUARIOS', $id_usuario);        
 		
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
	
	public function updateBlob($id, $nome, $type, $size, $arquivo, $chave, $id_usuario) {
 		$conn = $this->conn;
        $blob = file_get_contents($arquivo);
		//$blob = fopen($arquivo,'rb');
 
        $sql = "UPDATE tb_arquivos
                SET nome 		= :NOME,
                	type 		= :TYPE,
                	size		= :SIZE,
                	arquivo		= :ARQUIVO, 
                	chave		= :CHAVE, 
                	id_usuarios	= :ID_USUARIOS
                WHERE id = :ID";
 
        $stmt = $conn->prepare($sql);
 
        $stmt->bindParam(':ID', $id);
        $stmt->bindParam(':NOME', $nome);
		$stmt->bindParam(':TYPE', $type);
		$stmt->bindParam(':SIZE', $size);
		$stmt->bindParam(':ARQUIVO', $blob, PDO::PARAM_LOB);
		$stmt->bindParam(':CHAVE', $chave);
		$stmt->bindParam(':ID_USUARIOS', $id_usuario);        
 		
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
	
	public function selectBlob($id_usuarios, $chave) {
 		$conn = $this->conn;
        $sql = "SELECT id, nome, type, size, arquivo, chave, id_usuarios
                  FROM tb_arquivos
                 WHERE id_usuarios = :ID_USUARIOS AND chave=:CHAVE;";
 
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":ID_USUARIOS"=>$id_usuarios, ':CHAVE'=>$chave));
        $stmt->bindColumn(1, $id);
        $stmt->bindColumn(2, $nome);
        $stmt->bindColumn(3, $type);
        $stmt->bindColumn(4, $size);
        $stmt->bindColumn(5, $arquivo, PDO::PARAM_LOB);
		$stmt->bindColumn(6, $chave);
		$stmt->bindColumn(7, $id_usuarios);
 
        $stmt->fetch(PDO::FETCH_BOUND);
 
        return array('id'=>$id, 'nome'=>$nome, 'type'=>$type, 'size'=>$size, 'arquivo'=>$arquivo, 'chave'=>$chave, 'id_usuarios'=>$id_usuarios);
    }
	
	public function selectBlobMd5($id) {
 		$conn = $this->conn;
        $sql = "SELECT id, nome, type, size, arquivo, chave, id_usuarios
                  FROM tb_arquivos
                 WHERE md5(id) = :ID;";
 
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":ID"=>$id));
        $stmt->bindColumn(1, $id);
        $stmt->bindColumn(2, $nome);
        $stmt->bindColumn(3, $type);
        $stmt->bindColumn(4, $size);
        $stmt->bindColumn(5, $arquivo, PDO::PARAM_LOB);
		$stmt->bindColumn(6, $chave);
		$stmt->bindColumn(7, $id_usuarios);
 
        $stmt->fetch(PDO::FETCH_BOUND);
 
        return array('id'=>$id, 'nome'=>$nome, 'type'=>$type, 'size'=>$size, 'arquivo'=>$arquivo, 'chave'=>$chave, 'id_usuarios'=>$id_usuarios);
    }
	
	
}
?>
