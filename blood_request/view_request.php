<?php
// blood_request/view_request.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

// SQL Join to get Patient Name along with Request details
$sql = "SELECT r.*, p.name as patient_name 
        FROM blood_request r 
        JOIN patient p ON r.patient_id = p.patient_id 
        ORDER BY r.request_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Requests</title>
    
    <style>
        /* 1. Table & General Styles */
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; }
        .container { padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; color: #333; }
        .status-pending { color: orange; font-weight: bold; }
        .status-approved { color: green; font-weight: bold; }
        
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
<a href="add_request.php" class="btn">New Request</a>
    <h2>Blood Requests</h2>

    <table>
        <tr>
            <th>Patient</th>
            <th>Blood Group</th>
            <th>Units</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td class="status-<?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></td>
            <td>
                <?php if($row['status'] == 'Pending'): ?>
                    <a href="approve_request.php?id=<?php echo $row['request_id']; ?>" 
                       onclick="return confirm('Approve this request and deduct from inventory?')">Approve</a> |

                    <a href="reject_request.php?id=<?php echo $row['request_id']; ?>" style="color:red;">Reject</a>   
                <?php else: ?>
                    --
                <?php endif; ?>
                
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>