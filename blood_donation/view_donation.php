<?php
require_once("../config/config.php");

$result = mysqli_query($conn,"SELECT * FROM blood_donotion");
?>

<h2>Blood Donation List</h2>
<table border="2" cellpadding="10">
    
<tr>
<th>Donation ID</th>
<th>Donor ID</th>
<th>Blood Group</th>
<th>Donation Date</th>
<th>Quantity</th>
</tr>


<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['donotion_id']; ?></td>
<td><?php echo $row['donor_id']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['donotion_date']; ?></td>
<td><?php echo $row['quantity']; ?></td>

</tr>

<?php
}

?>

</table>
<br><br>
<a href="../admin/dashboard.php" >Back to dashboard</a>