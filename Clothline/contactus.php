<?php
  // index.php

  $title = "Contact Us";
  $currentPage = "contact";
  include "header.php";
  include "connect.php";
  if (isset($_SESSION['id']))
 {
   $idnumber = $_SESSION['id'];
   try {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE idnumber=:id_number");
    $stmt->bindParam(':id_number', $idnumber);
    $stmt->execute();

    // Check if the login was successful
    if ($stmt->rowCount() == 1) {
      // Login successful, set the session variable and redirect
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $fname = $row['fname'];
        } else {
            // Login failed, display error message
        }
    } catch(PDOException $e) {
        // Handle any exceptions thrown by PDO
        echo "Error: " . $e->getMessage();
    }
}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
   
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // send email
    $stmt = $conn->prepare("INSERT INTO contactus (email, subject, message,id_number) VALUES (:email, :subject, :message,:id_number)");

        // bind parameters
                     $stmt->bindParam(':email', $email);
                     $stmt->bindParam(':subject', $subject);
                     $stmt->bindParam(':id_number', $idnumber);
                     $stmt->bindParam(':message', $message);

        // execute statement
                    $stmt->execute();
				// perform database insert or other action here
				    echo "<p>Message sent  successfully!</p>";
						header('location:contactus.php');

    // redirect to thank you page
    //header("Location: thankyou.php");
    exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title<?php echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="css/contactus.css">
  <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <style>
        body { background-image:url("images\\background.jpg");}
    </style>
</head>
<body>
<div class="container">

               
      <div class ="head">  
          <h1>Lets Have A Chat!</h1>
      
      </div>
    
 
<div class="form-wrapper">
  <form action="contactus.php" method="post">
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class= "control" required >

    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject"  class= "control" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message"  class= "control" required></textarea>

    <input type="submit" value="Submit"  class= "control">
  </form>
</div>
</div>

</body>
<script>
    // script.js
// handle the active class for navigation links
const currentLocation = location.href;
const navLinks = document.querySelectorAll("nav ul li a");
const navLength = navLinks.length;
for (let i = 0; i < navLength; i++) {
  if (navLinks[i].href === currentLocation) {
    navLinks[i].classList.add("active");
  }
}
    </script>
</html>