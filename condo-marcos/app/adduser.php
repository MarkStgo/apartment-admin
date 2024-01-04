<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
    <style>

.banner {
  background-color: #34495e;
  color: white;
  text-align: center;
  padding: 30px 0px;  
  width: 100%
}
        
.banner h1 {
  margin: 0;
  font-size: 48px; 
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
     
        

label {
  display: inline-block;
  width: 130px;
  margin-bottom: 10px;
  font-weight: bold;    
}
   
        
        
        
 body {
  background-image: url("pic.jpg");
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
        
        .back_btn {
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 40px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 13px;
  text-decoration: none;
}

.back_btn:hover {
  background-color: #0062cc;
}

    </style>
    <!---------------------------->
    
<body>
<div class="banner">
  <h1>Create your account</h1>
</div>
    <div class="form-box">
        
        <button class="back_btn" onclick="location.href='Menu.html'">Return</button>
        <br>
        <br>
	<form action="add_user_post.php" method="post">
        <label for="name">Nombre:</label>
		<input type="text" id="name" name="name" required><br>

		<label for="lastname">Apellido:</label>
		<input type="text" id="lastname" name="lastname" required><br>

		<label for="gender">Genero:</label>
		<select id="gender" name="gender">
            <option value="na">--</option>
			<option value="male">Masculino</option>
			<option value="female">Femina</option>
			<option value="other">Other</option>
		</select><br>

		<label for="email">Correo Electronico:</label>
		<input type="email" id="email" name="email" required><br>

		<label for="phone">Numero de Telefono:</label>
		<input type="tel" id="phone" name="phone"><br>
        <label for="phone">Telefono Alterno:</label>
		<input type="alt_phone" id="alt_phone" name="alt_phone"><br>

		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required><br>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required><br>

		<label for="comments">Comments:</label>
		<textarea id="comments" name="comments" rows="4" cols="50"></textarea><br>
        
        <a href="Login(edit).html" class="back_btn">Back</a>

		<input type="submit" value="Submit">
        
	</form>
    </div>
</body>
</html>
