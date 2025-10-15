<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>University Notice Board</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Latest Notices</h2>
  <?php
  $result = mysqli_query($conn, "SELECT * FROM notices ORDER BY date_posted DESC");
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='notice'>";
    echo "<h3>{$row['title']}</h3>";
    echo "<p>{$row['content']}</p>";
    echo "<small>Category: {$row['category']} | Posted on: {$row['date_posted']}</small>";
    echo "</div><hr>";
  }
  ?>
  <a href="admin_login.php">Admin Login</a>
</body>
</html>