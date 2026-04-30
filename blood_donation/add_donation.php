<?php
// blood_donation/add_donation.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

// Fetch donors for the dropdown
$donors = $conn->query("SELECT donor_id, name, blood_group FROM donor");

if (isset($_POST['add_donation'])) {
    $donor_id = (int)$_POST['donor_id'];
    $units = (int)$_POST['units'];
    
    // Get the blood group of this specific donor
    $stmt = $conn->prepare("SELECT blood_group FROM donor WHERE donor_id = ?");
    $stmt->bind_param("i", $donor_id);
    $stmt->execute();
    $donor_data = $stmt->get_result()->fetch_assoc();
    $blood_group = $donor_data['blood_group'];

    if ($units > 0) {
        // 1. Insert into blood_donation table
        $stmt1 = $conn->prepare("INSERT INTO blood_donation (donor_id, blood_group, quantity) VALUES (?, ?, ?)");
        $stmt1->bind_param("isi", $donor_id, $blood_group, $units);
        
        // 2. Update blood_inventory (Increment)
        $stmt2 = $conn->prepare("UPDATE blood_inventory SET units_available = units_available + ? WHERE blood_group = ?");
        $stmt2->bind_param("is", $units, $blood_group);

        if ($stmt1->execute() && $stmt2->execute()) {
            $success = "Donation recorded and Inventory updated!";
        } else {
            $error = "Error updating records.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Donation</title>
<style>
<style>
    body { font-family: 'Segoe UI', sans-serif; background: #fdfdfd; margin: 0; }
    
    .form-wrapper { 
        display: flex; justify-content: center; align-items: center; 
        min-height: 80vh; padding: 20px; 
    }
    
    .form-card { 
        background: #fff; padding: 40px; border-radius: 12px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); width: 100%; max-width: 450px;
        border-top: 6px solid #b31b1b;
    }
    
    .form-card h2 { color: #b31b1b; margin-bottom: 25px; text-align: center; font-size: 24px; }
    
    label { font-weight: 600; color: #555; display: block; margin-bottom: 5px; font-size: 14px; }
    
    input, select, textarea { 
        width: 100%; padding: 12px; margin-bottom: 20px; 
        border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box;
        font-size: 15px; transition: border-color 0.3s;
    }
    
    input:focus, select:focus { border-color: #b31b1b; outline: none; }
    
    .btn-submit { 
        width: 100%; padding: 14px; background: #b31b1b; color: white; 
        border: none; border-radius: 6px; font-weight: bold; 
        cursor: pointer; font-size: 16px; transition: background 0.3s;
    }
    
    .btn-submit:hover { background: #8e1515; }
    
    .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; font-size: 14px; }
    .alert-success { background: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; }
    .alert-error { background: #f2dede; color: #a94442; border: 1px solid #ebccd1; }
</style>

</style>
</head>

<body>
    <a href="../admin/dashboard.php">Back to Dashboard</a>
    <h2>Record New Donation</h2>

    <?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST">
        Select Donor: 
        <select name="donor_id" required>
            <option value="">-- Select Donor --</option>
            <?php while($d = $donors->fetch_assoc()): ?>
                <option value="<?php echo $d['donor_id']; ?>">
                    <?php echo htmlspecialchars($d['name']); ?> (<?php echo $d['blood_group']; ?>)
                </option>
            <?php endwhile; ?>
        </select><br><br>

        Units (ml/bags): 
        <input type="number" name="units" min="1" required><br><br>

        <button type="submit" name="add_donation">Submit Donation</button>
    </form>
</body>
</html>