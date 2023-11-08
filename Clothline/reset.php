
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Log Yourself In</title>
		<link rel="stylesheet" href="css/reset.css">
		
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="js/darkmode2.js"></script>

        <style>
            .reset-form .errors #emaill{

                list-style-type: none;
            }
        </style>

	</head>
	<body>

	
		<div class="reset-card">

		    <!--server validation response-->
            <div class="response" id="response" style="position: absolute; "></div>

            <div class ="header" >
                <div class ="title">
                    <h1>Find your account</h1>
                    <p>Enter the email associated with your account to change your password.</p>
                <div>
                <div class = "logo" >
                    <img src="./images/logo.png"  alt="Logo"  height="70" >
                </div>
            </div>
			 
            <div class = "container">
                
                <!--signup form-->
                <form class="reset-form" action="reset.php" method="post" name="reset" id="reset">
                <div id ="label1">Email</div>
                    <div class="text-container">
                            <input
                                spellcheck="false"
                                class= "control"
                                type= "email"
                                name="uname"
                                placeholder="john@doe.com"
                                id="uname"
                                onkeyup="return email()"
                            />
                            <span id="gtick1"></span>
                    </div>

                    <div class="text-container2">
                        <input type="submit" name='submit' class="control" value="RESET PASSWORD" id="submit">
                        
                    </div>
                    <div class="errors" style="position: absolute; ">
                            <ul>
                                <li id="emaill"></li> 
                            </ul>
                    </div>
                    <div class="goback" >
			            <a href="login.php" style = "color:White;"> <- back to Sign-in </a>
			        </div>

                <form>
                    <!--darkmode-->
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
        <div>
    </body>
    <script>
               
                const response = document.getElementById("uname");
                response.addEventListener("input", showGtickDiv);
                function showGtickDiv() {
                   
                    $('#response').css("display", "none");

                }
               
            </script>

    <script>
        //email validation
					function email(){
						var email=document.getElementById('uname');
						var validRegex = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-z0-9-]+(?:\.[a-z0-9-]+)*$/;
						if(email.value.match(validRegex)){
							
							document.getElementById("gtick1").innerHTML = "<span style='color:green'>✔</span>";
							document.getElementById("emaill").innerHTML ="";
							

						}else{
							document.getElementById("gtick1").innerHTML = "<span style='color:red'>X</span>";
							document.getElementById("emaill").innerHTML ="<li style='color:red'=>Enter a valid email address</li>";
							

						}

					}
    </script>

    <script>
        $(document).ready(function() {
    $(".reset-form").submit(function(e) {
        e.preventDefault();
        var email = $("#uname").val();
        var error = $("#emaill").val();

        if (email.length == "" ) {
            $('#response').css("display", "block");
            $('#response').html("Email is required!").css('color', 'red');
            $('.control').css('box-shadow', '3px 3px 3px 3px red');
            return false;
        }
        else if (error != ""){
            $('#response').css("display", "block");
            $('#response').html("Enter a valid email address!").css('color', 'red');
            $('.control').css('box-shadow', '3px 3px 3px 3px red');
            return false;
        } else {
            $.ajax({
                url: "resetpass.php",
                method: "POST",
                data: { email: email },
                
                success: function(data) {
                    $("#response").html("");
                    data = JSON.parse(data);

                    if (data.message === "success") {
                        $('#response').css("display", "block");
                        $('#response').html("A link to reset the password has been sent to your email.").css('color', 'green');
                    } else if (data.message === "error") {
                        $('#response').css("display", "block");
                        $('#response').html("Invalid email address. Please enter a valid email.").css('color', 'red');
                    } else if  (data.message === "invalid"){
                        $('#response').css("display", "block");
                        $('#response').html("No user found registered with those credentials!").css('color', 'red');
                    }
                    else if (data.message === "Email Error"){
                        $('#response').css("display", "block");
                        $('#response').html("Error sending email. Try again later!").css('color', 'red');
                    }
                    else if (data.message === "token_exists"){
                        $('#response').css("display", "block");
                        $('#response').html("Use the link that has been sent to your Email!").css('color', 'Green');
                    }
                }
            });
        }
    });
});

    </script>
</html>


