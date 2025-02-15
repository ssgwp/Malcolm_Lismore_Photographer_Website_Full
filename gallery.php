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
    <title>Gallery | Malcolm Lismore Photographer</title>
    <link rel="icon" type="image/x-icon" href="/image/icon.png">
  </head>
  <body>
    <header class="header" id="home">
      <nav>
        <div class="nav__header">
          <div class="nav__logo">
            <img src="image/logo1.png" alt="Malcolm Lismore Logo" />
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line" aria-label="Menu"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="home.php">HOME</a></li>
          <li><a href="home.php#about">ABOUT US</a></li>
          <li><a href="package.php">PACKAGES</a></li>
          <li class="nav__logo">
            <img src="image/logo1.png" alt="Malcolm Lismore Logo"/>
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

    <!-- Gallery Section -->
    <section class="section__container gallery__container" id="gallery_sec">
      <h2 class="section__header">~ GALLERY ~</h2>
      <div class="gallery__grid">
        <?php
          // Database connection
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "photog";

          // Establishing database connection
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Check if connection is successful
          if ($conn->connect_error) {
              die("<p>Database connection failed: " . $conn->connect_error . "</p>");
          }

          // Query to fetch image paths from the database
          $query = "SELECT * FROM photo";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              // Loop through and display images dynamically
              while ($row = $result->fetch_assoc()) {
                echo "<img src='" . str_replace('../', '', $row['photo_path']) . "' alt='gallery' onclick='openModal(this)' />";
              }
          } else {
              echo "<p>No images available in the gallery.</p>";
          }

          // Close the database connection
          $conn->close();
        ?>
      </div>

      <!-- Modal to display enlarged image -->
      <div id="modal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage" alt="Enlarged gallery image">
      </div>
    </section>

    <footer id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <img src="image/logo2.png" alt="Malcolm Lismore Logo" />
          <div class="footer__socials">
            <a href="https://www.facebook.com/" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
            <a href="https://www.instagram.com/" target="_blank" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
            <a href="https://x.com/" target="_blank" aria-label="X"><i class="ri-twitter-fill"></i></a>
            <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube"><i class="ri-youtube-fill"></i></a>
            <a href="https://www.pinterest.com/" target="_blank" aria-label="Pinterest"><i class="ri-pinterest-line"></i></a>
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
        <br>
        Developed by - Sineth Sandeepa
      </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
    
    <script>
      function openModal(imgElement) {
        var modal = document.getElementById("modal");
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = imgElement.src;
      }

      function closeModal() {
        var modal = document.getElementById("modal");
        modal.style.display = "none";
      }
    </script>
  </body>
</html>
