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
$stmt = $conn->prepare("SELECT * FROM donor WHERE donor_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$donor = $stmt->get_result()->fetch_assoc();

if (!$donor) {
    die("Donor not found.");
}

// 2. Process the Update
if (isset($_POST['update_donor'])) {
    $name = trim($_POST['name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Server-side Validation
    if ($age < 18 || $age > 65) {
        $error_msg = "Donor age must be between 18 and 65.";
    } else {
        $update_stmt = $conn->prepare("UPDATE donor SET name=?, age=?, gender=?, blood_group=?, phone=?, address=? WHERE donor_id=?");
        $update_stmt->bind_param("sissssi", $name, $age, $gender, $blood_group, $phone, $address, $id);

        if ($update_stmt->execute()) {
            $success = "Donor records updated successfully!";
            // Refresh local data for the form
            $donor['name'] = $name;
            $donor['phone'] = $phone;
            $donor['address'] = $address;
        } else {
            $error_msg = "Update failed. Check if the phone number is already used by another donor.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Donor</title></head>
<body>
    <a href="view_donor.php">Back to List</a>
    <h2>Edit Donor Details</h2>

    <?php 
    if ($success) echo "<p style='color:green;'>$success</p>";
    if ($error_msg) echo "<p style='color:red;'>$error_msg</p>";
    ?>

    <form method="POST">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($donor['name']); ?>" required><br><br>
        Age: <input type="number" name="age" value="<?php echo $donor['age']; ?>" required><br><br>
        Gender: 
        <select name="gender">
            <option value="Male" <?php if($donor['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($donor['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select><br><br>
        Blood Group: <strong><?php echo $donor['blood_group']; ?></strong> 
        <input type="hidden" name="blood_group" value="<?php echo $donor['blood_group']; ?>"><br><br>
        Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($donor['phone']); ?>" required><br><br>
        Address: <textarea name="address"><?php echo htmlspecialchars($donor['address']); ?></textarea><br><br>
        <button type="submit" name="update_donor">Update Records</button>
    </form>
</body>
</html>