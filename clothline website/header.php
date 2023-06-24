<?php
include 'connect.php';
 session_start();
 if (isset($_SESSION['id']))
 {
   $idnumber = $_SESSION['id'];
   try {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_no=:id_number");
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
  session_destroy();
  header("location:login.php");

}

// Close the database connection
$conn = null;

?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
<style>
.dropdown {
  float: right;
  overflow: hidden;
  background-color: maroon;
}

/* Dropdown button */
.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: White;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Add a red background color to navbar links on hover */
.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  max-width: 80px;
  box-shadow: 0px 2px 1px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 6px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
  }
</style>
</head>
<body>
  <nav>
    <ul>
      <li><a href="homepage.php" <?php if ($currentPage === 'home') { echo 'class="active"'; } ?>>Home</a></li>
      <li><a href="homepage.php#swipper" <?php if ($currentPage === 'brands') { echo 'class="active"'; } ?>>Brands</a></li>
      <li><a href="contactus.php" <?php if ($currentPage === 'contact') { echo 'class="active"'; } ?>>Contact Us</a></li>
          
          <div class="dropdown">
        <button class="dropbtn"><?php echo $fname; ?>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="logout.php">LOGOUT</a>
        </div>
      </div>
    </ul>
  </nav>