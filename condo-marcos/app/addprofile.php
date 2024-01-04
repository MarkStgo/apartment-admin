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

// Fetch the last condo's ID from the database
$sql = "SELECT id FROM condos ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$last_condo_id = $row["id"];

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    
	<title>Add Apartment</title>
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
  color: #fff;
  background-color: #555;
  padding: 10px 40px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 13px;
  transition: background-color 0.2s ease-in-out;
}
    </style>
    
    
    <!---------------------------->
    
<body onload="setCondoId()">
    
    <script>
  function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
  }

  function setCondoId() {
    const condoIdInput = document.getElementById('condo_id');
    const condoId = getURLParameter('condo_id');
    if (condoId) {
      condoIdInput.value = condoId;
    }
  }
</script>
<div class="banner">
  <a href="Menu.html" onclick="return confirm('Are you sure you want to leave this page?')">
    <img src="homeicon.jpg" alt="Home" style="float: left; margin-left: 10px;">
  </a>
  <h1>Add Apartment Profile</h1>
</div>


    <div class="form-box">
	<form action="add_apa.php" method="POST">
        
        <input type="hidden" id="condo_id" name="condo_id" value="<?php echo $last_condo_id; ?>">
        
  <label for="apartment_number">Apartment Number:</label>
  <input type="text" id="apartment_number" name="apartment_number"><br><br>
  
  <label for="owner_name">Owner Name:</label>
  <input type="text" id="owner_name" name="owner_name"><br><br>
  
  <label for="owner_last_name">Owner Last Name:</label>
  <input type="text" id="owner_last_name" name="owner_last_name"><br><br>
  
  <label for="postal_address">Postal Address:</label>
  <input type="text" id="postal_address" name="postal_address"><br><br>
  
  <label for="physical_address">Physical Address:</label>
  <input type="text" id="physical_address" name="physical_address"><br><br>
  
  <label for="gender">Gender:</label>
  <select id="gender" name="gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
  </select><br><br>
  
  <label for="email">Email:</label>
  <input type="email" id="email" name="email"><br><br>
  
  <label for="phone_number">Phone Number:</label>
  <input type="tel" id="phone_number" name="phone_number"><br><br>
  
  <label for="alternative_phone_number">Alternative Phone Number:</label>
  <input type="tel" id="alternative_phone_number" name="alternative_phone_number"><br><br>
  
  <label for="monthly_maintenance_fee">Monthly Maintenance Fee:</label>
  <input type="number" id="monthly_maintenance_fee" name="monthly_maintenance_fee" required><br><br>
  
  <!-- <label for="debts">Debts:</label>
  <input type="number" id="debts" name="debts">
        <br><br>-->
  
  <label for="comments">Comments:</label>
  <textarea id="comments" name="comments"></textarea><br><br>
        
  


  
  <input type="submit" value="Submit">
</form>
    </div>
    
    
    <!--javascript code for retrieving the last condo id inserted in the db-->
    <script>
  function setCondoId() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        var condoIdInput = document.getElementById('condo_id');
        condoIdInput.value = response.last_condo_id;
      }
    };
    xhr.open("GET", "get_last_condo_id.php", true);
    xhr.send();
  }
</script>

    
</body>
</html>
