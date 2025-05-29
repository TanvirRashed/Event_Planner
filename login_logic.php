<?php
session_start();
include "db.php"; // Database connection

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare statement for secure query
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password securely
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            // Role based redirect & additional profile prompt for users
            if ($user['role'] == 'admin') {
                header("Location: dashboard_admin.php");
                exit();
            } elseif ($user['role'] == 'user') {
                // If you want to redirect users to profile prompt before dashboard
                header("Location: profile_prompt.php");
                exit();
            } else {
                // For any other roles, fallback redirect
                header("Location: dashboard_user.php");
                exit();
            }
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that email.";
    }
}
?>
