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

// Get the form data
$condo_id = $_POST['condo_id'];
$apartment_number = $_POST['apartment_number'];
$owner_name = $_POST['owner_name'];
$owner_last_name = $_POST['owner_last_name'];
$postal_address = $_POST['postal_address'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$monthly_maintenance_fee = $_POST['monthly_maintenance_fee'];
$comments = $_POST['comments'];

// Insert the new apartment data into the database
$sql = "INSERT INTO apartments (condo_id, num_apa, owner_name, owner_last_name, postal_address, genre, email, phone, cuota, deuda, comment)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?)";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("Statement preparation failed: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "issssssdsd", $condo_id, $apartment_number, $owner_name, $owner_last_name, $postal_address, $gender, $email, $phone_number, $monthly_maintenance_fee, $comments);

if (mysqli_stmt_execute($stmt)) {
        header("Location: viewCondoApa.php?condo_id={$condo_id}");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
