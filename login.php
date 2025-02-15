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
    <title>Login | Malcolm Lismore Photographer</title>
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
          <li><a href="index.php">HOME</a></li>
          <li><a href="index.php#about">ABOUT US</a></li>
          <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">PACKAGES</a></li>
          <li class="nav__logo">
            <img src="image/logo1.png" alt="logo"/>
          </li>
          <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">GALLERY</a></li>
          <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">BLOG</a></li>
          <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">CONTACT US</a></li>
        </ul>
      </nav>
      <nav>
        <div class="header__name">
          <h2 class="section__header2">Malcolm Lismore Photographer</h2>
        </div>
      </nav>
    </header>

    <section class="section__container">
        <h2 class="section__header">~ Login ~</h2><br>
        <div>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" required><br><br>
              
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
              
                <input type="checkbox" id="togglePassword"> Show Password<br><br><br>
              
                <input type="submit" value="Login">
                <a href="signup.php">You don't have an account? Sign Up</a>
            </form>

            <!-- Notification Div -->
            <div id="notification" class="notification" style="display:none;"></div>

            <?php
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // Database connection settings
                  $servername = "localhost";
                  $dbusername = "root"; // Changed the variable name to avoid conflict with form inputs
                  $dbpassword = "";
                  $dbname = "photog";  // Ensure your database name is correct

                  // Create connection
                  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  // Sanitize inputs
                  $email = $conn->real_escape_string($_POST['email']);
                  $password = $conn->real_escape_string($_POST['password']);

                  // Check if the email and password are correct
                  $sql = "SELECT * FROM logind WHERE email='$email' AND passw='$password'";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showNotification('Login Successful!.', 'error');
                        });
                      </script>";
                      
                      // Successful login, redirect to an external URL
                      header("Location: home.php");  // Replace with the URL of your choice
                      exit();  // Ensure script stops after redirect
                  } else {
                      echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showNotification('Invalid email or password. Please try again.', 'error');
                        });
                      </script>";
                  }

                  // Close the connection
                  $conn->close();
              }
            ?>

            <script>
                // Password Toggle Functionality
                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#password');

                if (togglePassword && password) {
                    togglePassword.addEventListener('change', function () {
                        // Toggle the type attribute of the password field
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);
                    });
                }

                // Function to show notification
                function showNotification(message, color = 'red') {
                    const notification = document.getElementById('notification');
                    if (notification) {
                        notification.textContent = message;
                        notification.style.display = 'block';  // Make it visible
                        notification.style.backgroundColor = color;  // Set color based on success or error
                        notification.style.color = 'white';  // Ensure text is readable
                        setTimeout(function() {
                            notification.style.display = 'none';  // Hide after 3 seconds
                        }, 3000);
                    } else {
                        console.error('Notification element not found');
                    }
                }

                // Check if there is a status parameter in the URL and display the message
                document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    const status = urlParams.get('status');
                    const message = urlParams.get('message');

                    if (status && message) {
                        const notificationColor = status === 'error' ? 'red' : 'blue';  // Customize color based on status
                        showNotification(decodeURIComponent(message), notificationColor);
                    }
                });
            </script>
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
            <li><a href="index.php">HOME</a></li>
            <li><a href="#" onclick="showNotification('Please Login First !', 'error'); return false;">GALLERY</a></li>
            <li><a href="index.php#about">ABOUT US</a></li>
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
