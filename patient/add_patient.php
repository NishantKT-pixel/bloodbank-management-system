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
include "../config/config.php";

if(isset($_POST['submit']))
{

$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$query = "INSERT INTO patient(name,age,gender,blood_group,phone,address)
VALUES('$name','$age','$gender','$blood_group','$phone','$address')";

mysqli_query($conn,$query);

echo "Patient added successfully";

}
?>

<h2>Add Patient</h2>

<form method="POST">

Name<br>
<input type="text" name="name" required><br><br>

Age<br>
<input type="number" name="age" required><br><br>

Gender<br>
<select name="gender">
<option>Male</option>
<option>Female</option>
</select><br><br>

Blood Group<br>
<select name="blood_group">
<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>AB+</option>
<option>AB-</option>
<option>O+</option>
<option>O-</option>
</select><br><br>

Phone<br>
<input type="text" name="phone"><br><br>

Address<br>
<textarea name="address"></textarea><br><br>

<button name="submit">Add Patient</button>

</form>
<br><br>
<a href="../admin/dashboard.php" >Back to dashboard</a>