<?php
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include "db.php";



// Fetch booking data with JOIN to get user email
$sql = "SELECT bookings.*, users.email AS user_email 
        FROM bookings 
        LEFT JOIN users ON bookings.user_id = users.id 
        ORDER BY bookings.id DESC";
$result = $conn->query($sql); // ✅ এইটা BOOKINGS table এর জন্য

// Fetch user list for the left sidebar
$user_result = $conn->query("SELECT id, email, name FROM users ORDER BY id DESC"); // ✅ এইটা sidebar এর জন্য


if (!$result) {
    die("Database Query Failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - Bookings and Users</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fde8ef; /* Soft pink background */
            color: #333;
        }

        /* Navbar Styling */
        header.head {
            background-color: #d6336c; /* Dark pink */
            padding: 15px 40px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header .logo img {
            height: 40px;
        }

        nav.navbar a {
            color: white;
            text-decoration: none;
            margin-left: 30px;
            font-weight: bold;
            font-size: 16px;
        }

        nav.navbar a:hover {
            text-decoration: underline;
            color: #ff79a3;
        }

        /* Admin Dashboard Layout */
        .dashboard-container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h3 {
            text-align: center;
            color: #d6336c;
            margin-bottom: 20px;
        }

        .sidebar table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .sidebar th, .sidebar td {
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .sidebar th {
            background-color: #d6336c;
            color: white;
        }

        .sidebar tr:hover {
            background-color: #f1f1f1;
        }

        .sidebar .btn {
            padding: 4px 10px;
            background-color: #d6336c;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            space:2px;
        }

        .sidebar .btn:hover {
            background-color: #c72a57;
        }
        /* Sidebar buttons container */
.sidebar-actions {
  display: flex;
  gap: 8px; /* space between buttons */
}

/* Buttons style */
.sidebar-actions button, .sidebar-actions a {
  padding: 6px 12px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-size: 14px;
}

/* Edit button */
.sidebar-actions .edit-btn {
  background-color: #e91e63;
  color: white;
}

/* Delete button */
.sidebar-actions .delete-btn {
  background-color: #c2185b;
  color: white;
}


        /* Content Styling */
        .content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            margin-left: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .content h2 {
            color: #d6336c;
            margin-bottom: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .content th, .content td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .content th {
            background-color: #d6336c;
            color: white;
        }

        .content tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .content tr:hover {
            background-color: #f1f1f1;
        }

        .content .btn {
            padding: 6px 14px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .content .btn:hover {
            background-color: #218838;
        }

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

        /* Button Spacing */
        .sidebar .btn, .content .btn {
            margin-right: 8px; /* Adds space between the buttons */
        }
    </style>
</head>
<body>

<!-- Navbar -->
<header class="head">
    <a href="index.php" class="logo"><img src="Image/logo1.png" alt="Ring Event Planner Logo"></a>
    <nav class="navbar">
        <a href="dashboard_admin.php" class="active">Bookings</a>
        <a href="services.php">Services</a>
        <a href="vendors.php">Vendors</a>
        <a href="venue.php">Venues</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<!-- Admin Dashboard Layout -->
<div class="dashboard-container">

    <!-- Sidebar (User Management) -->
    <div class="sidebar">
        <h3>Manage Users</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $user_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn">Edit</a> |
                            <a href="manage_users.php?delete=<?= $user['id'] ?>" class="btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="add_user.php" class="btn">Add New User</a>
    </div>

    <!-- Content (Booking Management) -->
    <div class="content">
        <h2>View Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <!--<th>User Email</th>
                    <th>Vendor</th>
                    <th>Service</th>
                    <th>Booking Date</th>-->
                    <th>Status</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($booking = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['id']) ?></td>
                           <!-- <td><?= htmlspecialchars($booking['user_email']) ?></td>
                            <td><?= htmlspecialchars($booking['vendor_id'] ?? '') ?></td>  Replace with vendor name if needed 
                            <td><?= htmlspecialchars($booking['service_name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($booking['booking_date']) ?></td>-->
                            <td><?= htmlspecialchars($booking['status']) ?></td>
                            <td><?= htmlspecialchars($booking['message'] ?? '') ?></td>
                            <td>
                                <?php if ($booking['status'] !== 'approved'): ?>
                                    <a href="approve_booking.php?id=<?= $booking['id'] ?>" class="btn">Approve</a>
                                <?php else: ?>
                                    <span>Approved</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="8" style="text-align:center;">No bookings found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<footer class="site-footer">
    &copy; <?= date("Y") ?> Ring Event Planner | Bushra.
</footer>

</body>
</html>
