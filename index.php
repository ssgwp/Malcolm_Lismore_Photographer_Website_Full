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
    <title>Home | Malcolm Lismore Photographer</title>
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
          <li><a href="" >HOME</a></li>
          <li><a href="#about">ABOUT US</a></li>
          <li><a href="#package_sec">PACKAGES</a></li>
          <li class="nav__logo">
            <img src="image/logo1.png" alt="logo"/>
          </li>
          <li><a href="#gallery_sec">GALLERY</a></li>
          <li><a href="#blog">BLOG</a></li>
          <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">CONTACT US</a>
        </li>        
        </ul>
      </nav>
      <nav>
        <div class="header__name">
          <h2 class="section__header2">Malcolm Lismore Photographer</h2>
        </div>
      </nav>
      <div class="button-container">
        <button class="login-button" onclick="window.location.href='login.php'">Login</button>
      </div>
      <div class="button-container2">
        <button class="login-button" onclick="window.location.href='login.php'">Login</button>
      </div>
    </header>

    <!-- Notification Div -->
    <div id="notification" class="notification" style="display:none;"></div>

    <script>
      // Function to show notification
      function showNotification(message, color = 'red') {
          const notification = document.getElementById('notification');
          notification.textContent = message;
          notification.style.display = 'block';  // Make it visible
          notification.style.backgroundColor = color;  // Set color based on success or error
          notification.style.color = 'white';  // Ensure text is readable
          setTimeout(function() {
              notification.style.display = 'none';  // Hide after 3 seconds
          }, 3000);
      }

      // Check if there is a status parameter in the URL
      document.addEventListener('DOMContentLoaded', function() {
          const urlParams = new URLSearchParams(window.location.search);
          const status = urlParams.get('status');
          const message = urlParams.get('message');

          if (status === 'error' && message) {
              showNotification(decodeURIComponent(message), 'green');  // Display error message
          }
      });
  </script>

    <div class="section__container about__container" id="about">
      <h2 class="section__header">WE CAPTURE YOUR STORY</h2>
      <p class="section__description">
        At Malcolm Lismore Photographer, we are devoted to capturing the essence 
        of your most meaningful moments. Our passion for photography, combined 
        with a unique perspective, allows us to transform everyday moments 
        into timeless memories.
      </p>
      <p class="section__description">
        Whether it's a wedding, a special occasion, or the natural beauty of 
        the world around us, we focus on preserving the authenticity of each 
        moment. Our aim is to tell your story through every photograph, 
        ensuring that your memories are beautifully documented and cherished 
        forever. Let us frame the unforgettable moments of your life, one 
        stunning shot at a time.
      </p>
      <img src="image/logo2.png" alt="logo" />
    </div>

    <section class="service" id="service">
      <div class="section__container service__container">
        <h2 class="section__header">~ SERVICES ~</h2>
        <p class="section__description">
          At Malcolm Lismore Photographer, we provide a diverse selection of 
          professional photography services designed to capture your most 
          meaningful moments. Our focus on creativity and quality ensures 
          that every image we create reflects your story with authenticity, 
          emotion, and artistry.
        </p>
        <div class="service__grid">
          <div class="service__card">
            <h4>Portrait Photography</h4>
            <p>
              Our portrait photography sessions are tailored to highlight 
              your unique personality and style, offering timeless images 
              that truly represent who you are.
            </p>
          </div>
          <div class="service__card">
            <h4>Maternity Photography</h4>
            <p>
              Celebrate the wonder of new beginnings with our maternity 
              sessions, beautifully capturing the journey of motherhood 
              and the joy of welcoming new life.
            </p>
          </div>
          <div class="service__card">
            <h4>Family Photography</h4>
            <p>
              Preserve the special bond you share with your loved ones 
              through our family photography. We focus on capturing 
              candid, heartfelt moments alongside traditional portraits, 
              ensuring you have a collection of images that tell the 
              story of your family.
            </p>
          </div>
        </div>
      </div>
    </section>

    <div class="section__container portfolio__container" id="package_sec">
      <h2 class="section__header">~ PACKAGES ~</h2>
      <div class="portfolio__grid">
        <div class="portfolio__card">
          <img src="image/pack-1.jpg" alt="portfolio" />
        </div>
        <div class="portfolio__card">
          <img src="image/pack-2.jpg" alt="portfolio" />
        </div>
        <div class="portfolio__card">
          <img src="image/pack-3.jpg" alt="portfolio" />
        </div>
      </div>
      <br><br>
      <div class="gallery__btn">
        <a href="#">
          <button class="btn" onclick="showNotification('Please Login First !', 'error'); return false;">VIEW PACKAGES</button>
        </a>
      </div>
    </div>

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
              die("Connection failed: " . $conn->connect_error);
          }

          // Fetch 8 images from the database
          $query = "SELECT photo_path FROM photo LIMIT 8"; // Limit the query to 8 images
          $result = $conn->query($query);

          // Check if there are images in the result
          if ($result->num_rows > 0) {
              // Loop through the images and display them
              while ($row = $result->fetch_assoc()) {
                  $imagePath = str_replace('../', '', $row['photo_path']); // Remove the '../' part
                  echo "<img src='$imagePath' alt='gallery' />";
              }
          } else {
              echo "<p>No images found in the gallery.</p>";
          }

          // Close the database connection
          $conn->close();
        ?>
      </div>
      <div class="gallery__btn">
        <a href="gallery.php">
        <button class="btn" onclick="showNotification('Please Login First !', 'error'); return false;">VIEW GALLERY</button>
        </a>
      </div>
    </section>

    <section class="blog" id="blog">
      <div class="section__container blog__container">
        <div class="blog__content">
          <h2 class="section__header">~ LATEST BLOG ~</h2>
          <h4>Capturing Emotion in Every Frame</h4>
          <p>
            At Malcolm Lismore Photographer, storytelling is at the heart of 
            everything we do. Photography isn't just about clicking a shutter 
            it’s about capturing emotions, moments, and stories that resonate 
            for a lifetime. In this post, we explore the art of emotion-driven 
            photography and how we use our lens to convey meaning beyond the image.
          </p>
          <div class="blog__btn">
            <a href="#">
              <button class="btn" onclick="showNotification('Please Login First !', 'error'); return false;">Read More</button>
            </a>
          </div>
        </div>
      </div>
    </section>

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
            <li><a href="">HOME</a></li>
            <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">GALLERY</a></li>
            <li><a href="#about">ABOUT US</a></li>
            <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">BLOG</a></li>
            <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">PACKAGES</a></li>
            <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">CONTACT US</a></li>
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
