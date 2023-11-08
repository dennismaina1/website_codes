<?php
require "connect.php";
if (isset($_GET['key']) && isset($_GET['email'])) {
    $key = $_GET['key'];
    $email = $_GET['email'];

}
else{

    $key = "";
    $email = "";
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Set New Password</title>
        <link rel="stylesheet" href="css/reset.css">     
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="js/darkmode2.js"></script>


        <style>
             .errors *{

                list-style-type: none;
            }
        </style>

	</head>
	<body>

	
		<div class="reset-card" >

            <div class="response" id="response" style="position: absolute; "></div>


            <div class ="header" >
                <div class ="title">
                    <h1>SET NEW PASSWORD</h1>
                <div>
                <div class = "logo" >
                    <img src="./images/logo.png"  alt="Logo"  height="110" >
                </div>
            </div>         
                <!--signup form-->
            <form class="reset-form" action="resetpagelogic.php" method="post" name="reset" id="reset">
                    <div id ="label1">New Password</div>
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
                    <div id ="label2">Confirm New Password</div>
                    <div class="text-container">
                        <input
                            class="control"
                            id="confirms"
                            type="password"
                            name="confirm"
                            onkeyup="match()"					
                            
                        />
                        <span id="gtickcon"></span>
                        <span class="toggle-password" id="toggle2" onclick="togglePasswordVisibility2('confirms')">
                            <i class="fa fa-eye" id="toggle"></i>
                        </span>
                    </div>
                    <div class="text-container2">
                        <input type="submit" name='submit' class="control" value="SUBMIT" id="submit">
                        
                    </div>
                
            </form>
            <div class="errors" style="position: absolute; ">
					<ul>
						
						<li id="eight"></li>
						<li id="upper"></li>
						<li id="lower"></li>
						<li id="numerical"></li>
						<li id="special"></li>
						<li id="confirmm"></li>
						
						
					</ul>
				</div>

                <div class="goback" id="goback" style="display:none; margin-top:5%;margin-bottom:5%;position: absolute; ">
			            <a href="login.php" style = "color:White;"> <- back to Sign-in </a>
			    </div>
		    
                    <!--darkmode-->
			    <div class="darkmodes">
				    <i class="fa fa-sun-o" style="font-size:20px;color:red"></i>
				    <label class="switch">
  				    	<input type="checkbox">
  				    	<span class="slider round"></span>
					
       			    </label>
				    <i class="fa fa-moon-o" style="font-size:20px;color:red"></i>
			    </div>

              
            
        <div>
    </body>
    
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
						

						// Check each condition
						// Length
						if (pass.value.length < 8) {
							eight.innerHTML = "<li style='color:red'>Minimum password length is 8 characters</li>";
							
						}

						// Number
						if (!pass.value.match(/[0-9]/)) {
							numerical.innerHTML = "<li style='color:red'>Paswword: Use at least one number</li>";
							
						}

						// Uppercase
						if (!pass.value.match(/[A-Z]/)) {
							upper.innerHTML = "<li style='color:red'>Password: Use atleast one uppercase character</li>";
							
						}

						// Lowercase
						if (!pass.value.match(/[a-z]/)) {
							lower.innerHTML = "<li style='color:red'>Password: Use at least one lowercase character</li>";
							
						}

						// Special character
						if (!pass.value.match(/[!/@/#/$/%/^/&/*/?/_/./-/+]/)) {
							special.innerHTML = "<li style='color:red'>Password: Use at least one special character</li>";
							
						}
											// Check if all conditions are met, then display the green checkmark
						if (eight.innerHTML === "" && numerical.innerHTML === "" && upper.innerHTML === "" && lower.innerHTML === "" && special.innerHTML === "") {
							document.getElementById("gtickpas").innerHTML = "<span style='color:green' >✔</span>";
                            submit.disabled=false;
						}
						else{
							document.getElementById("gtickpas").innerHTML = "<span style='color:red' >X</span>";
                            submit.disabled=true;
						}
					}

			</script>
            <script>
				//match password with confirm password
					function match(){
						var pass=document.getElementById('password');
							var confirm=document.getElementById('confirms');

						//passwords match
						if (confirm.value===pass.value){

							document.getElementById("gtickcon").innerHTML = "<span style='color:green'>✔</span>";
							submit.disabled=false;

						}else{
							document.getElementById("gtickcon").innerHTML = "<span style='color:red'>X</span>";
                            submit.disabled=false;
	
							
						}
					}
			</script>
            <script>
                const passwordField1 = document.getElementById("password");
                const passwordField2 = document.getElementById("confirms");

                passwordField1.addEventListener("input", showGtickDiv);
                passwordField2.addEventListener("input", showGtickDiv2);
            

                function showGtickDiv() {
                    // Show the gtickpas div when the user starts typing
                    $('#gtickpas').css("display", "block");
                    $('#response').css("display", "none");

                }
                function showGtickDiv2() {
                    // Show the gtickpas div when the user starts typing
                    $('#gtickcon').css("display", "block");
                    $('#response').css("display", "none");
                }
            </script>
        <script>
        $(document).ready(function() {
            $(".reset-form").submit(function(e) {
            e.preventDefault();
            var password = $("#password").val();
            var confirm = $("#confirms").val();
            
            if (password.length === ""  || confirm.length === "") {
                $('#response').html("All Fields are required!").css('color', 'red');
                $('.control').css('box-shadow', '3px 3px 3px 3px red');
                return false;
            }
            else if ( password !== confirm){

                $('#response').css("display", "block");
                $('#response').html("Passwords do not match. Try Again").css('color', 'red');
                $('#password').val("");
                $('#confirms').val("");
                $('#gtickpas').css("display", "none");

            }
             else {
                $.ajax({
                    url: "resetpagelogic.php",
                    method: "POST",
                    data: {  password: password,
                             confirm: confirm,
                            key: "<?php echo $key; ?>", // Pass the key, email, and action as well
                             email: "<?php echo $email; ?>",
                         },
                    
                    success: function(data) {
                        $("#response").html("");
                        data = JSON.parse(data);

                        if (data.message === "success") {
                            $('#goback').css("display", "block");
                            $('#response').css("display", "block");
                            $('#response').html("Password Reset Successfully. Use the link below to Sign In").css('color', 'green');
                            
                        } else if (data.message === "no match") {
                            $('#response').css("display", "block");
                            $('#response').html("Ensure the passwords entered match").css('color', 'red');

                        } else if  (data.message === "invalid"){
                            $('#response').css("display", "block");
                            $('#response').html("Expired or Used token ").css('color', 'red');
                           
                        }
                        else if (data.message === "fail"){
                            $('#response').css("display", "block");
                            $('#response').html("Error ressetting password.Try again later").css('color', 'red');
                        }
                    }
                });
            }
        });
});

    </script>
    </html>