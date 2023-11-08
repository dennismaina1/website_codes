<?php
session_start();
include 'connect.php';
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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin-bottom: 20px;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #f2f2f2;
		}

		tr:hover {
			background-color: #f5f5f5;
		}

		.button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin-bottom: 20px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<h1>Checkout  For - <?php echo $fname; ?></h1>
	<?php
// Retrieve the current user ID


// Prepare a SQL statement to select all cart items for the current user
$stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ?");
$stmt->bindParam(1, $idnumber);
$stmt->execute();

// Display the checkout table header
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>Item Name</th>';
echo '<th>Item Price</th>';
echo '<th>Item Quantity</th>';
echo '<th>Item Total</th>';
echo '<th>Delete Item</th>';
echo '</tr>';
echo '</thead>';

// Loop through the results and display them in the checkout table
echo '<tbody>';
$total = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $itemName = $row['title'];
    $itemPrice = $row['price'];
    $itemQuantity = $row['quantity'];
    $itemId = $row['id'];
    $itemPrice = -($itemPrice);
    
    $itemTotal = $itemPrice * $itemQuantity;
    $total;
    $total += $itemTotal; 
    
    // Add the item total to the cart total
  
    
    // Display the item in the checkout table
    echo "<tr>";
    echo "<td>{$itemName}</td>";
    echo "<td>{$itemPrice}</td>";
    echo "<td>{$itemQuantity}</td>";
    echo "<td>{$itemTotal}</td>";
    echo "<td><button class='delete-btn' data-item-id='" . $itemId . "'>Delete</button></td>";
    echo "</tr>";
}

// Display the cart total
echo "<tr>";
echo "<td colspan='3'><strong>Total:</strong></td>";
echo "<td><strong>{$total}</strong></td>";
echo "</tr>";
echo '</tbody>';
echo '</table>';
?>

	<button class="button">Proceed to Checkout</button>

        <script>
    // Select all delete buttons and add a click event listener
    var deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            var itemId = deleteBtn.getAttribute('data-item-id');

            // Send an AJAX request to delete the item from the database
            var xhr = new XMLHttpRequest();
            var url = "delete_item.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Remove the table row for the deleted item
                    var tableRow = deleteBtn.parentNode.parentNode;
                    tableRow.parentNode.removeChild(tableRow);
                    calculateTotal();
                }
            };
            var data = "item_id=" + encodeURIComponent(itemId);
            xhr.send(data);
        });
    });

    function calculateTotal() {
  const itemPrices = document.querySelectorAll('.item-price');
  let total = 0;
  itemPrices.forEach((itemPrice) => {
    total += parseFloat(itemPrice.textContent);
  });
  const totalElement = document.getElementById('total');
  totalElement.textContent = total.toFixed(2);
}
</script>

        
</body>
</html>
