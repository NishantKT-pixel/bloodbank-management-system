<?php
// donor/edit_donor.php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/login.php");
    exit();
}

$id = (int)$_GET['id'];
$success = "";
$error_msg = "";

// 1. Fetch current data to pre-fill the form
$stmt = $conn->prepare("SELECT * FROM patient WHERE patient_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$patient = $stmt->get_result()->fetch_assoc();

if (!$patient) {
    die("patient not found.");
}

// 2. Process the Update
if (isset($_POST['update_patient'])) {
    $name = trim($_POST['name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Server-side Validation
    if ($age < 0 || $age > 120) {
        $error_msg = "Patient age must be between 0 and 120.";
    } else {
        $update_stmt = $conn->prepare("UPDATE patient SET name=?, age=?, gender=?, blood_group=?, phone=?, address=? WHERE patient_id=?");
        $update_stmt->bind_param("sissssi", $name, $age, $gender, $blood_group, $phone, $address, $id);

        if ($update_stmt->execute()) {
            $success = "Patient records updated successfully!";
            // Refresh local data for the form
            $patient['name'] = $name;
            $patient['phone'] = $phone;
            $patient['address'] = $address;
        } else {
            $error_msg = "Update failed. Check if the phone number is already used by another patient.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Patient</title></head>
<body>
    <a href="view_patient.php">Back to List</a>
    <h2>Edit Patient Details</h2>

    <?php 
    if ($success) echo "<p style='color:green;'>$success</p>";
    if ($error_msg) echo "<p style='color:red;'>$error_msg</p>";
    ?>

    <form method="POST">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($patient['name']); ?>" required><br><br>
        Age: <input type="number" name="age" value="<?php echo $patient['age']; ?>" required><br><br>
        Gender: 
        <select name="gender">
            <option value="Male" <?php if($patient['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($patient['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select><br><br>
        Blood Group: <strong><?php echo $patient['blood_group']; ?></strong> 
        <input type="hidden" name="blood_group" value="<?php echo $patient['blood_group']; ?>"><br><br>
        Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($patient['phone']); ?>" required><br><br>
        Address: <textarea name="address"><?php echo htmlspecialchars($patient['address']); ?></textarea><br><br>
        <button type="submit" name="update_patient">Update Records</button>
    </form>
</body>
</html>