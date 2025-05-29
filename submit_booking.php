<?php
session_start();
include "db.php";  // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Logged-in user's email
    $user_email = $_SESSION['email'];

    // Get variables safely (null if not present)
    $venue_id = isset($_POST['venue_id']) ? $_POST['venue_id'] : null;
    $vendor_id = isset($_POST['vendor_id']) ? $_POST['vendor_id'] : null;
    $service_name = isset($_POST['service_name']) ? $_POST['service_name'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;

    // For venue booking, expect start_date and end_date
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

    // For vendor/service booking, expect booking_date
    $booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : null;

    // Validation
    if ($venue_id !== null) {
        if (!$start_date || !$end_date) {
            die("Error: Start date and End date are required for venue booking.");
        }

        // Insert venue booking with start and end date
        $sql = "INSERT INTO bookings (user_email, venue_id, start_date, end_date, status) 
                VALUES (?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $user_email, $venue_id, $start_date, $end_date);

        if ($stmt->execute()) {
            header("Location: venue.php?status=success");
            exit();
        } else {
            die("Error submitting venue booking: " . $stmt->error);
        }
    }
    elseif ($vendor_id !== null && $service_name !== null && $message !== null) {
        if (!$booking_date) {
            die("Error: Booking date is required for vendor/service booking.");
        }

        // Insert vendor/service booking
        $sql = "INSERT INTO bookings (user_email, vendor_id, service_name, booking_date, message, status) 
                VALUES (?, ?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisss", $user_email, $vendor_id, $service_name, $booking_date, $message);

        if ($stmt->execute()) {
            header("Location: book_vendor.php?status=success");
            exit();
        } else {
            die("Error submitting vendor booking: " . $stmt->error);
        }
    }
    else {
        die("Error: Insufficient booking data provided.");
    }
}
else {
    die("Invalid request method.");
}
?>
