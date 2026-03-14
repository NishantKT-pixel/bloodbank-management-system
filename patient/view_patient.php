<?php
include "config.php";

$result = mysqli_query($conn,"SELECT * FROM patient");
?>

<h2>Patient List</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Age</th>
<th>Gender</th>
<th>Blood Group</th>
<th>Phone</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['patient_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['phone']; ?></td>

</tr>

<?php
}
?>

</table>