<?php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

$success = false; // Track success for the button display
if (isset($_POST['add_patient'])) {
    $name = trim($_POST['name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $errors = [];
    if (empty($name)) $errors[] = "Name is required.";
    if ($age < 0 || $age > 120) $errors[] = "Age must be 0-120.";
    if (!preg_match("/^[0-9]{10}$/", $phone)) $errors[] = "Phone must be 10 digits.";

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO patient (name, age, gender, blood_group, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $name, $age, $gender, $blood_group, $phone, $address);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error_msg = ($conn->errno == 1062) ? "Phone number already registered." : "Database error.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Patient - BBMS</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; margin: 0; padding-top: 80px; display: flex; flex-direction: column; align-items: center; }
        .form-card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 400px; text-align: center; }
        .form-card h2 { color: #333; margin-top: 0; }
        input, select, textarea { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-submit { width: 100%; padding: 12px; border: none; background: #b31b1b; color: white; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; }
        .btn-view { display: inline-block; width: 100%; padding: 12px; background: #5cb85c; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 10px; box-sizing: border-box; }
        .msg { padding: 10px; margin-bottom: 10px; border-radius: 5px; }
    </style>
</head>
<body>

    <?php include('../includes/home.php'); ?>

    <div class="form-card">
        <h2>Register New Patient</h2>

        <?php 
        if (!empty($errors)) foreach($errors as $e) echo "<div class='msg' style='background:#f2dede; color:red;'>$e</div>";
        if ($success) {
            echo "<div class='msg' style='background:#dff0d8; color:green;'>Patient registered successfully!</div>";
            echo "<a href='view_patient.php' class='btn-view'>View Patient List →</a>";
        }
        if (isset($error_msg)) echo "<div class='msg' style='background:#f2dede; color:red;'>$error_msg</div>";
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
            <input type="text" name="phone" placeholder="Phone Number" required>
            <textarea name="address" placeholder="Address"></textarea>
            <button type="submit" name="add_patient" class="btn-submit">Register Patient</button>
        </form>
    </div>
</body>
</html>