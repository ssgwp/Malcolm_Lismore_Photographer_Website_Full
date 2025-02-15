<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Home | Malcolm Lismore Photographer</title>
  <link rel="icon" type="image/x-icon" href="/image/icon.png">
</head>
<body>
  <header>
    <h1>Malcolm Lismore Photographer</h1>
    <br>
    <nav>
      <a href="">Home</a>
      <a href="ad_order.php">Orders</a>
      <a href="ad_contact.php">Contact</a>
      <a href="ad_customer.php">Customers</a>
      <a href="ad_gallery.php">Gallery</a>
    </nav>
    <div class="button-container2">
      <button class="login-button" onclick="window.location.href='ad_login.php'">Log out</button>
    </div>
  </header>
  <main>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "photog";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Initialize counts
      $orderCount = $contactCount = $customerCount = $incomeTotal = 0;

      // Query counts for each category
      $orderCountQuery = "SELECT COUNT(*) as total FROM orders";
      $contactCountQuery = "SELECT COUNT(*) as total FROM contact";
      $customerCountQuery = "SELECT COUNT(*) as total FROM logind";
      $incomeQuery = "SELECT SUM(pak_price) as total_income FROM orders";

      // Execute each query and store results
      $orderResult = $conn->query($orderCountQuery);
      if ($orderResult->num_rows > 0) {
          $orderCount = $orderResult->fetch_assoc()['total'];
      }

      $contactResult = $conn->query($contactCountQuery);
      if ($contactResult->num_rows > 0) {
          $contactCount = $contactResult->fetch_assoc()['total'];
      }

      $customerResult = $conn->query($customerCountQuery);
      if ($customerResult->num_rows > 0) {
          $customerCount = $customerResult->fetch_assoc()['total'];
      }

      $incomeResult = $conn->query($incomeQuery);
      if ($incomeResult->num_rows > 0) {
          $incomeTotal = $incomeResult->fetch_assoc()['total_income'];
      }

      // Close the connection
      $conn->close();
    ?>
    <section class="blue-box-container">
      <div class="blue-box">
        <div class="count_name">Orders</div>
        <div class="count_number"><?php echo $orderCount; ?></div>
      </div>
      <div class="blue-box">
        <div class="count_name">Contacts</div>
        <div class="count_number"><?php echo $contactCount; ?></div>
      </div>
      <div class="blue-box">
        <div class="count_name">Customers</div>
        <div class="count_number"><?php echo $customerCount; ?></div>
      </div>
      <div class="blue-box">
        <div class="count_name">Income</div>
        <div class="count_number">$ <?php echo number_format($incomeTotal, 2); ?></div>
      </div>
    </section>
  </main>  
  <footer>
    <p>&copy; 2024 Malcolm Lismore Photographer. All rights reserved.
      <br>Developed by - Sineth Sandeepa
    </p>
  </footer>
</body>
</html>
