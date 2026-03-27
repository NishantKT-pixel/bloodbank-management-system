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

$result = mysqli_query($conn,"SELECT * FROM donor");
?>

<h2>Donor List</h2>

<table border="2" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Age</th>
<th>Gender</th>
<th>Blood Group</th>
<th>Phone</th>
<th>Address</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['donor_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['phone']; ?></td>

<td>
<a href="delete_donor.php?id=<?php echo $row['donor_id']; ?>">Delete</a>
</td>

</tr>

<?php
}
?>

</table>
<br><br>
<a href="../admin/dashboard.php" >Back to dashboard</a>