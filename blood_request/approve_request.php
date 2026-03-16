<?php
include "../config/config.php";

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM blood_request WHERE request_id='$id'");
$row = mysqli_fetch_assoc($result);

$blood_group = $row['blood_group'];
$quantity = $row['quantity'];

mysqli_query($conn,"UPDATE blood_request SET status='Approved' WHERE request_id='$id'");

mysqli_query($conn,"UPDATE blood_inventory 
SET units_available = units_available - $quantity
WHERE blood_group='$blood_group'");

header("Location:view_request.php");

?>