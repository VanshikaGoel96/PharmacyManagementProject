<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

//For Registration Processsing
if (isset($_POST["username"]) AND isset($_POST["email"])) {
	$user = new User();
	$result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	echo $result;
	exit();
}

//For Login Processing
if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
	$user = new User();
	$result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
	echo $result;
	exit();
}

//To get Doctors
if (isset($_POST["getDoctors"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("doctors");
	foreach ($rows as $row) {
		echo "<option value='".$row["did"]."'>".$row["doctors_name"]."</option>";
	}
	exit();
}

//Fetch Patients
if (isset($_POST["getPatients"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("patients");
	foreach ($rows as $row) {
		echo "<option value='".$row["bid"]."'>".$row["patients_name"]."</option>";
	}
	exit();
}

//Add Doctors
if (isset($_POST["doctors_name"]) AND isset($_POST["doctors_address"])) {
	$obj = new DBOperation();
	$result = $obj->addDoctors($_POST["doctors_name"],$_POST["doctors_address"]);
	echo $result;
	exit();
}

//Add Patients
if (isset($_POST["patients_name"]) AND isset($_POST["patients_contact_number"])AND isset($_POST["patients_gender"]) AND isset($_POST["patients_problem"]) AND isset($_POST["parent_doc"])) {
	$obj = new DBOperation();
	$result = $obj->addPatients($_POST["patients_name"],$_POST["patients_contact_number"],$_POST["patients_gender"],$_POST["patients_problem"],$_POST["parent_doc"]);
	echo $result;
	exit();
}

//Add Medicines
if (isset($_POST["added_expiry_date"]) AND isset($_POST["medicines_name"])) {
	$obj = new DBOperation();
	$result = $obj->addMedicines($_POST["medicines_name"],
							$_POST["medicines_price"],
							$_POST["medicines_qty"],
							$_POST["added_expiry_date"]);
	echo $result;
	exit();
}

//Manage Doctors
if (isset($_POST["manageDoctors"])) {
	$m = new Manage();
	$result = $m->manageRecord("doctors");
	$rows = $result["rows"];
	if (count($rows) > 0) {
		foreach ($rows as $row) {
			?>
				<tr>
				    <td><?php echo $row["did"]; ?></td>
			        <td><?php echo $row["doctors_name"]; ?></td>
			        <td><?php echo $row["address"]; ?></td>
			       
			      </tr>
			<?php
		}
		?>
		<?php
		exit();
	}
}


//Delete Doctors
if (isset($_POST["deleteDoctors"])) {
	$m = new Manage();
	$result = $m->deleteRecord("doctors","did",$_POST["id"]);
	echo $result;
}

//Update Doctors
if (isset($_POST["updateDoctors"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("doctors","did",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_POST["update_doctors"])) {
	$m = new Manage();
	$id = $_POST["did"];
	$name = $_POST["update_doctors"];
	$parent = $_POST["parent_doc"];
	$result = $m->update_record("doctors",["did"=>$id],["parent_doc"=>$parent,"doctors_name"=>$name,"status"=>1]);
	echo $result;
}

//------------------Patients---------------------


//Manage Patients
if (isset($_POST["managePatients"])) {
	$m = new Manage();
	$result = $m->manageRecord("patients");
	$rows = $result["rows"];
	if (count($rows) > 0) {
		
		foreach ($rows as $row) {
			?>
				<tr>
					<td><?php echo $row["pid"]; ?></td>
			        <td><?php echo $row["patients_name"]; ?></td>
                    <td><?php echo $row["number"]; ?></td>
                    <td><?php echo $row["gender"]; ?></td>
                    <td><?php echo $row["problem"]; ?></td>
                    <td><?php echo $row["did"]; ?></td>
			        
			        <td>
			        	<a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_patient">Delete</a>
			      </tr>
			<?php
		}
		?>
		<?php
		exit();
	}
}

//Delete 
if (isset($_POST["deletePatients"])) {
	$m = new Manage();
	$result = $m->deleteRecord("patients","pid",$_POST["id"]);
	echo $result;
}


//Update Patients
if (isset($_POST["updatePatients"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("patients","pid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_POST["update_patients"])) {
	$m = new Manage();
	$id = $_POST["pid"];
	$name = $_POST["update_patients"];
	$result = $m->update_record("patients",["pid"=>$id],["patients_name"=>$name,"status"=>1]);
	echo $result;
}

//----------------medicines---------------------

if (isset($_POST["manageMedicines"])) {
	$m = new Manage();
	$result = $m->manageRecord("medicines");
	$rows = $result["rows"];
	if (count($rows) > 0) {
		foreach ($rows as $row) {
			?>
				<tr>
					<td><?php echo $row["mid"]; ?></td>
			        <td><?php echo $row["medicine_name"]; ?></td>
			        <td><?php echo $row["price"]; ?></td>
			        <td><?php echo $row["quantity"]; ?></td>
			        <td><?php echo $row["expiry_date"]; ?></td>
			        <td>
			        	<a href="#" did="<?php echo $row['mid']; ?>" class="btn btn-danger btn-sm del_medicines">Delete</a>
			        	<a href="#" eid="<?php echo $row['mid']; ?>" data-toggle="modal" data-target="#form_medicines" class="btn btn-info btn-sm edit_medicines">Edit</a>
			        </td>
			      </tr>
			<?php
		}
		?>
		<?php
		exit();
	}
}

//Delete 
if (isset($_POST["deleteMedicines"])) {
	$m = new Manage();
	$result = $m->deleteRecord("medicines","mid",$_POST["id"]);
	echo $result;
}

//Update Medicines
if (isset($_POST["updateMedicines"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("medicines","mid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_POST["update_medicines"])) {
	$m = new Manage();
	$id = $_POST["mid"];
	$name = $_POST["update_medicines"];
	$price = $_POST["medicines_price"];
	$qty = $_POST["medicines_qty"];
	$date = $_POST["added_expiry_date"];
	$result = $m->update_record("medicines",["mid"=>$id],["medicine_name"=>$name,"price"=>$price,"quantity"=>$qty,"expiry_date"=>$date]);
	echo $result;
}

//-------------------------Order Processing--------------

if (isset($_POST["getNewOrderItem"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("medicines");
	?>
	<tr>
		    <td><b class="number">1</b></td>
		    <td>
		        <select name="mid[]" class="form-control form-control-sm mid" required>
		            <option value="">Choose Medicines</option>
		            <?php 
		            	foreach ($rows as $row) {
		            		?><option value="<?php echo $row['mid']; ?>"><?php echo $row["medicine_name"]; ?></option><?php
		            	}
		            ?>
		        </select>
		    </td>
		    <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>   
		    <td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
		    <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></span>
		    <span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></td>
		    <td>Rs.<span class="amt">0</span></td>
	</tr>
	<?php
	exit();
}


//Get price and qty of one item
if (isset($_POST["getPriceAndQty"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("medicines","mid",$_POST["id"]);
	echo json_encode($result);
	exit();
}


if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])) {
	
	$orderdate = $_POST["order_date"];
	$cust_name = $_POST["cust_name"];


	//Now getting array from order_form
	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];


	$sub_total = $_POST["sub_total"];
	$gst = $_POST["gst"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$payment_type = $_POST["payment_type"];


	$m = new Manage();
	echo $result = $m->storeCustomerOrderInvoice($orderdate,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);




}

?> 