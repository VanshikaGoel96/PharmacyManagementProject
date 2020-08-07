<?php

/**
* 
*/
class Manage
{
	
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function manageRecord($table){
			$sql = "SELECT * FROM ".$table;
		
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows"=>$rows];
	}

	public function deleteRecord($table,$pk,$id){
			$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
			$pre_stmt->bind_param("i",$id);
			$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "DELETED";
			}
	}


	public function getSingleRecord($table,$pk,$id){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ? LIMIT 1");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
		}
		return $row;
	}

	public function update_record($table,$where,$fields){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value . "' AND ";
		}
		$condition = substr($condition, 0, -5);
		foreach ($fields as $key => $value) {
			$sql .= $key . "='".$value."', ";
		}
		$sql = substr($sql, 0,-2);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			return "UPDATED";
		}
	}


	public function storeCustomerOrderInvoice($orderdate,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type){
		$pre_stmt = $this->con->prepare("INSERT INTO 
			`invoice`(`customer_name`, `order_date`, `sub_total`,
			 `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES (?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssdddddds",$cust_name,$orderdate,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
		$pre_stmt->execute() or die($this->con->error);
		$invoice_no = $pre_stmt->insert_id;
		if ($invoice_no != null) {
			for ($i=0; $i < count($ar_price) ; $i++) {

				//Here we are finding the remaing quantity after giving patient
				$rem_qty = $ar_tqty[$i] - $ar_qty[$i];
				if ($rem_qty < 0) {
					return "ORDER_FAIL_TO_COMPLETE";
				}else{
					//Update Medicines stock
					$sql = "UPDATE medicines SET quantity = '$rem_qty' WHERE medicine_name = '".$ar_pro_name[$i]."'";
					$this->con->query($sql);
				}
				$insert_medicines = $this->con->prepare("INSERT INTO `prescription`(`invoice_no`, `medicine_name`, `price`, `qty`)
				 VALUES (?,?,?,?)");
				$insert_medicines->bind_param("isdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$insert_medicines->execute() or die($this->con->error);
			}

			return $invoice_no;
		}
	}
}
?>