<?php
// Database connection
$db_host = "localhost";
$db_name = "condo-marcos";
$db_user = "root";
$db_pass = "";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$apartment_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$condo_id = isset($_POST['condo_id']) ? intval($_POST['condo_id']) : 0; // Get condo_id from POST data

// Sanitize the input data
$num_apa = mysqli_real_escape_string($conn, $_POST['num_apa']);
$owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
$owner_last_name = mysqli_real_escape_string($conn, $_POST['owner_last_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$cuota = mysqli_real_escape_string($conn, $_POST['cuota']); // Add this line to sanitize 'cuota' input

// Update apartment data in the database
$sql = "UPDATE apartments SET num_apa = '$num_apa', owner_name = '$owner_name', owner_last_name = '$owner_last_name', email = '$email', phone = '$phone', cuota = '$cuota' WHERE id = $apartment_id"; // Add 'cuota' to the SQL query
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Apartment updated successfully.";
} else {
    echo "Error updating apartment: " . mysqli_error($conn);
}

mysqli_close($conn);

// Redirect back to the edit_apa.php page for the same apartment
header("Location: view_apa.php?id=" . $apartment_id . "&condo_id=" . $condo_id); // Pass condo_id in redirect URL
exit;
?>
