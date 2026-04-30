<?php
// blood_request/add_request.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

// 1. Fetch Patients for the dropdown
$patients = $conn->query("SELECT patient_id, name FROM patient ORDER BY name ASC");

if (isset($_POST['add_request'])) {
    $patient_id = (int)$_POST['patient_id'];
    $blood_group = $_POST['blood_group'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0 && !empty($patient_id)) {
        // 2. Insert as 'Pending' status
        $stmt = $conn->prepare("INSERT INTO blood_request (patient_id, blood_group, quantity, status) VALUES (?, ?, ?, 'Pending')");
        $stmt->bind_param("isi", $patient_id, $blood_group, $quantity);

        if ($stmt->execute()) {
            $success = "Request submitted successfully! Please approve it from the View Request page.";
        } else {
            $error = "Error submitting request.";
        }
    } else {
        $error = "Please fill all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Blood Request</title>
<style>
        /* Modern Layout */
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; padding-top: 100px; display: flex; flex-direction: column; align-items: center; }
        
        .form-card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 400px; text-align: center; }
        .form-card h2 { color: #333; margin-top: 0; margin-bottom: 20px; }
        
        /* Input Styling */
        input, select, textarea { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px; }
        
        /* Red Submit Button */
        .btn-submit { width: 100%; padding: 12px; border: none; background: #b31b1b; color: white; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; transition: 0.3s; }
        .btn-submit:hover { background: #8e1515; }
        
        /* Green View Button (Appears on Success) */
        .btn-view { display: inline-block; width: 100%; padding: 12px; background: #5cb85c; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 10px; box-sizing: border-box; }
        .btn-view:hover { background: #4cae4c; }
        
        /* Messaging */
        .msg { padding: 10px; margin-bottom: 15px; border-radius: 5px; font-size: 14px; }
    </style>
</head>
<body>
    <?php include('../includes/home.php'); ?>

    <div class="form-card">
    <h2>Create Blood Request</h2>

    <?php 
    if(isset($success)) echo "<p style='color:green;'>$success</p>"; 
    if(isset($error)) echo "<p style='color:red;'>$error</p>"; 
    ?>

    <form method="POST">
        Select Patient:
        <select name="patient_id" required>
            <option value="">-- Select Patient --</option>
            <?php while($p = $patients->fetch_assoc()): ?>
                <option value="<?php echo $p['patient_id']; ?>">
                    <?php echo htmlspecialchars($p['name']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        Blood Group Needed:
        <select name="blood_group" required>
            <option value="A+">A+</option><option value="A-">A-</option>
            <option value="B+">B+</option><option value="B-">B-</option>
            <option value="O+">O+</option><option value="O-">O-</option>
            <option value="AB+">AB+</option><option value="AB-">AB-</option>
        </select><br><br>

        Units Needed:
        <input type="number" name="quantity" min="1" required><br><br>

        <button type="submit" name="add_request">Submit Request</button>
    </form>
    </div>
</body>
</html>