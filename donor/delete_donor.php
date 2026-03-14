<?php
include "../config/config.php";

$id = $_GET['id'];

$query = "DELETE FROM donor WHERE donor_id='$id'";

mysqli_query($conn,$query);

header("Location: view_donor.php");

?>