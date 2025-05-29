<?php
session_start();

// Check if user is admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include "db.php";  // Database connection

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Prepare statement to update booking status securely
    $stmt = $conn->prepare("UPDATE bookings SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        // Success, redirect back to admin dashboard
        header("Location: dashboard_admin.php");
        exit();
    } else {
        // Error handling
        echo "Error updating booking status: " . $stmt->error;
    }
} else {
    // No booking id provided
    echo "Invalid request: Booking ID missing.";
}
// Check if booking ID is passed
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Prepare statement to update vendor booking status
    $stmt = $conn->prepare("UPDATE vendor_bookings SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        // Success: Redirect back to admin dashboard
        header("Location: dashboard_admin.php");
        exit();
    } else {
        // Error handling
        echo "Error updating booking status: " . $stmt->error;
    }
} else {
    // No booking ID provided
    echo "Invalid request: Booking ID missing.";
}
?>
