<?php
include "../config/config.php";

$id = $_GET['id'];

// Get request details
$result = mysqli_query($conn,"SELECT * FROM blood_request WHERE request_id='$id'");
$row = mysqli_fetch_assoc($result);

$blood_group = $row['blood_group'];
$quantity = $row['quantity'];

// Check inventory
$check = mysqli_query($conn,"SELECT units_available FROM blood_inventory WHERE blood_group='$blood_group'");
$data = mysqli_fetch_assoc($check);

$available = $data['units_available'];

if($available >= $quantity)
{
    // Approve request
    mysqli_query($conn,"UPDATE blood_request SET status='Approved' WHERE request_id='$id'");

    // Decrease inventory
    mysqli_query($conn,"UPDATE blood_inventory 
    SET units_available = units_available - $quantity
    WHERE blood_group='$blood_group'");

    echo "Request Approved Successfully";
}
else
{
    echo "Not enough stock. Request cannot be approved.";
}

?>
<br><br>
<a href="view_request.php">Back</a>