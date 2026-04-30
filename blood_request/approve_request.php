<?php
// blood_request/approve_request.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

$request_id = (int)$_GET['id'];

// 1. Fetch request details
$stmt = $conn->prepare("SELECT blood_group, quantity FROM blood_request WHERE request_id = ? AND status = 'Pending'");
$stmt->bind_param("i", $request_id);
$stmt->execute();
$req = $stmt->get_result()->fetch_assoc();

if ($req) {
    $bg = $req['blood_group'];
    $qty = $req['quantity'];

    // 2. Check if enough stock exists
    $inv_stmt = $conn->prepare("SELECT units_available FROM blood_inventory WHERE blood_group = ?");
    $inv_stmt->bind_param("s", $bg);
    $inv_stmt->execute();
    $inv = $inv_stmt->get_result()->fetch_assoc();

    if ($inv['units_available'] >= $qty) {
        // 3. Transaction: Decrease inventory and Approve request
        $conn->begin_transaction(); // Professional practice: All or nothing
        try {
            $update_inv = $conn->prepare("UPDATE blood_inventory SET units_available = units_available - ? WHERE blood_group = ?");
            $update_inv->bind_param("is", $qty, $bg);
            $update_inv->execute();

            $update_req = $conn->prepare("UPDATE blood_request SET status = 'Approved' WHERE request_id = ?");
            $update_req->bind_param("i", $request_id);
            $update_req->execute();

            $conn->commit();
            header("Location: view_request.php?msg=Approved");
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error processing approval.";
        }
    } else {
        echo "<script>alert('Not enough blood in inventory!'); window.location='view_request.php';</script>";
    }
}
?>