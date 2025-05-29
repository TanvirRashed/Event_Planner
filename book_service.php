<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form values
    $user_id = $_SESSION['user_id'];  // user id from session
    $service_id = $_POST['service_id'];  // service id from the form
    $start_date = $_POST['start_date'];  // start date from the form
    $end_date = $_POST['end_date'];  // end date from the form

    // Basic validation
    if (empty($service_id) || empty($start_date) || empty($end_date)) {
        die("Please fill all required fields.");
    }

    // Ensure start date is earlier than end date
    if ($start_date > $end_date) {
        die("End date must be after start date.");
    }

    // Insert the service booking into the service_bookings table
    $stmt = $conn->prepare("INSERT INTO service_bookings (user_id, service_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iiss", $user_id, $service_id, $start_date, $end_date);

    // Execute the query
    if ($stmt->execute()) {
        // Success: show a "Booked!" message in a pop-up
        echo '<script>
            alert("Booked successfully! Your request is pending approval.");
            window.location.href = "dashboard_user.php"; // Redirect to the user dashboard
        </script>';
    } else {
        echo "Error in booking: " . $conn->error;
    }
}
?>
