<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Contact | Malcolm Lismore Photographer</title>
  <link rel="icon" type="image/x-icon" href="/image/icon.png">
</head>
<body>
  <header>
    <h1>Malcolm Lismore Photographer</h1>
    <br>
    <nav>
      <a href="admin.php">Home</a>
      <a href="ad_order.php">Orders</a>
      <a href="">Contact</a>
      <a href="ad_customer.php">Customers</a>
      <a href="ad_gallery.php">Gallery</a>
    </nav>
    <div class="button-container2">
        <button class="login-button" onclick="window.location.href='ad_login.php'">Log out</button>
    </div>
  </header>

    <main>
        <h2>Contact Data</h2>

        <div class="data_filter_div">
            <!-- Search and Reset Form -->
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit">Search</button>
                <button type="button" onclick="window.location.href='?';">Reset</button>
            </form>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>NIC Number</th>
                    <th>Description</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection settings
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

                // Delete record if delete action is triggered
                if (isset($_GET['delete'])) {
                    $idToDelete = $conn->real_escape_string($_GET['delete']);
                    $deleteSql = "DELETE FROM contact WHERE email='$idToDelete'";
                    $conn->query($deleteSql);
                }

                // Search and filter data
                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                $query = "SELECT c_name, ph_no, email, nic_no, descr FROM contact";
                if ($search) {
                    $query .= " WHERE c_name LIKE '%$search%'";
                }
                
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["c_name"]) . "</td>
                                <td>" . htmlspecialchars($row["ph_no"]) . "</td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                <td>" . htmlspecialchars($row["nic_no"]) . "</td>
                                <td>" . htmlspecialchars($row["descr"]) . "</td>
                                <td>
                                <a href='?delete=" . htmlspecialchars($row["email"]) . "' class='delete-link' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <br><br><br><br>
  <footer>
    <p>&copy; Copyright © 2024 Malcolm Lismore Photographer. All rights reserved.
        <br>
        Developed by - Sineth Sandeepa
    </p>
  </footer>
</body>
</html>
