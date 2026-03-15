<?php
include "../config/config.php";

$id = $_GET['id'];

$query = "DELETE FROM patient WHERE patient_id='$id'";

mysqli_query($conn,$query);

header("Location: view_patient.php");

?>