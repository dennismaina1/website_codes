<?php
require "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $key = $_POST['key'];
    $email = $_POST['email'];
 
    // Validate the password and confirm password fields
    if ($password !== $confirm) {
        $response = array("message" => 'no match');
        echo json_encode($response);
        exit;
    }

    // Additional validation (e.g., password complexity) can be added here

    // Query to check the token's validity
    $query = "SELECT * FROM password_reset_temp WHERE `key` = :key AND email = :email AND used = 0 AND expDate >= NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':key', $key);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $used = $row['used'];
    $count = $stmt->rowCount();

    if ($count === 0) {
        // Token is invalid or expired
        $response = array("message" => 'invalid');
        echo json_encode($response);
        exit;
    }
   

    // Update the user's password in the "users" table
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $updateQuery = "UPDATE users SET passwords = :passwords WHERE username = :email";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':passwords', $hashedPassword);
    $updateStmt->bindParam(':email', $email);

    if ($updateStmt->execute()) {
        // Password changed successfully
        $response = array("message" => 'success');
        echo json_encode($response);
        // Update the token's "used" status to 1
        $updateTokenQuery = "UPDATE password_reset_temp SET used = 1 WHERE email = :email";
        $updateTokenStmt = $conn->prepare($updateTokenQuery);
        $updateTokenStmt->bindParam(':email', $email);
        $updateTokenStmt->execute();
    } else {
        $response = array("message" => 'fail');
        echo json_encode($response);
    }
}
else {
    $response = array("message" => 'fail');
    echo json_encode($response);
}

?>
