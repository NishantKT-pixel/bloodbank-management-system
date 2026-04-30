<?php
// blood_request/reject_request.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

$request_id = (int)$_GET['id'];

// Update status to Rejected
$stmt = $conn->prepare("UPDATE blood_request SET status = 'Rejected' WHERE request_id = ?");
$stmt->bind_param("i", $request_id);

if ($stmt->execute()) {
    header("Location: view_request.php?msg=Rejected");
} else {
    echo "Error updating record.";
}
?>