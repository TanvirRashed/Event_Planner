<?php
session_start();
include "db.php";  // Include database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Process the booking when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_SESSION['user_id'];  // Get user id from session
    $vendor_id = $_POST['vendor_id'];  // Get vendor id from the form
    $start_date = $_POST['start_date'];  // Start date
    $end_date = $_POST['end_date'];  // End date

    // Basic validation
    if (empty($vendor_id) || empty($start_date) || empty($end_date)) {
        die("Please fill all required fields.");
    }

    // Make sure start date is earlier than end date
    if ($start_date > $end_date) {
        die("End date must be after start date.");
    }

    // Insert booking into the vendor_bookings table
    $stmt = $conn->prepare("INSERT INTO vendor_bookings (user_id, vendor_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iiss", $user_id, $vendor_id, $start_date, $end_date);

    // Execute the query
    if ($stmt->execute()) {
        echo '<script>
            alert("Booking successful! Your request is pending approval.");
            window.location.href = "dashboard_user.php"; // Redirect to user dashboard
        </script>';
    } else {
        echo "Error in booking: " . $conn->error;
    }
}
?>
