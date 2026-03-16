<?php
require_once("../config/config.php");

$result = mysqli_query($conn,"SELECT * FROM blood_request");
?>

<h2>Blood Request List</h2>

<table border="1" cellpadding="10">

<tr>
<th>Request ID</th>
<th>Patient ID</th>
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
<td><?php echo $row['patient_id']; ?></td>
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