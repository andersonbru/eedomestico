<?php
class Menu extends Connection {
	private $id;
	private $descricao;
	private $link;
	private $icone;
	private $tipo;
	private $status;
	private $id_menu_pai;
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setDescricao($value){
		$this->descricao = $value;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setLink($value){
		$this->link = $value;
	}
	
	public function getLink(){
		return $this->link;
	}
	
	public function setIcone($value){
		$this->icone = $value;
	}
	
	public function getIcone(){
		return $this->icone;
	}
	
	public function setTipo($value){
		$this->tipo = $value;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function setIdMenuPai($value){
		$this->id_menu_pai = $value;
	}
	
	public function getIdMenuPai(){
		return $this->id_menu_pai;
	}
	
	public function gerarMenu($id_usuario, $acesso){
		
		$conn = new Connection();
		$menu = $conn->select("select a.* from (SELECT m.* 
												  FROM tb_menu m
												 where m.acesso 	= :ACESSO
												   AND m.tipo 		in('U','P')
												   AND m.status 	= :STATUS
												   AND m.tp_acesso  = 'P'
												union
												SELECT m.*
												 FROM tb_menu_usuarios u
												 LEFT JOIN tb_menu m ON m.id = u.id_menu
												WHERE u.id_usuario = :ID_USUARIO
												  AND m.acesso 	= :ACESSO
												  AND m.tipo 	in('U','P')
												  AND m.status 	= :STATUS) a order by a.descricao;", array(':ID_USUARIO'=>$id_usuario,
												  													   	   ':ACESSO'=>$acesso,
												  													       ':STATUS'=>'A'));
		
		foreach ($menu as $key => $value) {
			$menu_filho = $conn->select("SELECT * FROM tb_menu m
										  WHERE m.id_menu_pai = :ID
										  	AND (exists (SELECT * FROM tb_menu_usuarios WHERE id_usuario = :ID_USUARIO AND id_menu = m.id) or m.tp_acesso='P') 
										    AND m.status = :STATUS",array(':ID'=>$value['id'],':STATUS'=>'A', ':ID_USUARIO'=>$id_usuario));
			
			$retorno[] = array('id'			=>$value['id'],
							   'descricao'	=>$value['descricao'],
							   'link'		=>$value['link'],
							   'icone'		=>$value['icone'],
							   'acesso'		=>$value['acesso'],
							   'tipo'		=>$value['tipo'],
							   'status'		=>$value['status'],
							   'menu_filho'	=>(count($menu_filho)>0?$menu_filho:FALSE));
			
		}
		
		if (isset($retorno)) {
			$result = $retorno;
		} else {
			$result = FALSE;
		}
		
								  
		return $result;
	}
	
	public function getCarregaId($id){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_menu WHERE id = :ID", array(':ID'=>$id));
		return $lista[0];
	}
	
	public function getList(){
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_menu ORDER BY descricao");
		return $lista;
	}
	
	public function getListMenuPai() {
		$conn = new Connection();
		$lista = $conn->select("SELECT * FROM tb_menu WHERE status = :STATUS and tipo=:TIPO ORDER BY descricao", array(
			':STATUS'=>'A',
			':TIPO'=>'P'
		));
		if(count($lista)>0){
			foreach ($lista as $key => $value) {
				$retorno[$value['id']] = $value['descricao'];
			}
		}else{
			$retorno = array();
		}
		return $retorno;
	}
	
	public function addMenu($values=array()){
		$conn = new Connection();
		$insert = $conn->insert('tb_menu', $values);
		return $insert;
	}
	
	public function delMenu($values=array()){
		$conn = new Connection();
		
		$menuUsuario = new MenuUsuarios();
		foreach ($values as $key => $value) {
			$id_menu = $value;
		}
		$menuUsuario->delMenuUsuario(array(':ID_MENU'=>$id_menu));
		
		$delete = $conn->delete('tb_menu', $values);
		return $delete;
	}
	
	public function editMenu($values=array(), $where = array()){
		$conn = new Connection();
		$edit = $conn->update('tb_menu', $values, $where);
		return $edit;
	}
}
?>