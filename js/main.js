$(document).ready(function(){
	var DOMAIN = "http://localhost/pharmacyManagementSystem";
	$("#register_form").on("submit",function(){
		var status = false;
		var name = $("#username");
		var email = $("#email");
		var pass1 = $("#password1");
		var pass2 = $("#password2");
		var type = $("#usertype");

		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(name.val() == "" || name.val().length < 6){
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 6 characters</span>");
			status = false;
		}else{
			name.removeClass("border-danger");
			$("#u_error").html("");
			status = true;
		}
		if(status==true){if(!e_patt.test(email.val())){
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
			status = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}}
		if(status==true){if(pass1.val() == "" || pass1.val().length < 9){
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Please Enter more than 9 character password</span>");
			status = false;
		}else{
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			status = true;
		}}
		if(status==true){if(pass2.val() == "" || pass2.val().length < 9){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Please Enter more than 9 character password</span>");
			status = false;
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status = true;
		}}
		if(status==true){if(type.val() == ""){
			type.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>Please Enter more than 9 character password</span>");
			status = false;
		}else{
			type.removeClass("border-danger");
			$("#t_error").html("");
			status = true;
		}}
		if ((pass1.val() == pass2.val()) && status == true) {
			$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#register_form").serialize(),
				success : function(data){
					if (data == "EMAIL_ALREADY_EXISTS") {
						$(".overlay").hide();
						alert("It seems like this email is already used");
					}else if(data == "SOME_ERROR"){
						$(".overlay").hide();
						alert("Something Wrong");
					}else{
						$(".overlay").hide();
						window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered. Now you can login");
					}
				}
			})
		}else{
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password did not match</span>");
			status = true;
		}
	})

	//For Login Part
	$("#form_login").on("submit",function(){
		var email = $("#log_email");
		var pass = $("#log_password");
		var status = false;
		if (email.val() == "") {
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
			status = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}
		if (pass.val() == "") {
			pass.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
			status = false;
		}else{
			pass.removeClass("border-danger");
			$("#p_error").html("");
			status = true;
		}
		if (status) {
			$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#form_login").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERD") {
						$(".overlay").hide();
						email.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>It seems like have not registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
						$(".overlay").hide();
						pass.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else{
						$(".overlay").hide();
						console.log(data);
						window.location.href = DOMAIN+"/dashboard.php";
					}
				}
			})
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

	//Fetch Patients
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

	//Add Doctors
	$("#doctors_form").on("submit",function(){
		if ($("#doctors_name").val() == "") {
			$("#doctors_name").addClass("border-danger");
			$("#doc_error").html("<span class='text-danger'>Please Enter Doctor Name</span>");
		}
		else if($("#doctors_address").val() == ""){
			$("#doctors_address").addClass("border-danger");
			$("#doc_add_error").html("<span class='text-danger'>Please Enter Doctor Address</span>");
		}
		else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data  : $("#doctors_form").serialize(),

				success : function(data){
					if (data == "DOCTORS_ADDED") {
							$("#doctors_name").removeClass("border-danger");
							$("#doctors_address").removeClass("border-danger");
							$("#doc_add_error").html("<span class='text-success'>New Doctor Added Successfully..!</span>");
							$("#doctors_name").val("");
							$("#doctors_address").val("");
							fetch_doctors();
					}else{
						alert(data);
					}
				}
			})
		}
	})


	//Add Patients
	$("#patients_form").on("submit",function(){
		if ($("#patients_name").val() == "") {
			$("#patients_name").addClass("border-danger");
			$("#patients_name_error").html("<span class='text-danger'>Please Enter Patients Name</span>");
		}else if($("#patients_contact_number").val() == ""){
			$("#patients_contact_number").addClass("border-danger");
			$("#patients_contact_error").html("<span class='text-danger'>Please Enter Patients Contact Number</span>");
		}else if($("#patients_gender").val() == ""){
			$("#patients_gender").addClass("border-danger");
			$("#patients_gender").html("<span class='text-danger'>Select Patients Gender</span>");
		}else if($("#patients_problem").val() == ""){
			$("#patients_problem").addClass("border-danger");
			$("#patients_problem_error").html("<span class='text-danger'>Please Enter Patients Problem</span>");
		}else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#patients_form").serialize(),
				success : function(data){
					if (data == "PATIENTS_ADDED") {
						$("#patients_name").removeClass("border-danger");
						$("#patients_contact_number").removeClass("border-danger");
						$("#patients_gender").removeClass("border-danger");
						$("#patients_problem").removeClass("border-danger");
						$("#patients_name_error").html("<span class='text-success'>New Patients Added Successfully..!</span>");
						 $("#patients_name").val("");
						fetch_patients();
					}else{
						alert(data);
					}
						
				}
			})
		}
	})

	//Add medicines
	$("#medicines_form").on("submit",function(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#medicines_form").serialize(),
				success : function(data){
					if (data == "NEW_MEDICINES_ADDED") {
						alert("New Medicines Added Successfully..!");
						$("#medicines_name").val("");
						$("#select_doc").val("");
						$("#select_patient").val("");
						$("#medicines_price").val("");
						$("#medicines_qty").val("");

					}else{
						console.log(data);
						alert(data);
					}
						
				}
			})
	})

})