<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$user_email = $_SESSION['email'];

// Fetch bookings for logged-in user
$stmt = $conn->prepare("SELECT * FROM bookings WHERE user_email = ? ORDER BY id DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard - My Bookings</title>
    <style>
        /* Body & Background */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fde8ef; /* soft pink */
            color: #333;
        }
        /* Navbar */
        header.head {
            background-color: #d6336c; /* dark pink */
            padding: 15px 40px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        header.head .logo img {
            height: 40px;
        }
        nav.navbar a {
            color: white;
            text-decoration: none;
            margin-left: 30px;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        nav.navbar a:hover,
        nav.navbar a.active {
            text-decoration: underline;
            color: #ff79a3;
        }
        /* Container */
        .container {
            max-width: 1100px;
            margin: 30px auto 60px;
            padding: 0 20px;
        }
        h2 {
            color: #d6336c;
            margin-bottom: 20px;
        }
        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(214, 51, 108, 0.15);
        }
        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #d6336c;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }
        tr:hover {
            background-color: #ffe6f0;
        }
        /* Footer */
        footer.site-footer {
            text-align: center;
            padding: 20px 0;
            background-color: #d6336c;
            color: white;
            font-size: 14px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header class="head">
    <a href="index.php" class="logo"><img src="Image/logo1.png" alt="Ring Event Planner Logo"></a>
    <nav class="navbar">
        <a href="dashboard_user.php" class="active">My Bookings</a>
        <a href="services.php">Services</a>
        <a href="vendors.php">Vendors</a>
        <a href="venue.php">Venues</a>
        <a href="ecard.php">E-Cards</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <h2>My Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Venue ID</th>
                <th>Vendor ID</th>
                <th>Service</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($booking = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['id']) ?></td>
                        <td><?= htmlspecialchars($booking['venue_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($booking['vendor_id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($booking['service_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($booking['booking_date']) ?></td>
                        <td><?= htmlspecialchars($booking['status']) ?></td>
                        <td><?= htmlspecialchars($booking['message'] ?? '') ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;">No bookings found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<footer class="site-footer">
    &copy; <?= date("Y") ?> Ring Event Planner | All rights reserved.
</footer>

</body>
</html>
