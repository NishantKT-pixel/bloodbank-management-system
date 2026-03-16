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