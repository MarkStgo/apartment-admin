<?php
// Connect to the database
$db_host = "localhost";
$db_name = "condo-marcos";
$db_user = "root";
$db_pass = "";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $condo_id = intval($_POST['id']);
  $name = $_POST['condo-name'];
  $physical_address = $_POST['physical-address'];
  $postal_address = $_POST['postal-address'];
  $phone_number = $_POST['phone-number'];
  $webpage_link = $_POST['webpage-link'];

  // Update the condo data in the database
  $sql = "UPDATE condos SET
            name = '$name',
            physical_address = '$physical_address',
            postal_address = '$postal_address',
            phone_number = '$phone_number',
            webpage = '$webpage_link'
          WHERE id = $condo_id";

  if (mysqli_query($conn, $sql)) {
    // Redirect the user to another page after updating the data
    header("Location: viewprofile.php");
    exit();
  } else {
    // Display an error message if the query fails
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>
