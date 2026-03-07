<?php
include "config.php";

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $age=$_POST['age'];
    $gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$last_donation_date = $_POST['last_donation_date'];

$query="INSERT INTO donor(name,age,gender,blood_group,phone,address,last_donation_date)
VALUES('$name','$age','$gender','$blood_group','$phone','$address','$last_donation_date')";

mysqli_query($conn,$query);

echo "Donor added successfully";
}
?>
<h2>Add Donor</h2>
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

Last Donation Date<br>
<input type="date" name="last_donation_date"><br><br>

<button name="submit">Add Donor</button>

</form>
