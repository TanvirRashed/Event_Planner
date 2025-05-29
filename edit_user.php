<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, address=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $phone, $address, $user_id);
    if ($stmt->execute()) {
        // Update session email/name if you store those there (optional)
        $message = "Profile updated successfully!";
        // Redirect after update to dashboard_user.php
        header("Location: dashboard_user.php");
        exit();
    } else {
        $message = "Error updating profile: " . $conn->error;
    }
}

// Load current user data
$stmt = $conn->prepare("SELECT name, phone, address FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
</head>
<body>

<h2>Edit Your Profile</h2>

<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post" action="">
    Name:<br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

    Phone:<br>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required><br><br>

    Address:<br>
    <textarea name="address" required><?= htmlspecialchars($user['address']) ?></textarea><br><br>

    <button type="submit">Update Profile</button>
</form>

</body>
</html>
