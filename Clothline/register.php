<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
        body { background-image:url("images\\background.jpg");}
    </style>
</head>
<body>
<div class="container">
    <div class="form-wrapper">
	<h2>Signup</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="fname">First Name:</label>
		<input type="text" name="fname" required><br><br>

		<label for="lname">Last Name:</label>
		<input type="text" name="lname" required><br><br>

		<label for="id_number">ID Number:</label>
		<input type="text" name="id_number" required><br><br>

		<label for="password">Password:</label>
		<input type="password" name="password" required><br><br>

		<label for="repeat_password">Repeat Password:</label>
		<input type="password" name="repeat_password" required><br><br>

		<input type="submit" value="Signup">
	</form>

	<?php
		// check if form is submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$fname = test_input($_POST["fname"]);
			$lname = test_input($_POST["lname"]);
			$id_number = test_input($_POST["id_number"]);
			$password = test_input($_POST["password"]);
			$repeat_password = test_input($_POST["repeat_password"]);

			if ($password !== $repeat_password) {
				echo "<p>Passwords do not match.</p>";
			} else {
                // prepare sql statement
                      $stmt = $conn->prepare("INSERT INTO users (fname, lname, id_no, password) VALUES (:fname, :lname, :id_number, :password)");

        // bind parameters
                     $stmt->bindParam(':fname', $fname);
                     $stmt->bindParam(':lname', $lname);
                     $stmt->bindParam(':id_number', $id_number);
                     $stmt->bindParam(':password', $password);

        // execute statement
                    $stmt->execute();
				// perform database insert or other action here
				    echo "<p>Signup successful!</p>";
					$_SESSION['id'] = $id_number;
					header('location:homepage.php');
			}
		}

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
