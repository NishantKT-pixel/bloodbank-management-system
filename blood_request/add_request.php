<style>
body {
    font-family: Arial;
}

table {
    border-collapse: collapse;
    width: 80%;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background-color: black;
    color: white;
}

a {
    text-decoration: none;
}
</style>
<div style="background:blue;padding:20px;">

<a href="../admin/dashboard.php" style="color:white;margin-right:10px;">Dashboard</a>

<a href="../donor/add_donor.php" style="color:white;margin-right:10px;">Add Donor</a>

<a href="../donor/view_donor.php" style="color:white;margin-right:10px;">View Donor</a>

<a href="../patient/add_patient.php" style="color:white;margin-right:10px;">Add Patient</a>

<a href="../patient/view_patient.php" style="color:white;margin-right:10px;">View Patient</a>

<a href="../blood_donation/add_donation.php" style="color:white;margin-right:10px;">Add Donation</a>

<a href="../blood_donation/view_donation.php" style="color:white;margin-right:10px;">View Donation</a>

<a href="../blood_request/add_request.php" style="color:white;margin-right:10px;">Add Request</a>

<a href="../blood_request/view_request.php" style="color:white;margin-right:10px;">View Request</a>

<a href="../blood_inventory/view_inventory.php" style="color:white;margin-right:10px;">Inventory</a>

<a href="../admin/logout.php" style="color:red;margin-right:20px;">Logout</a>

</div>

<br>
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

Patient:
<select name="patient_id">

<?php
$result = mysqli_query($conn,"SELECT * FROM patient");

while($row = mysqli_fetch_assoc($result))
{
?>
<option value="<?php echo $row['patient_id']; ?>">
<?php echo $row['name']; ?>
</option>

<?php
}
?>

</select>
<br>

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
