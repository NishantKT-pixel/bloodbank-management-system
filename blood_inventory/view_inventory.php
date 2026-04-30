<?php
// blood_inventory/view_inventory.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

// Fetch current stock levels
$result = $conn->query("SELECT * FROM blood_inventory ORDER BY blood_group ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Inventory Status</title>
   
    <style>
        /* 1. Table & General Styles */
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; }
        .container { padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; color: #333; }
        .low-stock { color: red; font-weight: bold; }
        .good-stock { color: green; }
        
        /* 2. Button Styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5cb85c; 
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .btn:hover { opacity: 0.9; background-color: #4cae4c; }
        .btn-delete { color: #d9534f; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
   <?php include('../includes/header.php'); ?>
    <h2>Real-time Blood Inventory</h2>

    <table>
        <tr>
            <th>Blood Group</th>
            <th>Available Units (bags)</th>
            <th>Status</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><strong><?php echo $row['blood_group']; ?></strong></td>
            <td><?php echo $row['units_available']; ?></td>
            <td>
                <?php 
                if($row['units_available'] <= 2) {
                    echo "<span class='low-stock'>Low Stock!</span>";
                } else {
                    echo "<span class='good-stock'>Available</span>";
                }
                ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>