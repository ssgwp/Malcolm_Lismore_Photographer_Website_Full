<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="styles2.css" />
    <title>Contact us | Malcolm Lismore Photographer</title>
    <link rel="icon" type="image/x-icon" href="/image/icon.png">
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
            <img src="image/logo1.png" alt="logo"/>
          </li>
          <li><a href="gallery.php">GALLERY</a></li>
          <li><a href="blog.php">BLOG</a></li>
          <li><a href="contact.php">CONTACT US</a></li>
        </ul>
      </nav>
      <nav>
        <div class="header__name">
          <h2 class="section__header2">Malcolm Lismore Photographer</h2>
        </div>
      </nav>
    </header>

    <section class="section__container">
    <h2 class="section__header">~ Contact us ~</h2>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="phone">Phone Number:</label><br>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="id">NIC Number:</label><br>
            <input type="text" id="id" name="id" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

            <input type="submit" value="Submit">
        </form>
      </div>
    </section>

    <!-- Notification Div -->
    <div id="notification" class="notification" style="display:none;"></div>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Check if the form is submitted
          // Database connection settings
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "photog";  // Ensure your database name is correct

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Collect form data and sanitize it
          $name = $conn->real_escape_string($_POST['name']);
          $phone = $conn->real_escape_string($_POST['phone']);
          $email = $conn->real_escape_string($_POST['email']);
          $nic = $conn->real_escape_string($_POST['id']);
          $description = $conn->real_escape_string($_POST['description']);

          // SQL query to insert data
          $sql = "INSERT INTO contact (c_name, ph_no, email, nic_no, descr) 
                  VALUES ('$name', '$phone', '$email', '$nic', '$description')";

          if ($conn->query($sql) === TRUE) {
            // Redirect to the same page with a success flag to trigger the notification
            header("Location: " . $_SERVER['PHP_SELF'] . "?status=success");
            exit();  // Ensure script stops after redirect
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
          // Close the connection
          $conn->close();
      }
    ?>

    <script>
    // Function to show notification
    function showNotification(message) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.style.display = 'flex';
        notification.style.backgroundColor = 'green';  // Success color
        setTimeout(function() {
            notification.style.display = 'none';
        }, 3000);  // Hide notification after 3 seconds
    }

    // Check if there is a success parameter in the URL and trigger notification
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            showNotification('Form submitted successfully!');
        }
    });
    </script>

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
            <li><a href="">CONTACT US</a></li>
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
        <br>
        Developed by - Sineth Sandeepa
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
  </body>
</html>
