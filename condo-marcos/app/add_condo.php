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

// Get the form data
$name = $_POST['condo-name'];
$physical_address = $_POST['physical-address'];
$postal_address = $_POST['postal-address'];
$phone_number = $_POST['phone-number'];
$webpage_link = $_POST['webpage-link'];

// Handle the file upload for the logo
$logo = NULL;
$logo = ""; // Initialize the variable as an empty string
if (isset($_FILES['logo-import']) && $_FILES['logo-import']['error'] == 0) {
  $logo = file_get_contents($_FILES['logo-import']['tmp_name']);
}
// Prepare the SQL statement to insert the data into the 'condo' table
$sql = "INSERT INTO condos (name, physical_address, postal_address, phone_number, logo, webpage)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

// Check if the statement was prepared successfully
if (!$stmt) {
  die("Error preparing the statement: " . mysqli_error($conn));
}

// Bind the variables and execute the SQL statement
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $name, $physical_address, $postal_address, $phone_number, $logo, $webpage_link);

if (mysqli_stmt_execute($stmt)) {
  header("Location: addcondoconfirmation.html");
  exit(); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
