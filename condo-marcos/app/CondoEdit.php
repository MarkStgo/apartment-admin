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

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Fetch the condo data from the database
  $sql = "SELECT * FROM condos WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  // Check if the query was executed successfully and fetched data
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  } else {
    // Display an error message and stop the script
    echo "Error fetching condo data: " . mysqli_error($conn);
    exit();
  }
} else {
  // Redirect the user to another page if the 'id' parameter is not present
  header("Location: viewprofile.php");
  exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Edit Condo Profile</title>
</head>
    <style>

.banner {
  background-color: #34495e;
  color: white;
  text-align: center;
  padding: 30px 0px;  
  width: 100%;
  overflow: hidden; /* to contain the floated image */
}
.banner h1 {
  margin: 0;
  font-size: 40px; 
}

         
        
        
.form-box {
  width: 100%;
  max-width: 600px; 
  height: auto;
  background-color: #ffffff;
  color: #333;
  margin: 0 auto; 
  box-shadow: 0 0 20px #000000;
  padding: 60px;
  border-radius: 100px;
}
        
  form {
  margin: auto;
  font-family: Arial, sans-serif;
  background-color: lightgray;  
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 45px;  
}
      

label {
  display: inline-block;
  width: 135px;
  margin-bottom: 10px;
  font-weight: bold;    
}
        
        
        
 body {
  background-image: url("login.jpg");
  background-repeat: no-repeat;
  background-size: cover; 
}
        

        
        
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"],
select,
textarea {
  width: 90%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  margin-bottom: 20px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

select {
  height: 40px;
}
        
        
        
 h1 {
font-family: Arial, sans-serif;
text-align: center;
margin-bottom: 20px;
color: aliceblue;
}

        
        
textarea {
  height: 100px;
}

        
        
input[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 40px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
        

input[type="submit"]:hover {
  background-color: #0062cc;
}
.back_btn  { 
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 40px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
    </style>
    <!---------------------------->
    
<body>
<div class="banner">
  
  
  <h1>Uptade Condo Profile</h1>
</div>


    <div class="form-box">
         <a href="viewprofile.php" class="back_btn">Return </a>
        <br><br>
	<form action="update_condo.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">


  <label for="condo-name">Name:</label>
 <input type="text" id="condo-name" name="condo-name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" required><br><br>



  <label for="physical-address">Physical Address:</label>
  <input type="text" id="physical-address" name="physical-address" value="<?php echo $row['physical_address']; ?>" required><br><br>

  


  <label for="postal-address">Postal Address:</label>
  <input type="text" id="postal-address" name="postal-address" value="<?php echo $row['postal_address']; ?>" required><br><br>

  <label for="phone-number">Phone Number:</label>
  <input type="tel" id="phone-number" name="phone-number" value="<?php echo $row['phone_number']; ?>" required><br><br>

  <label for="logo-import">Logo Import (optional):</label>
  <input type="file" id="logo-import" name="logo-import" accept="image/*"><br><br>

  <label for="webpage-link">Webpage Link:</label>
 <input type="text" id="webpage-link" name="webpage-link" value="<?php echo isset($row['webpage']) ? $row['webpage'] : ''; ?>"><br><br>



  <input type="submit" value="Update">
</form>

<!--Javascript code for the checbox 'same as Physical Address'-->
        <script>
  document.getElementById("postal-same-as-physical").addEventListener("change", function() {
    if (this.checked) {
      document.getElementById("postal-address").value = document.getElementById("physical-address").value;
    } else {
      document.getElementById("postal-address").value = "";
    }
  });

  document.getElementById("physical-address").addEventListener("input", function() {
    if (document.getElementById("postal-same-as-physical").checked) {
      document.getElementById("postal-address").value = document.getElementById("physical-address").value;
    }
  });
</script>
        
        
        

    </div>
</body>
</html>
