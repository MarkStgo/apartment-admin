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

$apartment_ids_json = isset($_GET['apartment_ids']) ? $_GET['apartment_ids'] : '[]';
$apartment_ids = json_decode($apartment_ids_json, true);

// Fetch all apartments with the given apartment_ids along with their condo names
$sql = "SELECT apartments.*, condos.name AS condo_name 
        FROM apartments 
        LEFT JOIN condos ON apartments.condo_id = condos.id 
        WHERE apartments.id IN (" . implode(',', $apartment_ids) . ")";
$result = mysqli_query($conn, $sql);

// Store all fetched apartments in an array
$apartments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $apartments[] = $row;
}

// Extract the condo name from the first apartment (if any)
$condo_name = count($apartments) > 0 ? $apartments[0]['condo_name'] : '';

// Close the connection
mysqli_close($conn);
?>





<!DOCTYPE html>
<html>
<head>
	<title>Charges</title>
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

		.content {
			background-color: #ffffff;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			border-radius: 30px;
			padding: 40px;
			margin: 20px;
			width: 60%;
			max-width: 600px;
		}

		.content h3 {
			color: #333;
			margin-bottom: 20px;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}

		input[type="number"] {
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
        
         .return-btn {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 40px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 400px;
            
        }

        .return-btn:hover {
            background-color: #0062cc;
        }

	</style>
</head>
<body>
  <div class="banner">
    <h1>Charges Page</h1>
    <?php if (count($apartments) > 0): ?>
  <h2>Condo: <?php echo htmlspecialchars($condo_name); ?></h2>

<?php else: ?>
  <p>No apartment found with the given id.</p>
<?php endif; ?>

  </div>
  <br>
  <button class="return-btn" onclick="goBack()">Return</button>

  <div class="content">
    <form action="charge_post.php" method="post">
         
         <input type="hidden" name="apartment_ids" value="<?php echo htmlspecialchars(json_encode($apartment_ids)); ?>">
    <input type="hidden" name="apartment_id" value="<?php echo htmlspecialchars($apartments[0]['id']); ?>">
        
        
        <!-- new added -->
        <input type="hidden" name="condo_id" value="<?php echo htmlspecialchars($apartments[0]['condo_id']); ?>">
        
      <div>
        <h3>Payments</h3>
        <label for="payment-date">Payment Date:</label>
        <input type="date" id="payment-date" name="payment-date" value="<?php echo date('Y-m-d'); ?>"><br><br>
        
        <label for="payment-concept">Payment Concept:</label>
        <select id="payment-concept" name="payment-concept">
          <option value="Quota">Quota</option>
          <option value="Fine">Fine</option>
          <option value="Credit">Credit</option>
        </select><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

       <!-- <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount"><br><br> -->
      </div>
      <input type="submit" value="Submit">
    </form>
  </div>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>
</html>
