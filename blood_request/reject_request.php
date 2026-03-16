<?php

include "../config/config.php";

$id = $_GET['id'];

mysqli_query($conn,"UPDATE blood_request 
SET status='Rejected' 
WHERE request_id='$id'");

header("Location:view_request.php");

?>