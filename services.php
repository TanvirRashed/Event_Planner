<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Services</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>

<body>

    <!-- Navbar with Login/Logout Logic -->
    <header class="head">
        <a href="index.php" class="logo"><img class="logo1" src="Image/logo1.png" alt="logo"></a>
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
        <div id="menu-bar"><i class="fas fa-bars"></i></div>
    </header>
    
     <!------------------------services-------------------->
     <section class="service" id="service">

        <div class="title">
            <h1><span>S</span>ervice</h1>
        </div>
        <div class="services-row">
            <div class="services-col">
                <i class="fas fa-book-open"></i>
                <h2>invitation</h2>
                <p>Invite your friends,neighbour,family & close ones.</p>
            </div>
            <div class="services-col">
                <i class="fas fa-camera"></i>
                <h2>Photography & Video</h2>
                <p>Capture your moments.</p>
            </div>
            <div class="services-col">
                <i class="fas fa-brush"></i>
                <h2>Beauty & Makeup</h2>
                <p>Groom Yourself for your day.</p>
            </div>
            <div class="services-col">
                <i class="fab fa-pagelines"></i>
                <h2>Wedding flowers</h2>
                <p>Decore your day with fragrance of flower.</p>
            </div>
            <div class="services-col">
                <i class="fas fa-birthday-cake"></i>
                <h2>wedding cake</h2>
                <p>Keep swetness in your new life as cake have.</p>
            </div>
            <div class="services-col">
                <i class="fas fa-music"></i>
                <h2>music band</h2>
                <p>Live your day with follow of music.</p>
            </div>
            <div class="services-col">
                <i class="fas fa-utensils"></i>
                <h2>Catering</h2>
                <p>Enjoy our food srvices.</p>
            </div>
            <div class="services-col">
                <i class="fas fa-ring"></i>
                <h2>Jewellery</h2>
                <p>Wear our Royal jewellaery to look yourself Royal.</p>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
<div id="bookingModal" style="display:none;">
    <form action="book_service.php" method="POST">
        <input type="hidden" name="service_name" id="serviceName">
        <label>Start Date:</label>
        <input type="date" name="start_date" required>
        <label>End Date:</label>
        <input type="date" name="end_date" required>
        <button type="submit">Confirm Booking</button>
    </form>
</div>


    
</body>
</html>