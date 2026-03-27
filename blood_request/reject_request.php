<?php

include "../config/config.php";

$id = $_GET['id'];

mysqli_query($conn,"UPDATE blood_request 
SET status='Rejected' 
WHERE request_id='$id'");

echo "Request Rejected Successfully";

echo "<br><a href='view_request.php'>Back</a>";

?>