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
?>
<!DOCTYPE html>
<html>
    
    <style>
        
* {
  margin: 0;
  padding: 0;
}

/* Container */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}
        
  .top-banner {
  position: fixed;
  top: 0;
  left: 250px; 
  height: 122px; 
  width: calc(100% - 200px); 
  background-color: #2c3e50;
  z-index: 10;
}

.content {
  margin-left: 220px;
  padding-top: 70px; 
}      
        
  
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-image: url("pic.jpg");
  background-repeat: no-repeat;
  background-size: cover; 
    display: flex;
}
        
.side-menu {
  list-style-type: none;
  width: 250px;
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  background-color: #2c3e50;
  overflow-x: hidden;
  padding-top: 0;
}

.logo-container {
  text-align: center;
  padding-bottom: 20px;
  padding-top: 10px;
}

.logo {
  max-width: 100%;
  height: auto;
}

.side-menu li {
  display: block;
  padding: 10px 20px;
  font-size: 18px;
  transition: background-color 0.3s, color 0.3s;
  background-color: rgba(255, 255, 255, 0.1); 
  border-radius: 5px; 
  margin: 5px; 
  box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2); 
}

.side-menu li:hover {
  background-color: rgba(255, 255, 255, 0.2); 
  color: #ddd; 
  cursor: pointer;
  box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2); 
}

.side-menu li a {
  color: white;
  text-decoration: none;
  display: block; 
box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2); 
}

.menu-title {
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  color: white;
}

  
 
/* Title */
.content h1 {
  font-size: 36px;
  font-weight: bold;
  text-align: center;
  padding: 50px 0;
}       
        
 #clock {
  font-size: 24px;
  font-weight: bold;
  padding: 20px 10px;
  text-align: center;
}       
        
        
        
                
   /* Header */
  header {
  text-align: center;
  padding: 50px 0;
}     
        

     
        
.paragraph-container {
  width: 100%;
  max-width: 600px;
  background-color: #ffffff;
  color: #333;
  margin-bottom: 30px;
  box-shadow: 0 0 20px #000000;
  padding: 30px;
  border-radius: 25px;
  text-align: justify;
}
 p{
  font-size: 16px;
  line-height: 1.5;
 }
 
table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
}

.table_container {
  width: 100%;
  text-align: center;
  margin-bottom: 20px;
}

table, th, td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #2c3e50;
  color: white;
}

td {
  background-color: white;
}


th:first-child {
  border-top-left-radius: 10px;
}

th:last-child {
  border-top-right-radius: 10px;
}

tr:last-child td:first-child {
  border-bottom-left-radius: 10px;
}

tr:last-child td:last-child {
  border-bottom-right-radius: 10px;
}
     
        
        
        
        
        
@media screen and (max-width: 1200px) {
  .container {
    width: 95%;
  }
}

@media screen and (max-width: 600px) {
  .content h1 {
    font-size: 24px;
  }

  #clock {
    font-size: 18px;
  }
}
    .generate-report-btn {
  background-color: #2c3e50;
  border: none;
  color: white;
  padding: 8px 40px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  transition: background-color 0.3s;
  cursor: pointer;
}

.generate-report-btn:hover {
  background-color: #34495e;
}
        
        
        .select-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

select {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  appearance: none;
  background-color: #fff;
  width: 100%;
  max-width: 200px;
}

select:focus {
  outline: none;
  border-color: #2c3e50;
}

.generate-report-btn {
  margin-top: 10px;
}

        .generate-report-btn {
  background-color: #2c3e50;
  border: none;
  color: white;
  padding: 8px 40px;
  text-align: left;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  transition: background-color 0.3s;
  cursor: pointer;
  margin-left: 20px;
}

.generate-report-btn:hover {
  background-color: #34495e;
}

    
 </style>
  <head>
            

    <title>Reports</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
   <div class="top-banner"></div>
   <div class="container">
 <div class="side-menu">
  <div class="logo-container">
    <img src="logo.jpg" alt="Logo" class="logo">
  </div>
  <h2 class="menu-title">Menu</h2>
  <ul>
    <li><a href="add_condo.html">Add Condo</a></li>
    <br>
    <br>
    <li><a href="viewprofile.php">View Profiles</a></li>
  
    <br>
    <br>
    <li><a href="../index.php">Logout</a></li>
  </ul>
</div>

  <div class="content">
      <h1>Reports Creation</h1>
    <div id="clock"></div>
      <br>
      <br>
      <br>
     
    <div class="paragraph-container">
        <button class="generate-report-btn" onclick="window.location.href='Menu.html';">Return</button>

        <br>
      <br>
      <h3>Choose Condo Account:</h3>
        <form action="apa_list_names.php" method="POST">
            <div class="select-container">
                <br>
                <br>
                <select name="condo_id">
                    <option value="null">-select-</option>
                      <?php
                         // Retrieve all the condo names
                         $sql = "SELECT id, name FROM condos";
                         $result = mysqli_query($conn, $sql);

                         // Display the options in a dropdown menu
                         while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
                         }

                         // Close the database connection
                         mysqli_close($conn);
                      ?>
                </select>
                <button class="generate-report-btn" type="submit">Choose type of Reports</button>
            </div>
        </form>
        <div class="buttons-container" style="display: none;">
            
  <button class="generate-report-btn">Apartment list with owner names</button>
  <button class="generate-report-btn">Apartment list with balance or debt</button>
  <button class="generate-report-btn">Apartment lists without debt</button>
</div>
    </div>

  </div>
</div>

      
  </body>
    
    <script> 
    document.addEventListener('DOMContentLoaded', function() {
  var form = document.querySelector('form');
  var buttonsContainer = document.querySelector('.buttons-container');

  form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting
    buttonsContainer.style.display = 'flex';
    buttonsContainer.style.flexDirection = 'column';
    buttonsContainer.style.alignItems = 'center';
  });
});</script>
</html>





