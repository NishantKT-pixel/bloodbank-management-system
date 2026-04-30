<?php
// donor/view_donor.php
session_start();
require_once('../config/db.php');

// Security Check
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

// Fetch all donors
$result = $conn->query("SELECT * FROM patient ORDER BY patient_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Patient</title>
    <style>
        /* 1. Table & General Styles */
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; }
        .container { padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; color: #333; }
        
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
    <a href="add_patient.php" class="btn">+ Add New Patient</a>
    <h2>Registered Patient List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['patient_id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td>
                <a href="edit_patient.php?id=<?php echo $row['patient_id']; ?>">Edit</a> |
                <a href="delete_patient.php?id=<?php echo $row['patient_id']; ?>" 
                   class="btn-delete" 
                   onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>