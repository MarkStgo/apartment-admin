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

if (isset($_GET['id'])) {
    $apartment_id = intval($_GET['id']);
    $condo_id = isset($_GET['condo_id']) ? intval($_GET['condo_id']) : 0;

    $sql = "DELETE FROM apartments WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Statement preparation failed: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "i", $apartment_id);

    if (mysqli_stmt_execute($stmt)) {
      echo "<script>window.location.href = 'viewCondoApa.php?condo_id={$condo_id}&delete_success=1';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
