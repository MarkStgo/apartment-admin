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

$apartment_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$condo_id = isset($_GET['condo_id']) ? intval($_GET['condo_id']) : 0;

$condo_id = $_GET['condo_id'];

// Fetch the apartment data with the given id using prepared statements
$apartment = null;
if ($apartment_id != 0) {
    $sql = "SELECT * FROM apartments WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $apartment_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result !== false) {
        $apartment = mysqli_fetch_assoc($result);
    }
}

// Fetch the condo data with the given id
$condo = null;
if ($condo_id != 0) {
    $sql = "SELECT * FROM condos WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $condo_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result !== false) {
        $condo = mysqli_fetch_assoc($result);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
    
	<title>Edit Apartment</title>
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
color: #34495e;
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
        
        .data-table {
            width: 70%;
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: Arial, sans-serif;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .data-table th,
        .data-table td {
            padding: 12px 15px;
        }

        .data-table th {
            background-color: #333;
            color: #ffffff;
            text-align: left;
        }

        .data-table tr {
            border-bottom: 1px solid #333;
        }

        .data-table tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .data-table tr:last-of-type {
            border-bottom: 2px solid #333;
        }
        .delete-btn {
  display: inline-block;
  background-color: #d9534f;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  margin-top: 10px;
  transition: background-color 0.2s ease-in-out;
}

.delete-btn:hover {
  background-color: #c9302c;
}

.button-container {
  display: flex;
  justify-content: space-between;
  margin-top: 25px;
}

.button-left {
  text-align: left;
}

.button-right {
  text-align: right;
}
.add-payment-btn {
  display: inline-block;
  background-color: #333;
  color: #fff;
  text-decoration: none;
  padding: 10px 30px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.add-payment-btn:hover {
  background-color: #0062cc;
}

        
.return-btn {
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 40px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.return-btn:hover {
  background-color: #0062cc;
}


        .save-changes-btn {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 40px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            
        }

        .save-changes-btn:hover {
            background-color: #0062cc;
        }
         .button-container {
            text-align: center;
            margin-top: 20px;
             align-content: center;
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
 
  <h1>Update Apartment Profile</h1>
</div>


    
    <div class="form-box">
        <h1>Update Apartment</h1>
      <a href="view_apa.php?condo_id=<?php echo $condo_id; ?>&id=<?php echo $apartment_id; ?>" class="save-changes-btn">Return </a>


<br><br>

        <?php if ($apartment): ?>
            <form action="update_apartment.php" method="post">
                
                <input type="hidden" name="id" value="<?php echo $apartment_id; ?>">
                <input type="hidden" name="condo_id" value="<?php echo $condo_id; ?>">
                <table class="data-table">
                    <tr>
                        <th>Apartment Number</th>
                        <td><input type="text" name="num_apa" value="<?php echo htmlspecialchars($apartment['num_apa']); ?>"></td>
                    </tr>
                    <tr>
                        <th>Owner Name</th>
                        <td><input type="text" name="owner_name" value="<?php echo htmlspecialchars($apartment['owner_name']); ?>"></td>
                    </tr>
                    <tr>
                        <th>Owner Last Name</th>
                        <td><input type="text" name="owner_last_name" value="<?php echo htmlspecialchars($apartment['owner_last_name']); ?>"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="email" value="<?php echo htmlspecialchars($apartment['email']); ?>"></td>
                    </tr>
                    <tr>
                        <th>Monthly Fee</th>
                        <td><input type="text" name="cuota" value="<?php echo htmlspecialchars($apartment['cuota']); ?>"></td>
                    </tr>

                    <tr>
                        <th>Debts</th>
                        <td><?php echo htmlspecialchars($apartment['deuda']); ?></td>
                    </tr>
                    
                </table>
                <br><br>
                
                
                 <div class="button-container">
        <button class="save-changes-btn" type="submit">Save Changes</button>
    </div>
                
                
            </form>
        <?php else: ?>
            <p>No apartment found with the given id.</p>
        <?php endif; ?>
    </div>
    
    
    
    
</body>
</html>