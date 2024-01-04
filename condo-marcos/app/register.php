<?php
// Retrieve form data
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$alt_phone = $_POST['alt_phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$comments = $_POST['comments'];

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

// Prepare and execute queries to check if username or email already exists
$stmt = $conn->prepare("SELECT * FROM perfil_usuario WHERE user_username = ? OR email_user = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();




if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  // invalid email format
  echo "Invalid email address";
  exit();
}

// valid email format
// continue with the rest of the registration code




// Check if username already exists
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['user_username'] === $username) {
    $_SESSION['message'] = "The username is already in use.";
  } else {
    $_SESSION['message'] = "The email is already in use.";
  }
  header("Location: register-form.php"); // redirect to register form page
  exit();
}



// Insert the user into the database
$sql = "INSERT INTO perfil_usuario (name_user, lastname_user, genre_user, email_user, tel_user, tel_alt_user, user_username, pass_user, comment_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $name, $lastname, $gender, $email, $phone, $alt_phone, $username, $password, $comments);

if ($stmt->execute()) {
  header("Location: registerconfirmation.html");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
$stmt->close();
mysqli_close($conn);
?>
