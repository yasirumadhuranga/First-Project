<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: user_login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: #f0f2f5;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }

    .header {
      background: linear-gradient(to right, #74ebd5, #9face6);
      padding: 20px 0;
      text-align: center;
      color: white;
    }

    .header img {
      width: 70px;
      height: 70px;
    }

    .header .title {
      font-size: 22px;
      margin-top: 10px;
      font-weight: 600;
    }

    .welcome-bar {
      background-color: #fff;
      padding: 15px 20px;
      margin: 20px auto;
      width: 90%;
      max-width: 700px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logout-btn {
      background-color: #dc3545;
      color: white;
      padding: 8px 14px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #c82333;
    }

    .notice-section {
      width: 90%;
      max-width: 700px;
      margin: 10px auto 30px;
    }

    .notice {
      background-color: #ffffff;
      border-left: 5px solid #007BFF;
      padding: 15px 20px;
      margin-bottom: 15px;
      border-radius: 6px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.08);
    }

    .notice h3 {
      margin: 0;
      color: #333;
    }

    .notice p {
      margin: 10px 0;
      color: #555;
    }

    .notice small {
      color: #888;
    }

    @media (max-width: 500px) {
      .welcome-bar {
        flex-direction: column;
        text-align: center;
      }

      .logout-btn {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <!-- Logo and Title -->
  <div class="header">
    <img src="Logo.png" alt="University Logo">
    <div class="title">University of Vavuniya<br>Notice Board</div>
  </div>

  <!-- Welcome Bar and Logout -->
  <div class="welcome-bar">
    <div>Welcome, <?php echo $_SESSION['user']; ?></div>
    <a href="user_logout.php" class="logout-btn">Logout</a>
  </div>

  <!-- Notices Display -->
  <div class="notice-section">
    <p><strong>You can view notices here:</strong></p>
    <?php
    include 'db.php';
    $result = mysqli_query($conn, "SELECT * FROM notices ORDER BY date_posted DESC");
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='notice'>";
      echo "<h3>{$row['title']}</h3>";
      echo "<p>{$row['content']}</p>";
      echo "<small>{$row['category']} | {$row['date_posted']}</small>";
      echo "</div>";
    }
    ?>
  </div>

</body>
</html>
