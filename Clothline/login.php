<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Log Yourself In</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="js/darkmode.js"></script>
	</head>
	<body style="background-image: url('images/background.jpg');" >
		<div class="login-card" id="login-card-1">
        	<div class="response" id="response"></div>


			<div class ="header" style="transform: translateY(12%);">
				<div class ="title">
					<h1>SIGN IN</h1>
				<div>
				<div class = "logo" >
					<img src="./images/logo.png"  alt="Logo"  height="70" >
				</div>
			</div>

		
			<form class="login-form" id="login" action="logic1.php" style="transform: translateY(20%);">
					<input
						spellcheck="false"
						class= "control"
						type= "text"
						placeholder="Username"
						name="username"
						id="username"
					/>
					<div class="password">
					<input
						class="control"
						id="password"
						type="password"
						placeholder="Password"
						name="password"
						id="password"
					/>
					
					</div>
					<div class="submit">
					<input type="submit" name='login' class="control2" value="LOGIN" id="submit">
					</div>
			</form>
			<div class="fpassword" style="transform: translateY(150%);">
			<p style="color:white;">Forgot Password? <a href="reset.php" style = "color:blue;"> Reset </a></p>
			</div>
			<div class="signup" style="transform: translateY(150%);">
				 <p style="color:white;">Don't have an account? <a href="signup.php" style = "color:blue;"> Sign Up </a></p> 
			</div>

			<!--darkmode-->
			<div class='darkmode' style="transform: translateY(200%);">
				<i class="fa fa-sun-o" style="font-size:20px;color:red"></i>
				<label class="switch">
  					<input type="checkbox">
  					<span class="slider round"></span>
					
       			</label>
				<i class="fa fa-moon-o" style="font-size:20px;color:red"></i>
			</div>
		</div>
			
		   <script type="text/javascript" >

		$(document).ready(function(){
					$(".login-form").submit(function(e){

					e.preventDefault();
					var name=$("#username").val();
					var password=$("#password").val();
					var session;

					
				if(name.length == "" || password.length==""){
					$('#response').html("All fields are required !!!").css('color','red');
					$('.control').css('box-shadow', '3px 3px 3px 3px red');
					return false;}

				else{
					// ajax method to validate uname and pass to logic 1 server 
					$.ajax({

						url:"logic1.php",
						method:"POST",
						data:{username:name ,password:password},
						beforeSend: function(){
							// Show image container
							$("#response").html("<img src='https://i.imgur.com/pKopwXp.gif&#39' width='32px' height='32px'>");
						},
						success:function(data){
							$("#response").html("");

							if (data.message === "wrong password") {
								$('#response').html("Invalid password/password").css('color', 'red');
							
							} else if (data.message === "success") {
								window.location.href = "http://localhost/Clothline/index.php?Successful";
							}	
							else if (data.message === "wrong username") {
								$('#response').html("Invalid username/password").css('color', 'red');
							}		
						}					
						});
					}

				})
			})


		</script>
	</body>
</html>
