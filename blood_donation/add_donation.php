<?php
require_once("../config/config.php");
?>

<h2>Add Blood Donation</h2>

<form method="POST">

Donor ID:
<input type="number" name="donor_id" required><br><br>

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