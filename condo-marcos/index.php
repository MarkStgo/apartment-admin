<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
   <style>
      
      * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
       
       
 .error-message {
     background-color: #f8d7da;
     color: #721c24;
     border: 1px solid #f5c6cb;
     border-radius: 5px;
     padding: 10px;
     margin-bottom: 20px;
      }

 .login-container{
  width: 100%;
  max-width: 600px; 
  height: auto;
  background-color: #ffffff;
  color: #333;
  margin: 0 auto; 
  box-shadow: 0 0 20px #000000;
  padding: 60px;
  border-radius: 30px;   
}
  form {
  margin: 0 auto;
  font-family: Arial, sans-serif;
  background-color: lightgray;  
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 25px;    
}      



h1 {
  text-align: center;
  margin-bottom: 20px;
}
       

.form-group {
  margin-bottom: 30px;
     align-content: center;
}

       
label {
  display: inline-block;
  width: 130px;
  margin-bottom: 10px;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: 90%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  margin-bottom: 20px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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
  background-color: #2c3e50;
}

a {
  color: #007bff;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
       
html, body {
  height: 100%;
}
       
       
       
       
body {
  background-image: url("login.jpg"); 
  background-repeat: no-repeat;
  background-size: cover;
  display: flex;
  align-items: center;
  justify-content: center;
 
}
      </style>
    <title>Login Page</title>
  </head>
  <body>
    <div class="login-container">
      <form action="login.php" method="POST">
        <h1>Login</h1>
          
          
           <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>
          
          
          
          
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Login">
        </div>
        
      </form>
    </div>
  </body>
</html>
