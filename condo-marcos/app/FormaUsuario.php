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
        
        
        


    </style>
    <!---------------------------->
    
<body>
    
    <!-- Begin pop up message -->
<?php
    session_start();
    if (isset($_SESSION['message'])) {
      echo "<script>alert('" . $_SESSION['message'] . "');</script>";
      unset($_SESSION['message']); // unset the session variable after displaying the message
    }
  ?>
    
    <!-- END pop up message --> 
    
    
    
    
    
    
    
<div class="banner">
  <h1>Create your account</h1>
</div>
    <div class="form-box">
	<form action="register.php" method="POST">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required><br>

		<label for="lastname">Last Name:</label>
		<input type="text" id="lastname" name="lastname" required><br>

		<label for="gender">Gender:</label>
		<select id="gender" name="gender">
            <option value="na">--</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="other">Other</option>
		</select><br>

<label for="email">Email:</label>
<input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"><br>



		<!-- <label for="email">Correo Electronico:</label>
		<input type="email" id="email" name="email" required><br> -->
        
        
        
        
        
        
        
        
        

		
        
  <label for="phone">Phone Number:</label>
<select id="phone_country_code" name="phone_country_code">
  <option value="US">Estados Unidos (+1)</option>
  <option value="PR">Puerto Rico (+1)</option>
  <option value="MX">Mexico (+52)</option>
</select>
<input type="tel" id="phone" name="phone" placeholder="(XXX) XXX-XXXX" 
       pattern="^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$" 
       oninput="formatPhoneNumber(this)" required>
        
        
        
        <br>
       <label for="phone">Alt. Phone:</label>
		<select id="phone_country_code" name="phone_country_code">
  <option value="US">Estados Unidos (+1)</option>
  <option value="PR">Puerto Rico (+1)</option>
  <option value="MX">Mexico (+52)</option>
</select>
<input type="tel" id="alt_phone" name="alt_phone" placeholder="(XXX) XXX-XXXX" 
       pattern="^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$" 
       oninput="formatPhoneNumber(this)" > 



        
        
        
        
        
        
        



        
        
        
        
        

		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required><br>

        
        <label for="password">Password:</label>
<input type="password" id="password" name="password" placeholder="Must contain at least one uppercase letter and one number" required pattern="(?=.*\d)(?=.*[A-Z]).{8,}"><br>

		<!-- <label for="password">Password:</label>
		<input type="password" id="password" name="password" required><br>-->

		<label for="comments">Comments:</label>
		<textarea id="comments" name="comments" rows="4" cols="50"></textarea><br>
        
        <a href="Login(edit).html" class="back_btn">Back</a>

		<input type="submit" value="Submit">
        
	</form>
    </div>
    
    
    


    
    <!-- BEGIN JAVASCRIPT -->
    
    
    
    <script>
function formatPhoneNumber(input) {
  // get input value and remove non-digit characters
  let phoneNumber = input.value.replace(/\D/g,'');
  // get selected country code
  let countryCode = document.getElementById("phone_country_code").value;
  // set format based on country code
  let format = "";
  switch (countryCode) {
    case "US":
    case "PR":
      format = "(XXX) XXX-XXXX";
      break;
    case "MX":
      format = "XX-XX-XX-XX-XX";
      break;
    // add more cases for other countries as needed
    default:
      format = "XXXXXXXXXXXXX";
  }
  // replace X's in format with digits from phone number
  let formattedNumber = "";
  let digitIndex = 0;
  for (let i = 0; i < format.length; i++) {
    if (format[i] == "X") {
      formattedNumber += phoneNumber[digitIndex] || "";
      digitIndex++;
    } else {
      formattedNumber += format[i];
    }
  }
  // set input value to formatted phone number
  input.value = formattedNumber;
}

function preventNonNumericalInput(event) {
  // Prevent non-numerical input except for backspace and delete keys
  if (event.keyCode != 8 && event.keyCode != 46 && (event.keyCode < 48 || event.keyCode > 57)) {
    event.preventDefault();
  }
}
</script>
    
    
    <!-- END JAVASCRIPT -->
    
    
    
    
 
    
</body>
</html>
