<?php
session_start();
include "db.php";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, address=? WHERE email=?");
    $stmt->bind_param("ssss", $name, $phone, $address, $email);

    if ($stmt->execute()) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile: " . $conn->error;
    }
}

$stmt = $conn->prepare("SELECT name, phone, address FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Edit Profile</title></head>
<body>
<h2>Edit Your Profile</h2>
<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>
<form method="post" action="">
    Name:<br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"><br><br>

    Phone:<br>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>"><br><br>

    Address:<br>
    <textarea name="address"><?= htmlspecialchars($user['address']) ?></textarea><br><br>

    <button type="submit">Update Profile</button>
</form>
</body>
</html>
