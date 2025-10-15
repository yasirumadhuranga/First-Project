<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $_SESSION['user'] = $username;
    header('Location: user_dashboard.php');
  } else {
    echo "<p style='color: red; text-align: center;'>Invalid user credentials.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #74ebd5, #9face6);
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .logo {
      text-align: center;
      margin-bottom: 10px;
    }

    .logo img {
      width: 80px;
      height: 80px;
    }

    .title {
      font-size: 20px;
      font-weight: 600;
      color: #fff;
      margin: 10px 0;
      text-align: center;
      line-height: 1.4;
    }

    .login-container {
      background: #fff;
      padding: 30px 25px;
      width: 320px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
      animation: slideIn 0.4s ease;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0 20px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    @media (max-width: 400px) {
      .login-container {
        width: 90%;
        padding: 25px 20px;
      }
    }
  .admin-btn {
  position: absolute;
  top: 20px;
  right: 30px;
  background-color: #ff6600;
  color: #fff;
  text-decoration: none;
  padding: 10px 20px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 14px;
  transition: background-color 0.3s ease, transform 0.2s;
  box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
.admin-btn:hover {
  background-color: #e65c00;
  transform: scale(1.05);
}


  </style>
</head>
<body>
  <a href="admin_login.php" class="admin-btn">Admin Login</a>
  <div class="logo">
    <img src="Logo.png" alt="logo">
    <p class="title">University of Vavuniya<br>Notice Board</p>
  </div>

  <div class="login-container">
    <h2>User Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>

</body>
</html>
