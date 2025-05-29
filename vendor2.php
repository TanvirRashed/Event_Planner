<?php
session_start();
?>
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
    <div id="menu-bar"><i class="fas fa-bars"></i></div>
  </header>

  <!-----------------------------vendor------------------->
  <section class="vendor" id="vendor">
    <div class="title">
      <h1><span>F</span>eatured <span>V</span>endor</h1>
    </div>
    <div class="vendor-list">
      <div class="vendor-row" data-vendor-id="1" data-vendor-name="Beauty tales by Ring">
        <div class="rate">4.5&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
        <img src="Image/im1.jpg" alt="Beauty tales by Ring" />
        <h2>Beauty tales by Ring</h2>
        <p>Bridal Makeup</p>
        <h3>20,000 onwards</h3>
      </div>
      <div class="vendor-row" data-vendor-id="2" data-vendor-name="Flinters Management">
        <div class="rate">4.2&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
        <img src="Image/im2.jpg" alt="Flinters Management" />
        <h2>Flinters Management</h2>
        <p>Wedding Planner</p>
        <h3>2.5-4 Lakh</h3>
      </div>
      <div class="vendor-row" data-vendor-id="3" data-vendor-name="Wedding Mela">
        <div class="rate">5.0&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
        <img src="Image/im3.jpg" alt="Wedding Mela" />
        <h2>Wedding Mela</h2>
        <p>Wedding Decorators</p>
        <h3>80,000-30,00,000</h3>
      </div>
      <div class="vendor-row" data-vendor-id="4" data-vendor-name="E- Invitation by Ring">
        <div class="rate">4.1&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
        <img src="Image/im4.jpg" alt="E- Invitation by Ring" />
        <h2>E- Invitation by Ring</h2>
        <p>Wedding Decorators-Rental Only</p>
        <h3>80,000 Onwards</h3>
      </div>
      <div class="vendor-row" data-vendor-id="5" data-vendor-name="Moving Chobi">
        <div class="rate">4.3&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
        <img src="Image/im5.jpg" alt="Moving Chobi" />
        <h2>Moving Chobi</h2>
        <p>Photography</p>
        <h3>80,000-30,00,000</h3>
      </div>
      <div class="vendor-row" data-vendor-id="6" data-vendor-name="Rhythm Hub">
        <div class="rate">4.0&nbsp;<i class="fa fa-star" aria-hidden="true"></i></div>
        <img src="Image/im6.jpg" alt="Rhythm Hub" />
        <h2>Rhythm Hub</h2>
        <p>Music bands</p>
        <h3>1.8 Lakh</h3>
      </div>
    </div>
  </section>

  <!-- Booking Modal -->
  <div id="bookingModal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2 id="modalVendorName"></h2>
      <form id="bookingForm" method="post" action="book_vendor.php">
        <input type="hidden" name="vendor_id" id="vendor_id" value="" />
        <label>Start Date:</label><br />
        <input type="date" name="start_date" required /><br /><br />
        <label>End Date:</label><br />
        <input type="date" name="end_date" required /><br /><br />
        <button type="submit">Book Now</button>
      </form>
    </div>
  </div>

  <script>
    // Modal show/hide logic
    const modal = document.getElementById("bookingModal");
    const modalVendorName = document.getElementById("modalVendorName");
    const vendorIdInput = document.getElementById("vendor_id");
    const closeBtn = document.querySelector(".close-btn");

    // Show modal on vendor image click
    document.querySelectorAll(".vendor-row img").forEach((img) => {
      img.addEventListener("click", () => {
        const vendorRow = img.closest(".vendor-row");
        const vendorId = vendorRow.getAttribute("data-vendor-id");
        const vendorName = vendorRow.getAttribute("data-vendor-name");

        vendorIdInput.value = vendorId;
        modalVendorName.textContent = vendorName;
        modal.style.display = "flex";
      });
    });

    // Close modal
    closeBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });

    // Close modal if click outside content
    window.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  </script>
</body>
</html>
