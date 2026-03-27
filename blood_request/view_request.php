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

$result = mysqli_query($conn," SELECT patient.name, blood_request. * FROM blood_request JOIN patient ON patient.patient_id = blood_request.patient_id");

?>

<h2>Blood Request List</h2>

<table border="1" cellpadding="10">

<tr>
<th>Request ID</th>
<th>Patient Name</th>
<th>Blood Group</th>
<th>Request Date</th>
<th>Quantity</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['request_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['request_date']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>

<a href="approve_request.php?id=<?php echo $row['request_id']; ?>">Approve</a> |

<a href="reject_request.php?id=<?php echo $row['request_id']; ?>">Reject</a>

</td>

</tr>

<?php
}
?>

</table>
<br><br>
<a href="../admin/dashboard.php">Back to Dashboard</a>