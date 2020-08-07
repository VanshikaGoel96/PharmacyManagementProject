<?php

/**
* 
*/
class DBOperation
{
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function addDoctors($docname,$docaddress){
		$pre_stmt = $this->con->prepare("INSERT INTO `doctors`( `doctors_name`, `address`)
		 VALUES (?,?)");
		$pre_stmt->bind_param("ss",$docname,$docaddress);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "DOCTORS_ADDED";
		}else{
			return 0;
		}
	}

	public function addPatients($patients_name,$number,$gender,$problem,$did){
		$pre_stmt = $this->con->prepare("INSERT INTO `patients`(`patients_name`, `number`, `gender`, `problem`,`did`)
		 VALUES (?,?,?,?,?)");
		$pre_stmt->bind_param("sissi",$patients_name,$number,$gender,$problem,$did);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "PATIENTS_ADDED";
		}else{
			return 0;
		}
	}

	public function addMedicines($pro_name,$price,$stock,$date){
		$pre_stmt = $this->con->prepare("INSERT INTO `medicines`
			(`medicine_name`, `price`,
			 `quantity`, `expiry_date`)
			 VALUES (?,?,?,?)");
		$pre_stmt->bind_param("siis",$pro_name,$price,$stock,$date);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "NEW_MEDICINES_ADDED";
		}else{
			return 0;
		}
	}

	public function getAllRecord($table){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}
}

?>