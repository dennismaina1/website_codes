<?php
session_start();
require('connect.php');

if(isset($_POST['uname']) && isset($_POST['password'])){
    // Pick data from forms and save them to variables
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $id = $_POST['id'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $phone ="0000000000";

    // Check if variables are empty
    if(empty($uname) || empty($id) || empty($dob) || empty($gender) || empty($password)){
      header("Content-Type: application/json"); // Set the response header  
      $response = json_encode(array("message" => "empty"));
      echo $response;
      
    } else {
      //check if user exists
      $sql = "SELECT * FROM users WHERE username = :username";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':username', $uname);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($count == 1) {
        $response = array("message" => 'exists');
        header("Content-Type: application/json"); // Set the response header
        echo json_encode($response); // Return the JSON response
      }
      else{

        // Hash the password before storing it to the database
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Save data to the database
        $query = "INSERT INTO users (fname, lname, username, dob, gender, passwords, idnumber,phone) VALUES ('$fname','$lname','$uname', '$dob', '$gender', '$password', '$id','$phone')";

        // Connect and execute query
        if ($conn->query($query) == TRUE) {
          $_SESSION['id'] = $id;
          $response = array("message" => 'success');
          header("Content-Type: application/json"); // Set the response header
          echo json_encode($response); // Return the JSON response
        } else {
          $response = array("message" => 'error');
          header("Content-Type: application/json"); // Set the response header
          echo json_encode($response); // Return the JSON response
        }
               
    }}
} else {
    echo "no data";
}
?>
