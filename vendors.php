<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ring Event Planner</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        /* Modal style */
        #bookingModal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        #bookingModal .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            width: 90%;
        }
        #bookingModal .close-btn {
            float: right;
            cursor: pointer;
            font-size: 22px;
            font-weight: bold;
        }
        .vendor-row img {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="head">
        <a href="index.php" class="logo"><img class="logo1" src="Image/logo1.png" alt="logo" /></a>
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
    </header>

    <!-- Vendor Section -->
    <section class="vendor" id="vendor">
        <div class="title">
            <h1><span>F</span>eatured <span>V</span>endor</h1>
        </div>
        <div class="vendor-list">
            <!-- Example Vendor 1 -->
            <div class="vendor-row" data-vendor-id="1" data-vendor-name="Beauty tales by Ring">
                <div class="rate">4.5&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
                <img src="Image/im1.jpg" alt="Beauty tales by Ring" />
                <h2>Beauty tales by Ring</h2>
                <p>Bridal Makeup</p>
                <h3>20,000 onwards</h3>
            </div>
            <!-- Repeat for more vendors -->
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="bookingModal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2 id="modalVendorName"></h2>
            <form id="bookingForm" method="post" action="book_vendor.php">
                <input type="hidden" name="vendor_id" id="vendor_id" value="" /> <!-- Hidden vendor_id -->
                <label>Start Date:</label><br />
                <input type="date" name="start_date" required /><br /><br />
                <label>End Date:</label><br />
                <input type="date" name="end_date" required /><br /><br />
                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>

    <script>
        // Show modal on vendor image click
        document.querySelectorAll('.vendor-row img').forEach(img => {
            img.addEventListener('click', () => {
                const vendorRow = img.closest('.vendor-row');
                const vendorId = vendorRow.getAttribute('data-vendor-id');  // Get vendor_id
                const vendorName = vendorRow.getAttribute('data-vendor-name');  // Get vendor name

                // Set vendor_id in the hidden input
                document.getElementById('vendor_id').value = vendorId;

                // Display vendor name in the modal
                document.getElementById('modalVendorName').textContent = vendorName;

                // Show the modal
                document.getElementById('bookingModal').style.display = 'flex';
            });
        });

        // Close modal when the close button is clicked
        document.querySelector('.close-btn').addEventListener('click', () => {
            document.getElementById('bookingModal').style.display = 'none';
        });

        // Close modal if clicked outside the content
        window.addEventListener('click', (event) => {
            if (event.target === document.getElementById('bookingModal')) {
                document.getElementById('bookingModal').style.display = 'none';
            }
        });
    </script>
</body>
</html>
