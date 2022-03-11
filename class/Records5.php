<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

date_default_timezone_set('America/Bogota');

class Records {	
   
	private $recordsTable = 'live_records';
	public $id;
	public $ordenp;
    public $name;
    public $skills;
    public $address;
	public $designation;
	public $age;
	public $categoria;
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." WHERE `estado_op` = '1' AND `designation` LIKE 'DESPACHO%'";

		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR ordenp LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR designation LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR address LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR categoria LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR skills LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->recordsTable);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($record = $result->fetch_assoc()) { 				
			$rows = array();			
			//$rows[] = $record['id'];
			$rows[] = $record['ordenp'];
			$rows[] = ucfirst($record['name']);
			$rows[] = $record['age'];		
			$rows[] = $record['skills'];	
			$rows[] = $record['address'];
			$rows[] = $record['designation'];
			$rows[] = $record['categoria'];
			$rows[] = '<button type="button" name="update" id="'.$record["id"].'" class="btn btn-warning btn-s update">  Editar  </button>';
			$rows[] = '<button type="button" name="delete" id="'.$record["id"].'" class="btn btn-danger btn-xs delete" >  Eliminar  </button>';
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	public function getRecord(){
		if($this->id) {
			$sqlQuery = "
				SELECT * FROM ".$this->recordsTable." 
				WHERE id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
	public function updateRecord(){
		
		if($this->id) {	

			$this->id_user = $_SESSION["loggedin"];
			$this->modificado = date('Y-m-d h:i:s a', time());
			
			$stmt = $this->conn->prepare("
			UPDATE ".$this->recordsTable." 
			SET ordenp = ?, id_user = ?, name = ?, age = ?, skills = ?, address = ?, designation = ?, categoria = ?, modificado = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->ordenp = htmlspecialchars(strip_tags($this->ordenp));
			$this->id_user = htmlspecialchars(strip_tags($this->id_user));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->age = htmlspecialchars(strip_tags($this->age));
			$this->skills = htmlspecialchars(strip_tags($this->skills));
			$this->address = htmlspecialchars(strip_tags($this->address));
			$this->designation = htmlspecialchars(strip_tags($this->designation));
			$this->categoria = htmlspecialchars(strip_tags($this->categoria));
			$this->modificado = htmlspecialchars(strip_tags($this->modificado));
			
			
			$stmt->bind_param("sisissssii", $this->ordenp, $this->id_user, $this->name, $this->age, $this->skills, $this->address, $this->designation, $this->categoria, $this->modificado, $this->id);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}
	public function addRecord(){
		
		if($this->name) {

			$this->id_user = $_SESSION["loggedin"];
			$this->estado_op = '1';
			$this->modificado = date('Y-m-d h:i:s a', time());

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`ordenp`, `id_user`, `name`, `age`, `skills`, `address`, `designation`, `categoria`, `estado_op`, `modificado`)
			VALUES(?,?,?,?,?,?,?,?,?,?)");
		
			$this->ordenp = htmlspecialchars(strip_tags($this->ordenp));
			$this->id_user = htmlspecialchars(strip_tags($this->id_user));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->age = htmlspecialchars(strip_tags($this->age));
			$this->skills = htmlspecialchars(strip_tags($this->skills));
			$this->address = htmlspecialchars(strip_tags($this->address));
			$this->designation = htmlspecialchars(strip_tags($this->designation));
			$this->categoria = htmlspecialchars(strip_tags($this->categoria));
			$this->estado_op = htmlspecialchars(strip_tags($this->estado_op));
			$this->modificado = htmlspecialchars(strip_tags($this->modificado));
			
			
			$stmt->bind_param("sisisssssi", $this->ordenp, $this->id_user, $this->name, $this->age, $this->skills, $this->address, $this->designation, $this->categoria, $this->estado_op, $this->modificado);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	public function deleteRecord(){

		if($this->id) {

			$this->id_user = $_SESSION["loggedin"];
			$this->estado_op = '0';
			$this->modificado = date('Y-m-d h:i:s a', time());	

			$stmt = $this->conn->prepare("
				UPDATE ".$this->recordsTable." 
			SET estado_op = ?, modificado = ?
			WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->id_user = htmlspecialchars(strip_tags($this->id_user));
			$this->estado_op = htmlspecialchars(strip_tags($this->estado_op));
			$this->modificado = htmlspecialchars(strip_tags($this->modificado));

			$stmt->bind_param("ssii", $this->estado_op, $this->modificado, $this->id_user, $this->id);

			if($stmt->execute()){
				return true;
			}
		}
	}
}
?>