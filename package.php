<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="styles2.css" />
    <title>Packages | Malcolm Lismore Photographer</title>
    <link rel="icon" type="image/x-icon" href="/image/icon.png" />
  </head>
  <body>
    <header class="header" id="home">
      <nav>
        <div class="nav__header">
          <div class="nav__logo">
            <img src="image/logo1.png" alt="logo" />
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="home.php">HOME</a></li>
          <li><a href="home.php#about">ABOUT US</a></li>
          <li><a href="package.php">PACKAGES</a></li>
          <li class="nav__logo">
            <img src="image/logo1.png" alt="logo" />
          </li>
          <li><a href="gallery.php">GALLERY</a></li>
          <li><a href="blog.php">BLOG</a></li>
          <li><a href="contact.php">CONTACT US</a></li>
        </ul>
      </nav>
      <div class="header__name">
        <h2 class="section__header2">Malcolm Lismore Photographer</h2>
      </div>
    </header>

    <!-- Modal to display enlarged form and package details -->
    <div id="modal" class="modal2">
      <div class="modal-wrapper">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content2">
          <div class="package-details">
            <img id="package-image" src="" alt="Package Image" class="package-image" />
            <h2 id="package-name">Package Name</h2>
            <p id="package-price">Price: $0</p>
          </div>
          <form method="POST" action="package.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required />

            <label for="nic">NIC No:</label>
            <input type="text" id="nic" name="nic" placeholder="Enter your ID number" required />

            <label for="phone">Phone No:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Enter your phone number" required />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required />

            <label for="date">Required date:</label>
            <input type="date" id="date" name="date" required />

            <input type="hidden" id="package-name-hidden" name="package_name" />
            <input type="hidden" id="package-price-hidden" name="package_price" />

            <input type="submit" value="Order Package" />
          </form>

          <div id="notification" class="notification" style="display:none;"></div>

          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "photog";

              $conn = new mysqli($servername, $username, $password, $dbname);

              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $name = $conn->real_escape_string($_POST['name']);
              $phone = $conn->real_escape_string($_POST['phone']);
              $email = $conn->real_escape_string($_POST['email']);
              $nic = $conn->real_escape_string($_POST['nic']);
              $r_date = $conn->real_escape_string($_POST['date']);
              $p_name = $conn->real_escape_string($_POST['package_name']);
              $p_price = $conn->real_escape_string($_POST['package_price']);

              $sql = "INSERT INTO orders (c_name, nic_no, phone_no, email, r_date, pak_de, pak_price) 
                      VALUES ('$name', '$nic', '$phone', '$email', '$r_date', '$p_name', '$p_price')";

              if ($conn->query($sql) === TRUE) {
                header("Location: " . $_SERVER['PHP_SELF'] . "?status=success");
                exit();
              } else {
                header("Location: " . $_SERVER['PHP_SELF'] . "?status=error");
                exit();
              }

              $conn->close();
            }
          ?>
        </div>
      </div>
    </div>

    <div class="section__container portfolio__container">
      <h2 class="section__header">~ PACKAGES ~</h2>
      <div class="portfolio__grid">
        <div class="portfolio__card">
          <img src="image/pack-1.jpg" alt="Package 1" />
          <div class="portfolio__content">
            <button class="btn" onclick="openModal('image/pack-1.jpg', 'Wedding Package', '600')">VIEW PACKAGE</button>
          </div>
        </div>
        <div class="portfolio__card">
          <img src="image/pack-2.jpg" alt="Package 2" />
          <div class="portfolio__content">
            <button class="btn" onclick="openModal('image/pack-2.jpg', 'Event Package', '300')">VIEW PACKAGE</button>
          </div>
        </div>
        <div class="portfolio__card">
          <img src="image/pack-3.jpg" alt="Package 3" />
          <div class="portfolio__content">
            <button class="btn" onclick="openModal('image/pack-3.jpg', 'Single Package', '400')">VIEW PACKAGE</button>
          </div>
        </div>
      </div>
    </div>

    <footer id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <img src="image/logo2.png" alt="logo" />
          <div class="footer__socials">
            <a href="https://www.facebook.com/" target="_blank"><i class="ri-facebook-fill"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="ri-instagram-line"></i></a>
            <a href="https://x.com/" target="_blank"><i class="ri-twitter-fill"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class="ri-youtube-fill"></i></a>
            <a href="https://www.pinterest.com/" target="_blank"><i class="ri-pinterest-line"></i></a>
          </div>
        </div>
        <div class="footer__col">
          <ul class="footer__links">
            <li><a href="home.php">HOME</a></li>
            <li><a href="gallery.php">GALLERY</a></li>
            <li><a href="home.php#about">ABOUT US</a></li>
            <li><a href="blog.php">BLOG</a></li>
            <li><a href="package.php">PACKAGES</a></li>
            <li><a href="contact.php">CONTACT US</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>STAY CONNECTED</h4>
          <p>
            Join the Capturer community and stay updated on the latest trends, tips, and photography moments. Be part of our journey and never miss a shot!
          </p>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2024 Malcolm Lismore Photographer. All rights reserved.
        <br />
        Developed by - Sineth Sandeepa
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>

    <script>
      function openModal(imageSrc, packageName, packagePrice) {
        const modal = document.getElementById("modal");
        document.getElementById("package-image").src = imageSrc;
        document.getElementById("package-name").textContent = packageName;
        document.getElementById("package-price").textContent = `Price: $${packagePrice}`;

        document.getElementById("package-name-hidden").value = packageName;
        document.getElementById("package-price-hidden").value = packagePrice;

        modal.style.display = "block";
      }

      function closeModal() {
        document.getElementById("modal").style.display = "none";
      }

      function showNotification(message, type) {
        const notification = document.getElementById("notification");
        notification.style.display = "block";
        notification.textContent = message;
        notification.className = `notification ${type}`;
        setTimeout(() => {
          notification.style.display = "none";
        }, 3000);
      }

      // Check URL for status and show notification if present
      window.addEventListener("DOMContentLoaded", (event) => {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get("status");
        if (status === "success") {
          showNotification("Your order is successful.", "success");
        } else if (status === "error") {
          showNotification("Error: Unable to place order.", "error");
        }
      });
    </script>
  </body>
</html>
