<?php
require_once "../config.php";

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