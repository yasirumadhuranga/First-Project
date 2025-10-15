<?php
include 'db.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = mysqli_query($conn, "SELECT * FROM notices WHERE id=$id");
  $row = mysqli_fetch_assoc($query);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  $id = $_POST['id'];
  $update = "UPDATE notices SET title='$title', content='$content', category='$category' WHERE id=$id";
  if (mysqli_query($conn, $update)) {
    header("Location: admin_panel.php");
  } else {
    echo "Update failed.";
  }
}
?>

<h2>Edit Notice</h2>
<form method="POST">
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
  <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
  <textarea name="content" required><?php echo $row['content']; ?></textarea><br>
  <select name="category">
    <option value="Exams" <?php if($row['category']=='Exams') echo 'selected'; ?>>Exams</option>
    <option value="Events" <?php if($row['category']=='Events') echo 'selected'; ?>>Events</option>
    <option value="Holiday" <?php if($row['category']=='Holiday') echo 'selected'; ?>>Holiday</option>
  </select><br>
  <button type="submit">Update Notice</button>
</form>
