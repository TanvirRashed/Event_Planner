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
    <!---------------------------Home--------------------->
    <section class="home" id="home">
        <form action="#">
            <div class="search-box">
                <h1>Your Wedding,Your Way</h1>
                <p>Find the best wedding vendors with thousands of trusted reviews</p>
        <select type="text" class="search-field">
            <option disabled selected>Select vendor type</option>
            <option value="Wedding Venues">Wedding Venues</option>
            <option value="Family makeup">Family makeup</option>
            <option value="bridal makeup">Bridal Makeup</option>
            <option value="Groom Wear">Groom Wear</option>
            <option value="Wedding Decoration">Wedding decoration</option>
        </select>
        <select type="text" class="search-field">
            <option disabled selected>City</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Chattogram">Chattogram</option>
            <option value="Sylhet">Sylhet</option>
        </select>
                <button class="btn">Search</button>
            </div>
        </form>
    </section>



    <!--------------------------------------------footer section--------------------------->
    <footer id="contact">
        <div class="container">
            <div class="f-container">
                <h2>Ring - Your Personal Event Planner</h2><br>
                <p>Plan your wedding with Us WedMeGood is a Bangladeshi  Wedding Planning Website </p>
                <div>
                    <button class="btn">Register as a Vendor</button>
                </div>
                <div class="social">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-linkedin"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-pinterest"></i>
                </div>
            </div>
            <div class="f-container">
                <h2>Our Location</h2>
                <a href="#"><i class="fas fa-angle-right"></i>Dhaka</a>
                <a href="#"><i class="fas fa-angle-right"></i>Rajshahi</a>
                <a href="#"><i class="fas fa-angle-right"></i>Chattogram</a>
                <a href="#"><i class=" fas fa-angle-right "></i>Sylhet</a>
                <a href="# "><i class="fas fa-angle-right "></i>Coxs' Bazar</a>
                </div>
                
                <div class="f-container ">
                    <h2>Our Newsletter</h2>
                    <p>Subscribe for latest updates</p>
                    <input type="text " placeholder="Enter Your Email ">
                    <button class="btn ">Subscribe</button>
                    </div>
            </div>
        </footer>
        <div class="copyright ">
            <p>Copyright ©2024 All Rights Reserved | Bushra
        </div>
</body>
<script>
     let menu = document.querySelector('#menu-bar');
    let head = document.querySelector('.head .navbar');

    menu.onclick = () => {
        head.classList.toggle('active');
    };

    window.onscroll = () => {
        head.classList.remove('active');
        if (window.scrollY > 60) {
            document.querySelector('#menu-bar').classList.add('active');
        } else {
            document.querySelector('#menu-bar').classList.remove('active');
        }
    };
</script>    
</html>