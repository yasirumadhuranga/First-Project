<?php
session_start();
include 'db.php';

$message = "";

// Handle update submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $current_username = $_POST['current_username'];
  $current_password = $_POST['current_password'];
  $new_username = $_POST['new_username'];
  $new_password = $_POST['new_password'];

  // Check if current credentials are valid
  $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$current_username' AND password='$current_password'");
  if (mysqli_num_rows($check) == 1) {
    // Update with new credentials
    $update = mysqli_query($conn, "UPDATE users SET username='$new_username', password='$new_password' WHERE username='$current_username'");
    if ($update) {
      $message = "Username and password successfully updated.";
    } else {
      $message = "Error updating credentials.";
    }
  } else {
    $message = "Current username or password is incorrect.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Credentials</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #a1c4fd, #c2e9fb);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .change-box {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      width: 350px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      background-color: #007BFF;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .message {
      text-align: center;
      font-weight: bold;
      margin-bottom: 15px;
      color: red;
    }
  </style>
</head>
<body>

  <div class="change-box">
    <h2>Change Credentials</h2>
    <?php if ($message): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="current_username" placeholder="Current Username" required>
      <input type="password" name="current_password" placeholder="Current Password" required>
      <input type="text" name="new_username" placeholder="New Username" required>
      <input type="password" name="new_password" placeholder="New Password" required>
      <button type="submit">Update</button>
    </form>
  </div>

</body>
</html>
