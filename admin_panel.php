<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: admin_login.php');
  exit();
}
include 'db.php';

// Handle Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  mysqli_query($conn, "INSERT INTO notices (title, content, category) VALUES ('$title', '$content', '$category')");
  header("Location: admin_panel.php");
}

// Handle Update Form Request
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $res = mysqli_query($conn, "SELECT * FROM notices WHERE id=$id");
  $editData = mysqli_fetch_assoc($res);
}

// Handle Update Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  mysqli_query($conn, "UPDATE notices SET title='$title', content='$content', category='$category' WHERE id=$id");
  header("Location: admin_panel.php");
}

// Handle Delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM notices WHERE id=$id");
  header("Location: admin_panel.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - CRUD</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #d7d2cc, #304352);
      padding: 40px;
      color: #333;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    form {
      margin-bottom: 30px;
    }

    input, textarea, select, button {
      width: 100%;
      padding: 12px;
      margin: 8px 0 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      box-sizing: border-box;
    }

    button {
      background: #007BFF;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    th {
      background-color: #f4f4f4;
      color: #333;
    }

    .actions a {
      margin-right: 10px;
      color: #007BFF;
      text-decoration: none;
      font-weight: 600;
    }

    .actions a.delete {
      color: red;
    }

    .logout-btn {
      display: inline-block;
      margin-top: -20px;
      float: right;
      background-color: #e74c3c;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
    }

    .logout-btn:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

  <div class="container">
    <a href="logout.php" class="logout-btn">Logout</a>
    <h2>Admin Panel - Manage Notices</h2>

    <!-- CREATE or UPDATE Form -->
    <form method="POST">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
      <input type="text" name="title" placeholder="Notice Title" value="<?= $editData['title'] ?? '' ?>" required>
      <textarea name="content" placeholder="Notice Content" required><?= $editData['content'] ?? '' ?></textarea>
      <select name="category" required>
        <option value="">-- Select Category --</option>
        <option value="Exams" <?= (isset($editData) && $editData['category'] === 'Exams') ? 'selected' : '' ?>>Exams</option>
        <option value="Events" <?= (isset($editData) && $editData['category'] === 'Events') ? 'selected' : '' ?>>Events</option>
        <option value="Holiday" <?= (isset($editData) && $editData['category'] === 'Holiday') ? 'selected' : '' ?>>Holiday</option>
      </select>
      <?php if ($editData): ?>
        <button type="submit" name="update">Update Notice</button>
      <?php else: ?>
        <button type="submit" name="create">Post Notice</button>
      <?php endif; ?>
    </form>

    <!-- READ Table -->
    <table>
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM notices ORDER BY date_posted DESC");
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['category']}</td>";
        echo "<td>{$row['date_posted']}</td>";
        echo "<td class='actions'>
                <a href='admin_panel.php?edit={$row['id']}'>Edit</a>
                <a href='admin_panel.php?delete={$row['id']}' class='delete' onclick=\"return confirm('Delete this notice?');\">Delete</a>
              </td>";
        echo "</tr>";
      }
      ?>
    </table>
  </div>

</body>
</html>
