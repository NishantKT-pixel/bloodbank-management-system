<?php
// donor/delete_donor.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Prepared statement for safety
    $stmt = $conn->prepare("DELETE FROM patient WHERE patient_id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: view_patient.php?msg=Deleted");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>