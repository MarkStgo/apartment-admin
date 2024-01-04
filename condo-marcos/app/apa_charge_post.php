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

$apartment_id = $_POST['id'] ?? '';
$condo_id = $_POST['condo_id'];
$payment_date = $_POST['payment-date'];
$payment_method = $_POST['payment-method'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$payment_concept = $_POST['payment-concept'];

if ($apartment_id != '') {
    // Fetch the current value of 'deuda' from the 'apartments' table
    $sql_current_values = "SELECT deuda FROM apartments WHERE id = ?";
    $stmt_current_values = mysqli_prepare($conn, $sql_current_values);
    mysqli_stmt_bind_param($stmt_current_values, "i", $apartment_id);
    mysqli_stmt_execute($stmt_current_values);
    $result_current_values = mysqli_stmt_get_result($stmt_current_values);
    $row_current_values = mysqli_fetch_assoc($result_current_values);

    // Add the amount to the fetched value of 'deuda'
    $new_deuda = $row_current_values['deuda'] + $amount;

    // Update the 'deuda' column in the 'apartments' table with the new value
    $sql_update_deuda = "UPDATE apartments SET deuda = ? WHERE id = ?";
    $stmt_update_deuda = mysqli_prepare($conn, $sql_update_deuda);
    mysqli_stmt_bind_param($stmt_update_deuda, "di", $new_deuda, $apartment_id);
    mysqli_stmt_execute($stmt_update_deuda);

    // Insert a new row in the 'payments' table
    $sql_insert = "INSERT INTO payments (payment_date, payment_concept, description, amount, payment_method, apartment_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "sssdsi", $payment_date, $payment_concept, $description, $amount, $payment_method, $apartment_id);
    mysqli_stmt_execute($stmt_insert);
}

// Redirect to the viewCondoApa.php page with the corresponding condo_id
header("Location: viewCondoApa.php?condo_id=$condo_id");
exit();

// Close the connection
mysqli_close($conn);
?>
