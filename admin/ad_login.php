<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="styles2.css">
  <title>Admin Login | Malcolm Lismore Photographer</title>
  <link rel="icon" type="image/x-icon" href="/image/icon.png">
</head>
<body>
  <header>
    <h1>Malcolm Lismore Photographer</h1>
  </header>
  <main>
    <section class="section__container">
        <h2 class="section__header">~ Login ~</h2><br>
        <div>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="username">Username</label><br>
                <input type="text" id="username" name="username" required><br><br>
              
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
              
                <input type="checkbox" id="togglePassword"> Show Password<br><br><br>
              
                <input type="submit" value="Login">
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
                  $email = $conn->real_escape_string($_POST['username']);
                  $password = $conn->real_escape_string($_POST['password']);

                  // Check if the email and password are correct
                  $sql = "SELECT * FROM ad_log WHERE username='$email' AND passwor='$password'";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showNotification('Login Successful!.', 'error');
                        });
                      </script>";
                      
                      // Successful login, redirect to an external URL
                      header("Location: admin.php");  // Replace with the URL of your choice
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
  </main>  
  <footer>
    <p>&copy; Copyright © 2024 Malcolm Lismore Photographer. All rights reserved.
        <br>
        Developed by - Sineth Sandeepa
    </p>
  </footer>
</body>
</html>
