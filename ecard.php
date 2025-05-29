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
             <a href="venue.php">Venue</a>
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

     <!------------------E-invitation------------------>
     <section class="invite" id="invite">
        <div class="title">
            <h1>Card<span>Design</span></h1>
            <p>Choose the best card Design.</p>
        </div>
        <div class="invitation-row">
            <div class="invitation-box">
                <img src="Image/card-1.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-2.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-3.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-4.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-5.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-6.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-7.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-8.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-9.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-10.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-11.jpg" alt="">
            </div>
            <div class="invitation-box">
                <img src="Image/card-12.jpg" alt="">
            </div>
        </div>
    </section>

</body>
</html>