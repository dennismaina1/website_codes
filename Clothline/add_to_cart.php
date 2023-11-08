<?php
session_start();
include 'connect.php';

// Get the item data from the AJAX request
$title = $_POST['title'];
$price = $_POST['price'];
$quantity =$_POST['quantity'];
$id = $_POST['userId'];

// Insert the cart item into the database
$sql = "INSERT INTO cart_items (title, price, quantity, user_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$title, $price, $quantity, $id]);


// Close the database connection
$conn = null;