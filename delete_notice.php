<?php
include 'db.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM notices WHERE id=$id";
  if (mysqli_query($conn, $query)) {
    header("Location: admin_panel.php");
  } else {
    echo "Delete failed.";
  }
}
?>
