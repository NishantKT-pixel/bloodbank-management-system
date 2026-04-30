<?php
// donor/add_donor.php
session_start();
require_once('../config/db.php');

// Security Check
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

$success = false; 
if (isset($_POST['add_donor'])) {
    $name = trim($_POST['name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // 1. Server-side Validation
    $errors = [];
    if (empty($name)) $errors[] = "Name is required.";
    if ($age < 18 || $age > 65) $errors[] = "Donor age must be between 18 and 65.";
    if (!preg_match("/^[0-9]{10}$/", $phone)) $errors[] = "Phone must be exactly 10 digits.";

    if (empty($errors)) {
        // 2. Secure Insertion using Prepared Statement
        $stmt = $conn->prepare("INSERT INTO donor (name, age, gender, blood_group, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $name, $age, $gender, $blood_group, $phone, $address);

        if ($stmt->execute()) {
            $success = true;
        } else {
            if ($conn->errno == 1062) { 
                $error_msg = "Error: This phone number is already registered.";
            } else {
                $error_msg = "Database error: Could not register donor.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Donor - BBMS</title>
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
        <h2>Register New Blood Donor</h2>

        <?php 
        // Display Validation Errors
        if (!empty($errors)) {
            foreach($errors as $e) echo "<div class='msg' style='background:#f2dede; color:red;'>$e</div>";
        }
        
        // Display Success Message & View Button
        if ($success) {
            echo "<div class='msg' style='background:#dff0d8; color:green;'>Donor registered successfully!</div>";
            echo "<a href='view_donor.php' class='btn-view'>View Donor List →</a>";
        }
        
        // Display Database Errors
        if (isset($error_msg)) {
            echo "<div class='msg' style='background:#f2dede; color:red;'>$error_msg</div>";
        }
        ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="number" name="age" placeholder="Age" required>
            
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            
            <select name="blood_group">
                <option value="A+">A+</option><option value="A-">A-</option>
                <option value="B+">B+</option><option value="B-">B-</option>
                <option value="O+">O+</option><option value="O-">O-</option>
                <option value="AB+">AB+</option><option value="AB-">AB-</option>
            </select>
            
            <input type="text" name="phone" placeholder="Phone Number (10 digits)" required>
            <textarea name="address" placeholder="Address" rows="3"></textarea>
            
            <button type="submit" name="add_donor" class="btn-submit">Register Donor</button>
        </form>
    </div>
</body>
</html>