<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Gallery | Malcolm Lismore Photographer</title>
  <link rel="icon" type="image/x-icon" href="/image/icon.png">
</head>
<body>
  <header>
    <h1>Malcolm Lismore Photographer</h1>
    <nav>
      <a href="admin.php">Home</a>
      <a href="ad_order.php">Orders</a>
      <a href="ad_contact.php">Contact</a>
      <a href="ad_customer.php">Customers</a>
      <a href="">Gallery</a>
    </nav>
    <div class="button-container2">
      <button class="login-button" onclick="window.location.href='ad_login.php'">Log out</button>
    </div>
  </header>

  <main>
    <h2>Upload Image</h2>
    <form action="ad_gallery.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="image" accept="image/*" required>
      <button type="submit">Upload Image</button>
    </form>
    <br><br><br>

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

      // Handle the file upload
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
          $image = $_FILES['image'];
          $uploadDir = '../image/'; // Folder to store images
          $uploadFilePath = $uploadDir . basename($image['name']);
          $imageFileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

          // Check if image file is a valid format
          $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
          if (in_array($imageFileType, $validExtensions)) {
              // Move file to the image folder
              if (move_uploaded_file($image['tmp_name'], $uploadFilePath)) {
                  // Insert file path into the database
                  $stmt = $conn->prepare("INSERT INTO photo (photo_path) VALUES (?)");
                  if ($stmt) {
                      $stmt->bind_param("s", $uploadFilePath);
                      if ($stmt->execute()) {
                          echo "<p>Image uploaded and saved successfully.</p>";
                          header("Location: " . $_SERVER['PHP_SELF'] . "?status=success");
                          exit();  // Ensure script stops after redirect
                      } else {
                          echo "<p>Database error: " . $conn->error . "</p>";
                      }
                      $stmt->close();
                  } else {
                      echo "<p>Failed to prepare statement: " . $conn->error . "</p>";
                  }
              } else {
                  echo "<p>Error uploading the file.</p>";
              }
          } else {
              echo "<p>Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.</p>";
          }
      }

      // Fetch images from the database
      $query = "SELECT * FROM photo";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
          echo "<h3>Uploaded Images</h3>";
          echo "<table>
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>File path</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>";
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td><img src='" . $row['photo_path'] . "' alt='Image' width='150'></td>
                      <td>" . $row['photo_path'] . "</td>
                      <td><a href='?delete=" . $row['photo_id'] . "' class='delete-link' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                    </tr>";
          }
          echo "</tbody></table>";
      } else {
          echo "<p>No images uploaded yet.</p>";
      }

      // Handle deletion of an image
      if (isset($_GET['delete'])) {
          $imageId = $_GET['delete'];

          // First, retrieve the image path to delete the file
          $deleteQuery = "SELECT photo_path FROM photo WHERE photo_id = ?";
          $deleteStmt = $conn->prepare($deleteQuery);
          $deleteStmt->bind_param("i", $imageId);
          $deleteStmt->execute();
          $result = $deleteStmt->get_result();

          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $filePath = $row['photo_path'];

              // Delete the image file from the server
              if (file_exists($filePath)) {
                  unlink($filePath);
              }

              // Now, delete the record from the database
              $deleteSql = "DELETE FROM photo WHERE photo_id = ?";
              $deleteStmt = $conn->prepare($deleteSql);
              $deleteStmt->bind_param("i", $imageId);
              $deleteStmt->execute();

              echo "<p>Image deleted successfully.</p>";
              header("Location: " . $_SERVER['PHP_SELF']);
              exit();  // Ensure script stops after redirect
          } else {
              echo "<p>Image not found.</p>";
          }

          $deleteStmt->close();
      }

      // Close the database connection
      $conn->close();
    ?>
  </main>
  <br><br><br><br>
  <footer>
    <p>&copy; 2024 Malcolm Lismore Photographer. All rights reserved.
      <br>Developed by - Sineth Sandeepa
    </p>
  </footer>
</body>
</html>
