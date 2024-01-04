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

// Get the apartment_id from the URL
$apartment_id = $_GET['id'] ?? '';

// Fetch the apartment with the given apartment_id
$apartment = null;
if ($apartment_id != '') {
    $sql = "SELECT id, condo_id, num_apa FROM apartments WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $apartment_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result !== false) {
        $apartment = mysqli_fetch_assoc($result);
    }
}
// Fetch the apartment data with the given id
$sql = "SELECT * FROM apartments WHERE id = $apartment_id";
$result = mysqli_query($conn, $sql);
$apartment = mysqli_fetch_assoc($result);

// Close the connection
mysqli_close($conn);
?>




<!DOCTYPE html>
<html>
<head>
	<title>Apartment Payments</title>
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
    <h1>Apartment Payments</h1>
      
      <?php if ($apartment): ?>
        <h2>Showing: Apartment <?php echo htmlspecialchars($apartment['num_apa']); ?></h2>
    <?php else: ?>
        <p>Unexpected data format in the apartments array.</p>
    <?php endif; ?>
      <br>
      <?php if ($apartment): ?>
    <h3>Deuda: <?php echo htmlspecialchars($apartment['deuda']); ?></h3>
<?php else: ?>
    <p>Unexpected data format in the apartments array.</p>
<?php endif; ?>
  </div>

  <br>
  <button class="return-btn" onclick="goBack()">Return </button>

  <div class="content">
      
      
  <form action="apa_payment_post.php" method="post">

    <?php if (isset($apartment['id'])): ?>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($apartment['id']); ?>">
<?php else: ?>
    <input type="hidden" name="apartment_id" value="">
    <p>Error: Apartment ID not found.</p>
<?php endif; ?>

      <input type="hidden" name="condo_id" value="<?php echo htmlspecialchars($apartment['condo_id']); ?>">

      <div>
        <h3>Payments</h3>
        <label for="payment-date">Payment Date:</label>
        <input type="date" id="payment-date" name="payment-date" value="<?php echo date('Y-m-d'); ?>"><br><br>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method">
            <option value="Cash">Cash</option>
            <option value="Check">Check</option>
            <option value="Credit Card">Credit Card</option>
        </select><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount"><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
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

