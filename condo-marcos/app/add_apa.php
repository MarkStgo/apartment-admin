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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the latest condo profile's ID
    $sql = "SELECT id FROM condos ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $condo_id = $row["id"];
        } else {
            die("No condo profiles found.");
        }
    } else {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Get the apartment data from the form
    $condo_id = isset($_POST["condo_id"]) ? $_POST["condo_id"] : '';
    $apartment_number = isset($_POST["apartment_number"]) ? $_POST["apartment_number"] : '';
    $owner_name = isset($_POST["owner_name"]) ? $_POST["owner_name"] : '';
    $owner_last_name = isset($_POST["owner_last_name"]) ? $_POST["owner_last_name"] : '';
    $postal_address = isset($_POST["postal_address"]) ? $_POST["postal_address"] : '';
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $phone_number = isset($_POST["phone_number"]) ? $_POST["phone_number"] : '';
    $monthly_maintenance_fee = isset($_POST["monthly_maintenance_fee"]) ? $_POST["monthly_maintenance_fee"] : 0;
    //$debts = isset($_POST["debts"]) ? $_POST["debts"] : 0;
    $comments = isset($_POST["comments"]) ? $_POST["comments"] : '';
    
     $monthly_maintenance_fee = isset($_POST["monthly_maintenance_fee"]) ? $_POST["monthly_maintenance_fee"] : 0;

    // Insert the apartment data into the database, including 'deuda' column
    $sql = "INSERT INTO apartments (condo_id, num_apa, owner_name, owner_last_name, postal_address, genre, email, phone, cuota, deuda, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the variables, including $monthly_maintenance_fee for 'deuda'
        mysqli_stmt_bind_param($stmt, 'isssssiissi', $condo_id, $apartment_number, $owner_name, $owner_last_name, $postal_address, $gender, $email, $phone_number, $monthly_maintenance_fee, $monthly_maintenance_fee, $comments);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: menu.html");
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>