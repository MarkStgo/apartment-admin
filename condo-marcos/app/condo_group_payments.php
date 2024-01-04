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
// Check if the form was submitted and there are selected apartments
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_apartments'])) {
    $selected_apartments = $_POST['selected_apartments'];
    
    // Retrieve the apartment numbers for the selected apartments
    $selected_num_apa = [];
    foreach ($selected_apartments as $selected_apartment_id) {
        $sql = "SELECT num_apa FROM apartments WHERE id = " . intval($selected_apartment_id);
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $apartment = mysqli_fetch_assoc($result);
            $selected_num_apa[] = htmlspecialchars($apartment['num_apa']);
        }
    }
    
    // Display the apartment numbers
    echo "<h2>Showing: " . implode(', ', $selected_num_apa) . "</h2>";
} else {
    echo "<h2>No apartments selected.</h2>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Payments</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: Arial, sans-serif;
			background-image: url("pic.jpg");
			background-repeat: no-repeat;
			background-size: cover;
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		.banner {
			background-color: #34495e;
			color: white;
			text-align: center;
			padding: 20px 0px;
			width: 100%;
		}

		.banner h1 {
			margin-bottom: 20px;
			font-size: 48px;
			border: 0.05px solid white;
		}

		.search {
			display: flex;
			justify-content: center;
			margin: 20px 0;
			width: 100%;
		}

		.search label {
			margin-right: 10px;
			font-weight: bold;
		}

		.search input[type="text"] {
			border: 1px solid #333;
			border-radius: 5px;
			padding: 5px 10px;
		}

		.search input[type="submit"] {
			margin-left: 10px;
		}

		.banner h2 {
			margin-top: 20px;
		}

		.content {
			display: flex;
			justify-content: center;
			flex-wrap: wrap;
			width: 100%;
		}

		.charges, .payments {
			background-color: #ffffff;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			border-radius: 30px;
			padding: 40px;
			margin: 20px;
			width: 45%;
			max-width: 400px;
		}

		.charges h3, .payments h3 {
			color: #333;
			margin-bottom: 20px;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}

		input[type="number"], input[type="date"], input[type="text"] {
			width: 100%;
			margin-bottom: 20px;
			padding: 5px 10px;
			border: 1px solid #333;
			border-radius: 5px;
		}

		select {
			width: 100%;
			margin-bottom: 20px;
			padding: 5px 10px;
			border: 1px solid #333;
			border-radius: 5px;
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

		#search-input {
			width: 13%; 
		}
        
        
select {
    display: block;
    font-size: 16px;
    color: #444;
    line-height: 1.3;
    padding: 8px 12px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    appearance: none;
    appearance: none;
    appearance: none;
    background-color: #fff;
    background-repeat: no-repeat, repeat;
    background-position: right 16px center, 0 0;
    background-size: 12px auto, 100%;
}


option {
    font-size: 16px;
    color: #444;
    padding: 8px 12px;
    background-color: #fff;
    border: none;
    border-radius: 4px;
}


	</style>
</head>
    <body>
	<div class="banner">
		<h1>Apartment Charges and Payments</h1>
		<h2>Showing: Apartment A</h2>
	</div>
	<div class="content">
		<div class="payments">
			<h2>Payments</h2>
			<form action="paymentconfirmation.html">
				<label for="payment_date">Payment Date:</label>
				<input type="date" id="payment_date" name="payment_date"><br><br>
				<label for="payment_concept">Payment Concept:</label>
                <select id="payment_concept" name="payment_concept">
                    <option value="null">-Select-</option>
					<option value="cuota">Cuota</option>
					<option value="fine">Fine</option>
					<option value="SA">Special Assessment</option>
                    <option value="payment">Payment</option>
					<option value="credit">Credit</option>
				</select>
              <br><br>
				<label for="description">Description:</label>
				<input type="text" id="description" name="description"><br><br>
				<label for="amount">Amount:</label>
				<input type="number" id="amount" name="amount"><br><br>
				<label for="payment_method">Payment Method:</label>
				<select id="payment_method" name="payment_method">
                    <option value="null">-Select-</option>
					<option value="cash">Cash</option>
					<option value="credit_card">Credit Card</option>
					<option value="check">Check</option>
					<option value="other">Other</option>
				</select>
                <h2>Additional Charges</h2>
                <label for="fine">Fine:</label>
				<input type="number" id="fine" name="fine"><br><br>
				<label for="misc-charges">Miscellaneous Charges:</label>
				<input type="number" id="misc-charges" name="misc-charges"><br><br>
				<input type="submit" value="Submit">
			</form>
		</div>
	</div>
</body>
</html>

