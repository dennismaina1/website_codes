<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
        body { background-image:url("images\\background.jpg");}
    </style>
</head>
<body>
<div class="container">
    <div class="form-wrapper">
	<h2>Login</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="id_number">ID Number:</label>
		<input type="text" name="id_number" required><br><br>

		<label for="password">Password:</label>
		<input type="password" name="password" required><br><br>

		<input type="submit" value="Login">
	</form>

	<?php
		// check if form is submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id_number = test_input($_POST["id_number"]);
			$password = test_input($_POST["password"]);
		
			try {
				// Prepare and execute the SQL statement
				$stmt = $conn->prepare("SELECT * FROM users WHERE id_no=:id_number AND password=:password");
				$stmt->bindParam(':id_number', $id_number);
				$stmt->bindParam(':password', $password);
				$stmt->execute();
		
				// Check if the login was successful
				if ($stmt->rowCount() == 1) {
					// Login successful, set the session variable and redirect
					$_SESSION['id'] = $id_number;
					header("Location: homepage.php");
					exit;
				} else {
					// Login failed, display error message
					echo "<p>Invalid ID number or password.</p>";
				}
			} catch(PDOException $e) {
				// Handle any exceptions thrown by PDO
				echo "Error: " . $e->getMessage();
			}
		}
		
		// Close the database connection
		$conn = null;

		// function to sanitize form inputs
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	</div>
  </div>
</body>
</html>
