<?php
require_once("../config/config.php");

if(isset($_POST['submit']))
{
$patient_id = $_POST['patient_id'];
$blood_group=$_POST['blood_group'];
$request_date = date("Y-m-d");
$quantity = $_POST['quantity'];



$query = "INSERT INTO blood_request(patient_id,blood_group,request_date,quantity,status)
VALUES('$patient_id','$blood_group','$request_date','$quantity','Pending')";

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


Blood Group:
<select name="blood_group">
<option value="A+">A+</option>
<option value="A-">A-</option>
<option value="B+">B+</option>
<option value="B-">B-</option>
<option value="O+">O+</option>
<option value="O-">O-</option>
<option value="AB+">AB+</option>
<option value="AB-">AB-</option>
</select>
<br><br>


Quantity:<br>
<input type="number" name="quantity"><br><br>

<input type="submit" name="submit" value="Submit">

</form>

</body>
</html>
<br><br>
<a href="../admin/dashboard.php" >Back to dashboard</a>
