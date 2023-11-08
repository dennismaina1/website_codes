<?php  //this is also too simple. just connect the database, control input values and response
   session_start();
   require 'connect.php';

if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordhash=password_hash($password,PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $count = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($count == 1) {
        $passworddb = $row['passwords'];
        $idnumber = $row['idnumber'];
        
        if (password_verify($password, $passworddb)) {
            $_SESSION['id'] = $idnumber;
            $response = array("message" => 'success');
            header("Content-Type: application/json"); // Set the response header
            echo json_encode($response); // Return the JSON response
          } else {
            $response = array("message" => 'wrong password');
            header("Content-Type: application/json"); // Set the response header
            echo json_encode($response); // Return the JSON response
        }
    } else {
        $response = array("message" => 'wrong username');
        header("Content-Type: application/json"); // Set the response header
        echo json_encode($response); // Return the JSON response
    }
}

?>