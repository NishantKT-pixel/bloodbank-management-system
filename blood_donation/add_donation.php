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
?>

<h2>Add Blood Donation</h2>

<form method="POST">

Donor ID:
<select name="donor_id">

<?php
$result = mysqli_query($conn,"SELECT * FROM donor");

while($row = mysqli_fetch_assoc($result))
{
?>
<option value="<?php echo $row['donor_id']; ?>">
<?php echo $row['name']; ?>
</option>

<?php
}
?>

</select>
<br><br>

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

Quantity:
<input type="number" name="quantity" required>

<br><br>

<input type="submit" name="submit" value="Add Donation">

</form>

<?php

if(isset($_POST['submit']))
{
$donor_id = $_POST['donor_id'];
$blood_group = $_POST['blood_group'];
$quantity = $_POST['quantity'];
$donation_date = date("Y-m-d");

mysqli_query($conn,"INSERT INTO blood_donotion(donor_id,blood_group,donotion_date,quantity)
VALUES('$donor_id','$blood_group','$donation_date','$quantity')");

mysqli_query($conn,"UPDATE blood_inventory 
SET units_available = units_available + $quantity
WHERE blood_group='$blood_group'");

echo "Donation added and inventory updated.";

}

?>
<br><br>
<a href="../admin/dashboard.php" >Back to dashboard</a>