<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ring Event Planner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <header class="head">
        <a href="index.php" class="logo"><img class="logo1" src="Image/logo1.png" alt="logo"></a>
        <nav class="navbar">
            <a href="index.php" class="active">Home</a>
            <a href="services.php">Services</a>
            <a href="vendors.php">Vendors</a>
            <a href="ecard.php">E-cards</a>
            <a href="venue.php">Venues</a>
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
    <!-- Your Content Below -->
</body>
</html>


    
<section id="contact" style="margin-top: 100px;">
    <div class="title">
        <h1><span></span>Contact Here<span>Us</span></h1>
        <p>We’d love to hear from you</p>
    </div>
    <div class="container">
        <div class="f-container">
            <h2>Get In Touch</h2>
            <p>Email: contact@ringplanner.com</p>
            <p>Phone: +880-123-456-789</p>
            <p>Address: Dhaka, Bangladesh</p>
        </div>
        <div class="f-container">
            <h2>Send a Message</h2>
            <input type="text" placeholder="Your Name">
            <input type="email" placeholder="Your Email">
            <input type="text" placeholder="Subject">
            <textarea rows="4" placeholder="Message" style="width:90%; padding:1rem;"></textarea>
            <button class="btn">Send Message</button>
        </div>
        <div class="f-container">
            <h2>Follow Us</h2>
            <div class="social">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-linkedin"></i>
                <i class="fab fa-twitter"></i>
            </div>
        </div>
    </div>
</section>

<div class="copyright">
    <p>Copyright ©2025 All Rights Reserved | Bushra</p>
</div>

</body>
</html>
