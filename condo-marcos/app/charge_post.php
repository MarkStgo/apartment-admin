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

if (!isset($_POST['apartment_id']) || !isset($_POST['payment-date']) || !isset($_POST['payment-concept'])) {
    die("Error: Please fill in all required fields");
}

// Retrieve form data
$apartment_id = $_POST['apartment_id'];
$payment_date = $_POST['payment-date'];
$payment_concept = $_POST['payment-concept'];
$description = $_POST['description'];
$condo_id = $_POST['condo_id'];

$apartment_ids_json = isset($_POST['apartment_ids']) ? $_POST['apartment_ids'] : '[]';
$apartment_ids = json_decode($apartment_ids_json, true);

if (empty($apartment_ids)) {
    die("Error: No apartment IDs provided");
}

// Fetch all apartments with the given apartment_ids
$sql = "SELECT * FROM apartments WHERE id IN (" . implode(',', $apartment_ids) . ")";
$result = mysqli_query($conn, $sql);

// Loop through all apartments and insert a new payment and update cuota and deuda
while ($row = mysqli_fetch_assoc($result)) {
    $apartment_id = $row['id'];
    $cuota = $row['cuota'];

    // Construct SQL INSERT statement
    $sql = "INSERT INTO payments (apartment_id, payment_date, payment_concept, description, amount) VALUES ('$apartment_id', '$payment_date', '$payment_concept', '$description', '$cuota')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New payment added successfully for apartment ID: $apartment_id<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Update cuota and deuda values in apartments table
    $new_deuda = $row['deuda'] + $cuota; // Calculate new deuda value by adding cuota to existing deuda
    $sql = "UPDATE apartments SET deuda = $new_deuda WHERE id = $apartment_id"; // Update deuda only

    if ($conn->query($sql) === TRUE) {
        echo "Deuda updated successfully for apartment ID: $apartment_id<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

header("Location: viewCondoApa.php?condo_id=$condo_id");
exit;

// Close database connection
$conn->close();
?>

