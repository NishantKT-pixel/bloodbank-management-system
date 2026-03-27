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

$result = mysqli_query($conn , "SELECT * FROM blood_inventory");
?>

<h2>Blood Inventory</h2>

<table border="2" cellpadding="10">

<tr>
<th>ID</th>
<th>Blood Group</th>
<th>Units</th>
<th>Expiry Date</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
    {
?>
<tr>
<td><?php echo $row['inventory_id']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units_available']; ?></td>
<td><?php echo $row['expiry_date']; ?></td>
</tr>

<?php
}
?>
</table>
<br><br>
<a href="../admin/dashboard.php" >Back to dashboard</a>