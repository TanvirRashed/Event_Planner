<?php
include "db.php";

// Change these values as you want for the new admin
$email = "newadmin@example.com";
$password = password_hash("AdminPass123", PASSWORD_DEFAULT); // Change password here
$name = "New Admin";
$phone = "0123456789";
$address = "Admin Address";
$role = "admin";

$sql = "INSERT INTO users (email, password, name, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $email, $password, $name, $phone, $address, $role);

if ($stmt->execute()) {
    echo "New admin user added successfully!";
} else {
    echo "Error adding admin user: " . $conn->error;
}
?>
