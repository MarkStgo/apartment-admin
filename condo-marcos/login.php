<?php
session_start();
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "condo-marcos";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the login form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Sanitize the input data to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Build the SQL query to fetch the user data from the database
    $sql = "SELECT * FROM perfil_usuario WHERE user_username='$username' AND pass_user='$password'";

    // Execute the query and get the result set
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // User is authenticated - redirect to the dashboard or homepage
        header("Location: app/Menu.html");
        exit();
    } else {
        // Invalid login credentials - display an error message
   $_SESSION['error_message'] = "Invalid username or password";
        header("Location: index.php"); // Replace with the name of your login page
        exit();
    }
}

// Close the database connection
$conn->close();
?>
