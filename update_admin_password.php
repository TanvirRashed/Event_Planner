<?php
include "db.php";

// Change this to your desired new admin password
$new_password = "bushra510";

// Hash the password
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update the admin user's password in the database
$sql = "UPDATE users SET password = ? WHERE role = 'admin'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hashed_password);

if ($stmt->execute()) {
    echo "Admin password updated successfully!";
} else {
    echo "Error updating admin password: " . $conn->error;
}
?>
