
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Log Yourself In</title>
		<link rel="stylesheet" href="css/styles.css">
		
		<!-- Include Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="js/darkmode.js"></script>



	</head>
	<body>

	
		<div class="login-card">

		<!--server validation response-->
        <div class="response" id="response">
                
		</div>

		<div class ="header" >
			<div class ="title">
				<h1>SIGNUP</h1>
			<div>
			<div class = "logo" >
				<img src="./images/logo.png"  alt="Logo"  height="70" >
			</div>
		</div>
			       
            
			<!--signup form-->
			<form class="login-form" action="logic.php" method="post" name="signup" id="signup">
				<div class="text-container">
						<input
							spellcheck="false"
							class= "control"
							type= "text"
							name="fname"
							placeholder="First Name"
							id="fname"
							onkeyup="return namesf()"
							
						/>
						<span id="gtickfname"></span>
				</div>

				<div class="text-container">
						<input
							spellcheck="false"
							class= "control"
							type= "text"
							name="lname"
							placeholder="Last Name"
							id="lname"
							onkeyup="return namesl()"
						/>
						<span id="gticklname"></span>
				</div>
				
				<div class="text-container">
						<input
							spellcheck="false"
							class= "control"
							type= "email"
							name="uname"
							placeholder="Email"
							id="uname"
							onkeyup="return email()"
						/>
						<span id="gtick1"></span>
				</div>

				<div class="text-container">
					<input
						spellcheck="false"
						class= "control"
						type= "number"
						name="id"
						placeholder="Id Number"
						id="id"
						onkeyup="return idno()"
					/>
					<span id="gtickid"></span>

				</div>
				<div class="text-container">
					<input
						spellcheck="false"
						class= "control"
						type= "date"
						name="dob"
						id="date"
						
					/>
					<span id="gtickgen"></span>
				</div>
					<select name="gender" class="control" name="gender" id="gender">
							<option value=""style="background:black">Gender</option>
							<option value="Male"style="background:black">Male</option>
							<option value="Female"style="background:black">Female</option>
					</select>
					<div class="text-container">
					<input
						class="control"
						id="password"
						type="password"
						name="password"
						onkeyup="yourElemOnKeyup(this.id)"					
						
					/>
					<span id="gtickpas"></span>
					<span class="toggle-password" id="toggle2" onclick="togglePasswordVisibility('password')">
						<i class="fa fa-eye" id="Toggle"></i>
					</span>
				</div>
				<div class="text-container">
					<input
						class="control"
						id="confirm"
						type="password"
						name="confirm"
						onkeyup="return match()"
						
					/>
					<span id="gtickcon"></span>
					<span class="toggle-password" id="toggle3" onclick="togglePasswordVisibility2('confirm')">
						<i class="fa fa-eye" id="toggle"></i>
					</span>
				</div>

				
				
				<div class="submit">

				<!--password and email validation-->
				<div class="errors">
					<ul>
						<li id="emaill"></li>
						<li id="eight"></li>
						<li id="upper"></li>
						<li id="lower"></li>
						<li id="numerical"></li>
						<li id="special"></li>
						<li id="confirmm"></li>
						
						
					</ul>
				</div>

				<input type="submit" name='submit' class="control2" value="SIGNUP" id="submit">
				</div>
				</form>
				<div class="signup">
				<p style="color:white;">Already have an account? <a href="login.php" style = "color:blue;"> Sign In </a></p>
				</div>

				<div class='darkmode'>
					<i class="fa fa-sun-o" style="font-size:20px;color:red"></i>
					<label class="switch">
  						<input type="checkbox">
  						<span class="slider round"></span>
       		 		</label>
					<i class="fa fa-moon-o" style="font-size:20px;color:red"></i>
				</div>
			</div>

				

			</div>

			
			
						

			<script>
				function togglePasswordVisibility(inputId) {
    				const passwordInput = document.getElementById(inputId);
    				const toggleEye = document.getElementById('Toggle');

    				if (passwordInput.type === 'password') {
       					 passwordInput.type = 'text';
       					 toggleEye.classList.remove('fa-eye');
        				 toggleEye.classList.add('fa-eye-slash');
    				} else {
     				   passwordInput.type = 'password';
     				   toggleEye.classList.remove('fa-eye-slash');
     				   toggleEye.classList.add('fa-eye');
   					 }
				}
			</script>

			<script>
				function togglePasswordVisibility2(inputId) {
    				const confirmInput = document.getElementById(inputId);
    				const toggleEye = document.getElementById('toggle');

    				if (confirmInput.type === 'password') {
       					 confirmInput.type = 'text';
       					 toggleEye.classList.remove('fa-eye');
        				toggleEye.classList.add('fa-eye-slash');
    				} else {
     				   confirmInput.type = 'password';
     				   toggleEye.classList.remove('fa-eye-slash');
     				   toggleEye.classList.add('fa-eye');
   					 }
				}
			</script>
			
			<script>
				function yourElemOnKeyup(id){
     		  	validate(id);
     		 
					}
			</script>
			<script>

					//names validation

					function namesf(){
						var name = document.getElementById('fname');
						if (name.value.length>1 && name.value.length < 20){
							document.getElementById("gtickfname").innerHTML="<span style='color:green'>✔</span>";
						}
						else{
							document.getElementById("gtickfname").innerHTML="<span style='color:red'>X</span>";
						}
					}
					function namesl(){
						var name = document.getElementById('lname');
						if (name.value.length>1 && name.value.length < 20){
							document.getElementById("gticklname").innerHTML="<span style='color:green'>✔</span>";
						}
						else{
							document.getElementById("gticklname").innerHTML="<span style='color:red'>X</span>";
						}
					}
					//email validation
					function email(){
						var email=document.getElementById('uname');
						var validRegex = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-z0-9-]+(?:\.[a-z0-9-]+)*$/;
						if(email.value.match(validRegex)){
							
							document.getElementById("gtick1").innerHTML = "<span style='color:green'>✔</span>";
							document.getElementById("emaill").innerHTML ="";
							submit.disabled=true;

						}else{
							document.getElementById("gtick1").innerHTML = "<span style='color:red'>X</span>";
							document.getElementById("emaill").innerHTML ="<li style='color:red'=>Enter a valid email address</li>";
							submit.disabled=true;

						}

					}

					function idno(){

						var idno=document.getElementById('id');
						if(idno.value.length<8){

							document.getElementById("gtickid").innerHTML = "<span style='color:red'>X</span>";
						}else{
							document.getElementById("gtickid").innerHTML = "<span style='color:green'>✔</span>";
						}
					}

			
					function validate() {
						var pass = document.getElementById('password');
						var confirm = document.getElementById('confirms');
						var submit = document.getElementById('submit');
						var eight = document.getElementById('eight');
						var upper = document.getElementById('upper');
						var lower = document.getElementById('lower');
						var special = document.getElementById('special');
						var numerical = document.getElementById('numerical');

						// Reset all error messages and enable the Submit button
						eight.innerHTML = "";
						upper.innerHTML = "";
						lower.innerHTML = "";
						special.innerHTML = "";
						numerical.innerHTML = "";
						submit.disabled = false;

						// Check each condition
						// Length
						if (pass.value.length < 8) {
							eight.innerHTML = "<li style='color:red'>Minimum password length is 8 characters</li>";
							submit.disabled = true;
						}

						// Number
						if (!pass.value.match(/[0-9]/)) {
							numerical.innerHTML = "<li style='color:red'>Paswword: Use at least one number</li>";
							submit.disabled = true;
						}

						// Uppercase
						if (!pass.value.match(/[A-Z]/)) {
							upper.innerHTML = "<li style='color:red'>Password: Use atleast one uppercase character</li>";
							submit.disabled = true;
						}

						// Lowercase
						if (!pass.value.match(/[a-z]/)) {
							lower.innerHTML = "<li style='color:red'>Password: Use at least one lowercase character</li>";
							submit.disabled = true;
						}

						// Special character
						if (!pass.value.match(/[!/@/#/$/%/^/&/*/?/_/./-/+]/)) {
							special.innerHTML = "<li style='color:red'>Password: Use at least one special character</li>";
							submit.disabled = true;
						}
											// Check if all conditions are met, then display the green checkmark
						if (eight.innerHTML === "" && numerical.innerHTML === "" && upper.innerHTML === "" && lower.innerHTML === "" && special.innerHTML === "") {
							document.getElementById("gtickpas").innerHTML = "<span style='color:green'>✔</span>";
						}
						else{
							document.getElementById("gtickpas").innerHTML = "<span style='color:red'>X</span>";
						}
					}

			</script>
			<script>
				//match password with confirm password
					function match(){
						var pass=document.getElementById('password');
							var confirm=document.getElementById('confirm');

						//passwords match
						if (confirm.value===pass.value){
							document.getElementById("gtickcon").innerHTML = "<span style='color:green'>✔</span>";
							submit.disabled=false;

						}else{
							document.getElementById("gtickcon").innerHTML = "<span style='color:red'>X</span>";

							submit.disabled=true;
							
						}
					}
			</script>
			<script>
					
						//min date 70yrs ago max date 10years ago
						
						var dtToday=new Date();
						var month = dtToday.getMonth()+1;
						var day= dtToday.getDate();
						var year =dtToday.getUTCFullYear()-10;
						var yearm =dtToday.getUTCFullYear()-70;
						
						if (month<10){
						month='0'+month
						}
						if(day<10){
						day='0'+day;}
						
						var maxDate =year+'-'+month+'-'+day;
						var minDate =yearm+'-'+month+'-'+day;

						document.getElementById('date').setAttribute('max',maxDate);
						document.getElementById('date').setAttribute('min',minDate);

					
			</script>
			
			<!--submit data to server -->
			<script>
					$(document).ready(function () {
						$("#signup").submit(function (e) {
							e.preventDefault();
							var fname = $("#fname").val();
							var lname = $("#lname").val();
							var name = $("#uname").val();
							var dob = $("#date").val();
							var gender = $("#gender").val();
							var id = $("#id").val();
							var password = $("#password").val();

							// Clear any previous error messages
							$('#response').html("");

							// Define the 'submit' variable to reference the submit button
							var submit = $("#submit");

							if (name.length === 0 || gender.length === 0 || id.length === 0 || dob.length === 0 || lname.length === 0 || password.length === 0 || fname.length === 0) {
								$('#response').html("All fields are required!").css('color', 'red');
								$('.text-container').css('box-shadow', '0px 0px 0px 1px red');
							} else {
								$.ajax({
									url: "logic.php",
									method: "POST",
									data: { fname:fname, lname:lname, uname: name, id: id, dob: dob, gender: gender, password: password },
									
									success: function (data) {
										 // Clear loading indicator
											$("#response").html("");

											if (data.message === "error") {
												$('#response').html("All fields are required!").css('color', 'red');
											} else if (data.message === "success") {
												window.location.href = "http://localhost/Clothline/index.php?Successful";
											}
											else if (data.message === "exists") {
												$('#response').html("The username provided already exists. Log in to continue.").css('color', 'red');
											}																					
										
									},
									error: function (xhr, textStatus, errorThrown) {
										// Handle Ajax errors
										$('#response').html("An error occurred while processing your request.").css('color', 'red');
									}
								});
							}
						});
					});
			</script>

			
	</body>
	
</html>
