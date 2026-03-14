<?php
include "../config/config.php";
if(isset($_POST['submit'])){
    $blood_group=$_POST['blood_group'];
    $units=$_POST['units'];
    $expiry=$_POST['expiry'];

$query="INSERT INTO blood_inventory(blood_group,units_available,expiry_date)
 VALUES('$blood_group','$units,'$expiry')";  
mysqli_query($conn,$query);
echo "Blood stock added successfully";
}
?>

<h2>Add Blood Stock</h2>

<form method="POST">

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

Units Available<br>
<input type="number" name="units" required><br><br>

Expiry Date<br>
<input type="date" name="expiry" required><br><br>

<button name="submit">Add Blood</button>
</form>