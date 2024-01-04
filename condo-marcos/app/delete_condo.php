<?php
// Connect to the database
$db_host = "localhost";
$db_name = "condo-marcos";
$db_user = "root";
$db_pass = "";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the 'id' parameter exists
if (isset($_POST['id'])) {
  $id = intval($_POST['id']);

  // Delete the condo from the database
  $sql = "DELETE FROM condos WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  // Check if the query was executed successfully
  if ($result) {
    echo "Condo deleted successfully";
  } else {
    echo "Error deleting condo: " . mysqli_error($conn);
  }
} else {
  echo "Error";
}

// Close database connection
$conn->close();
?>
