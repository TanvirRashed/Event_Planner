<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include "db.php";

$message = "";

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Password hash
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Insert new user into the database
    $sql = "INSERT INTO users (email, password, name, phone, address, role) VALUES (?, ?, ?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $email, $password, $name, $phone, $address);

    if ($stmt->execute()) {
        $message = "User added successfully!";
    } else {
        $message = "Error adding user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
</head>
<body>

<h2>Add New User</h2>

<?php if ($message): ?>
    <p><?= $message ?></p>
<?php endif; ?>

<form method="post" action="">
    Email:<br>
    <input type="email" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    Name:<br>
    <input type="text" name="name" required><br><br>

    Phone:<br>
    <input type="text" name="phone"><br><br>

    Address:<br>
    <textarea name="address"></textarea><br><br>

    <button type="submit">Add User</button>
</form>

</body>
</html>
