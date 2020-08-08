$(document).ready(function(){
	var DOMAIN = "http://localhost/pharmacyManagementSystem";

	//Manage Doctors
	manageDoctors(1);
	function manageDoctors(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {manageDoctors:1,pageno:pn},
			success : function(data){
				$("#get_doctors").html(data);		
			}
		})
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		manageDoctors(pn);
	})

	$("body").delegate(".del_doc","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete..!")) {
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : {deleteDoctors:1,id:did},
				success : function(data){
					if (data == "DEPENDENT_DOCTOR") {
						alert("Sorry ! this Doctor is dependent on other Doctors");
					}else if(data == "DOCTORS_DELETED"){
						alert("Doctor Deleted Successfully..! happy");
						manageDoctors(1);
					}else if(data == "DELETED"){
						alert("Deleted Successfully");
					}else{
						alert(data);
					}
						
				}
			})
		}else{

		}
	})

	//Fetch doctors
	fetch_doctors();
	function fetch_doctors(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getDoctors:1},
			success : function(data){
				var root = "<option value='0'>Choose Doctor</option>";
				var choose = "<option value=''>Choose Doctors</option>";
				$("#parent_doc").html(root+data);
				$("#select_doc").html(choose+data);
			}
		})
	}

	// //Fetch Patients
	 fetch_patients();
	function fetch_patients(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getPatients:1},
			success : function(data){
				var choose = "<option value=''>Choose Patients</option>";
				$("#select_patient").html(choose+data);
			}
		})
	}


	//Update Doctors
	$("body").delegate(".edit_doc","click",function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {updateDoctors:1,id:eid},
			success : function(data){
				console.log(data);
				$("#cid").val(data["cid"]);
				$("#update_doctors").val(data["doctors_name"]);
				$("#parent_doc").val(data["parent_doc"]);
			}
		})
	})

	$("#update_doctors_form").on("submit",function(){
		if ($("#update_doctors").val() == "") {
			$("#update_doctors").addClass("border-danger");
			$("#doc_error").html("<span class='text-danger'>Please Enter Doctors Name</span>");
		}else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data  : $("#update_doctors_form").serialize(),
				success : function(data){
					window.location.href = "";
				}
			})
		}
	})


	//----------Patients-------------
	managePatients(1);
	function managePatients(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {managePatients:1,pageno:pn},
			success : function(data){
				$("#get_patients").html(data);		
			}
		})
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		managePatients(pn);
	})

	$("body").delegate(".del_patient","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete..!")) {
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : {deletePatients:1,id:did},
				success : function(data){
					if (data == "DELETED") {
						alert("Patient is deleted");
						managePatients(1);
					}else{
						alert(data);
					}
						
				}
			})
		}
	})

	//Update Patients
	$("body").delegate(".edit_patients","click",function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {updatePatients:1,id:eid},
			success : function(data){
				console.log(data);
				$("#bid").val(data["bid"]);
				$("#update_patients").val(data["patients_name"]);
			}
		})
	})

	$("#update_patients_form").on("submit",function(){
		if ($("#update_patients").val() == "") {
			$("#update_patients").addClass("border-danger");
			$("#patients_error").html("<span class='text-danger'>Please Enter Patients Name</span>");
		}else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data  : $("#update_patients_form").serialize(),
				success : function(data){
					alert(data);
					window.location.href = "";
				}
			})
		}
	})


	//---------------------medicines-----------------
	manageMedicines(1);
	function manageMedicines(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {manageMedicines:1,pageno:pn},
			success : function(data){
				$("#get_medicines").html(data);		
			}
		})
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		manageMedicines(pn);
	})

	$("body").delegate(".del_medicines","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete..!")) {
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : {deleteMedicines:1,id:did},
				success : function(data){
					if (data == "DELETED") {
						alert("Medicines is deleted");
						manageMedicines(1);
					}else{
						alert(data);
					}
						
				}
			})
		}
	})

	//Update medicines
	$("body").delegate(".edit_medicines","click",function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {updateMedicines:1,id:eid},
			success : function(data){
				console.log(data);
				$("#mid").val(data["mid"]);
				$("#update_medicines").val(data["medicine_name"]);
				$("#medicines_price").val(data["price"]);
				$("#medicines_qty").val(data["quantity"]);

			}
		})
	})

	//Update medicines
	$("#update_medicines_form").on("submit",function(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#update_medicines_form").serialize(),
				success : function(data){
					if (data == "UPDATED") {
						alert("Medicines Updated Successfully..!");
						window.location.href = "";
					}else{
						alert(data);
					}
				}
			})
	})	
})