<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category = $_POST['category'];

  $query = "INSERT INTO notices (title, content, category) VALUES ('$title', '$content', '$category')";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Notice posted!'); window.location.href='admin_panel.php';</script>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>