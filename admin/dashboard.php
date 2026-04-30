<?php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Data Fetching
$donor_count = $conn->query("SELECT COUNT(*) as total FROM donor")->fetch_assoc()['total'];
$patient_count = $conn->query("SELECT COUNT(*) as total FROM patient")->fetch_assoc()['total'];
$request_count = $conn->query("SELECT COUNT(*) as total FROM blood_request WHERE status='Pending'")->fetch_assoc()['total'];
$inventory_total = $conn->query("SELECT SUM(units_available) as total FROM blood_inventory")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>BBMS Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdfdfd; margin: 0; color: #333; }
        .container { padding: 40px; max-width: 1100px; margin: auto; }
        
        /* Stats Styling */
        .stats-container { display: flex; gap: 25px; margin-top: 20px; }
        .stat-card { 
            background: #fff; padding: 25px; border-radius: 12px; flex: 1;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center;
            border-bottom: 5px solid #b31b1b; 
        }
        .stat-card h3 { margin: 0; color: #888; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }
        .stat-card p { margin: 10px 0 0; font-size: 38px; font-weight: bold; color: #b31b1b; }

        /* Welcome Text */
        .welcome-box { margin-bottom: 40px; border-left: 5px solid #b31b1b; padding-left: 20px; }
        .welcome-box h1 { margin: 0; font-size: 28px; }

        /* Action Tiles */
        .action-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 40px; }
        .tile {
            background: #fff; padding: 30px; border-radius: 10px; text-align: center;
            text-decoration: none; color: #333; font-weight: bold;
            border: 1px solid #eee; transition: all 0.3s ease;
        }
        .tile:hover { 
            background: #b31b1b; color: #fff; transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(179, 27, 27, 0.3);
        }
        .tile i { display: block; font-size: 24px; margin-bottom: 10px; }
    </style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<div class="container">
    <div class="welcome-box">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <p>Blood Bank Management System | Administrative Control Panel</p>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Donors</h3>
            <p><?php echo $donor_count; ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Patients</h3>
            <p><?php echo $patient_count; ?></p>
        </div>
        <div class="stat-card">
            <h3>Pending Requests</h3>
            <p><?php echo $request_count; ?></p>
        </div>
        <div class="stat-card">
            <h3>Inventory (Units)</h3>
            <p><?php echo $inventory_total ? $inventory_total : 0; ?></p>
        </div>
    </div>

    <div style="margin-top: 50px;">
        <h3>Quick Operations</h3>
        <div class="action-grid">
            <a href="../donor/add_donor.php" class="tile">Register Donor</a>
            <a href="../patient/add_patient.php" class="tile">Add Patient</a>
            <a href="../blood_donation/add_donation.php" class="tile">New Donation</a>
            <a href="../blood_request/add_request.php" class="tile">Blood Request</a>
        </div>
    </div>
</div>

</body>
</html>