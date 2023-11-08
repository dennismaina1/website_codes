<?php
include 'connect.php';
 session_start();
 if (isset($_SESSION['id']) && $_SESSION['id'] != 0)
 {
   $idnumber = $_SESSION['id'];
   try {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT fname FROM users WHERE idnumber=:id_number");
    $stmt->bindParam(':id_number', $idnumber);
    $stmt->execute();

    // Check if the login was successful
    if ($stmt->rowCount() == 1) {
      // Login successful, set the session variable and redirect
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $fname = $row['fname'];
        } else {
            // Login failed, display error message
            echo "<p>Invalid ID number or password.</p>";
        }
    } catch(PDOException $e) {
        // Handle any exceptions thrown by PDO
        echo "Error: " . $e->getMessage();
    }
}
else{
  
  $fname = 'Guest';
  $_SESSION['id'] = '0';

}

// Close the database connection
$conn = null;

?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/homepage.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="js/darkcontent.js"></script>
  <script src="js/header.js"></script>



  <style>
/* Center the icons vertically and horizontally */




</style>
  
</head>
<body >
  <nav class="navbar" id ="navbar">
    <ul>
      <li class="logo-icon">
        <a href="index.php">
          <img src="./images/logo2.png" alt="Logo"  height="60" >
        </a>
      </li>
      <li><a href="index.php" <?php if ($currentPage === 'home') { echo 'class="active"'; } ?>>Home</a></li>
      <li><a href="index.php#swipper" <?php if ($currentPage === 'brands') { echo 'class="active"'; } ?>>Brands</a></li>
      <li><a href="contactus.php" <?php if ($currentPage === 'contact') { echo 'class="active"'; } ?>>Contact Us</a></li>
      <li class="dark">
      <div class="darkmode" style>
          <div class="centered-icons">
            <button id="darkModeToggle" class="toggle-button centered-darkmode">
              <i class="fa fa-sun" ></i>
            </button>
          <div>
      </div>
      
      </li>

      <li class="dropdown">
        <div>
          <?php
        
            if ($_SESSION['id'] != '0') {
            
          ?>
          <select class="dropbtn" onchange="location = this.value;">
            <option value=""><?php echo $fname; ?></option>
            <option value="profile.php">Profile</option>
            <option value="logout.php">Logout</option>
          </select>
          <?php
            } else {
          ?>
          <select class="dropbtn" onchange="location = this.value;">
            <option value="">Guest</option>
            <option value="login.php">Login</option>
          </select>
          <?php
            }
          ?>
        </div>
      </li>
      <!--greeting message-->
      <li id="greeting" class="greeting"></li>
      
    </ul>
    
  </nav>