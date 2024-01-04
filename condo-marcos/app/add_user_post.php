<?php
// Connect to the database
$db_host = "localhost";
$db_name = "condo-marcos";
$db_user = "root";
$db_pass = "";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone']; // make sure to set 'name' attribute of alternate phone input field to 'alt_phone' in HTML
    $username = $_POST['username'];
    $password = $_POST['password'];
    $comments = $_POST['comments'];

    $sql = "INSERT INTO perfil_usuario (name_user, lastname_user, genre_user, email_user, tel_user, tel_alt_user, user_username, pass_user, comment_user) 
    VALUES ('$name', '$lastname', '$gender', '$email', '$phone', '$alt_phone', '$username', '$password', '$comments')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
