<?php
include 'config.php';

if(isset($_POST['submit']))
{
$patient_id = $_POST['patient_id'];
$inventory_id = $_POST['inventory_id'];
$request_date = $_POST['request_date'];
$quantity = $_POST['quantity'];
$status = $_POST['status'];

$query = "INSERT INTO blood_request(patient_id,inventory_id,request_date,quantity,status)
VALUES('$patient_id','$inventory_id','$request_date','$quantity','$status')";

mysqli_query($conn,$query);

echo "Blood request added successfully";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Blood Request</title>
</head>

<body>

<h2>Add Blood Request</h2>

<form method="POST">

Patient ID:<br>
<input type="text" name="patient_id"><br><br>

Inventory ID:<br>
<input type="text" name="inventory_id"><br><br>

Request Date:<br>
<input type="date" name="request_date"><br><br>

Quantity:<br>
<input type="number" name="quantity"><br><br>

Status:<br>
<select name="status">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>
</select>

<br><br>

<input type="submit" name="submit" value="Submit">

</form>

</body>
</html>
