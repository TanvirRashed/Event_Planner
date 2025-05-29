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


    <section>
        <h2>Login to Your Account</h2>
        <form action="login_logic.php" method="POST">
            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <label>Login as:</label><br>
            <input type="radio" name="role" value="admin" required> Admin
            <input type="radio" name="role" value="user" required> User<br><br>

            <button type="submit" name="login">Login</button>
        </form>
    </section>
</body>
</html>
