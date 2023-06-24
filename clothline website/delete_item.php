<?php
include 'connect.php';
// Retrieve the item ID to delete from the request data
$itemId = $_POST['item_id'];

// Prepare a SQL statement to delete the item from the cart_items table
$stmt = $conn->prepare("DELETE FROM cart_items WHERE id = ?");
$stmt->bindParam(1, $itemId);
$stmt->execute();

// Return a success response
echo "Item deleted successfully";
?>
