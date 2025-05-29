<?php
session_start();
include "db.php";  // Database connection

if (!isset($_SESSION['email'])) {
    // Redirect to login if user is not logged in
    header("Location: login.php");
    exit();
}

// Check if venue_id is provided
if (!isset($_GET['venue_id'])) {
    die("Invalid request: No venue selected.");
}

$venue_id = intval($_GET['venue_id']);

// Fetch venue details
$stmt = $conn->prepare("SELECT * FROM venues WHERE id = ?");
$stmt->bind_param("i", $venue_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Venue not found.");
}

$venue = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Book Venue - <?php echo htmlspecialchars($venue['name']); ?></title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<header class="head">
    <a href="index.php" class="logo"><img class="logo1" src="Image/logo1.png" alt="logo" /></a>
    <nav class="navbar">
        <a href="index.php" class="active">Home</a>
        <a href="services.php">Services</a>
        <a href="vendors.php">Vendors</a>
        <a href="venue.php">Venue</a>
        <a href="ecard.php">E-cards</a>
        <a href="contact.php">Contact</a>
        <?php
        if (isset($_SESSION['email'])) {
            echo '<a href="logout.php"><button class="btn1">Logout</button></a>';
        } else {
            echo '<a href="login.php"><button class="btn1">Login</button></a>';
        }
        ?>
    </nav>
</header>

<section class="book-venue">
    <h2>Book Venue: <?php echo htmlspecialchars($venue['name']); ?></h2>
    <img src="Image/<?php echo $venue['image']; ?>" alt="<?php echo htmlspecialchars($venue['name']); ?>" style="max-width: 500px; display: block; margin-bottom: 20px;">
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($venue['description'])); ?></p>
    <p><strong>Price:</strong> ৳<?php echo htmlspecialchars($venue['price']); ?></p>

   <form action="submit_booking.php" method="POST">
    <input type="hidden" name="venue_id" value="<?= $venue['id'] ?>">
    <label>Start Date:</label><br>
    <input type="date" name="start_date" required><br><br>
    <label>End Date:</label><br>
    <input type="date" name="end_date" required><br><br>
    <button type="submit">Submit Booking</button>
</form>
</section>
</body>
</html>
