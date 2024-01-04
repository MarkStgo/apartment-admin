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

// Fetch condo_id from the URL
$condo_id = isset($_GET['condo_id']) ? intval($_GET['condo_id']) : 0;

// Fetch condo data
$sql = "SELECT id, name FROM condos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $condo_id);

// Initialize condo_name
$condo_name = "Not Found";

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $condo_id = $row["id"];
        $condo_name = $row["name"];
    } else {
        $condo_name = "Unknown";
        echo "No condo found with the given ID.";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Fetch apartments data
$sql = "SELECT id FROM apartments WHERE condo_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $condo_id);

$apartment_ids = array();

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($apartment_ids, $row["id"]);
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_stmt_close($stmt);

// Convert apartment IDs array to JSON
$apartment_ids_json = json_encode($apartment_ids);


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Profiles</title>
  <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    background-image: url("pic3.png");
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
    padding: 30px 0px;
    width: 100%;
  }

  .banner h2 {
    margin: 0;
    font-size: 36px;
  }

  .form-box {
    width: 100%;
    max-width: 1200px;
    height: auto;
    background-color: #ffffff;
    color: #333;
    margin: 40px auto;
    box-shadow: 0 0 20px #000000;
    padding: 70px;
    border-radius: 30px;
  }

  form {
    margin: 0 auto;
    font-family: Arial, sans-serif;
    background-color: lightgray;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }

.filter {
  display: flex;
  justify-content: space-between; /* This property will space the items evenly apart */
  align-items: center; /* This property will vertically align the items in the center */
  flex-wrap: wrap; /* This property will wrap the items to the next line if the container width is not enough */
  margin-bottom: 20px;
}


  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
    text-align: center;
  }
      td:nth-child(3) {
    text-align: center;
  }

  .debt {
    color: red;
  }

  .no-debt {
    color: green;
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

  
    
    
    .view-btn {
  display: inline-block;
  background-color: #333;
  color: #fff;
  text-decoration: none;
  padding: 5px 10px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.view-btn:hover {
  background-color: #34495e;
}
      
      /* Add this new class to your existing CSS */
.return-btn {
  display: inline-block;
  background-color: #333;
  color: #fff;
  text-decoration: none;
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  font-size: 16px;
  margin-top: 20px; /* Add margin to separate it from other elements */
}

.return-btn:hover {
  background-color: #34495e;
}
      
    
.condo-name-label {
  display: inline-block;
  font-size: 20px;
  font-weight: bold;
  color: #333;
  padding: 10px;
  border-radius: 5px;
  background-color: #f2f2f2;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

      .disabled {
    pointer-events: none;
    opacity: 0.4;
}


</style>
</head>
<body>
 
<div class="form-box">
    <div class="filter">
        <button class="return-btn" onclick="window.location.href='viewprofile.php'">Return</button>
    </div>

    <form action="add_apa.php" method="post">        
            <div class="filter">
                <label class="condo-name-label" for="condo_name"><?php echo "Condo Owner: " . htmlspecialchars($condo_name); ?></label>
                <input type="hidden" name="condo_id" value="<?php echo $condo_id; ?>">
            </div>
              <label for="owner">Search:</label>
            <input type="text" id="search" placeholder="Search by Apartment Number, Name or Last Name" onkeyup="filterTable()">
        <br><br>

            <table id="apartments">
                <thead>
                    <tr>
                        <!-- <th>Select</th> -->
                        <th>Apartment Number</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Cuota</th>
                        <th>Debt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="apartmentBody">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                        // Fetch apartment data for the current condo
                        $sql_apartments = "SELECT id, num_apa, owner_name, owner_last_name, email, phone, cuota, deuda, comment FROM apartments WHERE condo_id = $condo_id";
                        $result_apartments = mysqli_query($conn, $sql_apartments);

                        if (mysqli_num_rows($result_apartments) > 0) {
                            while ($apartment = mysqli_fetch_assoc($result_apartments)) {
                                echo "<tr>";
                                
                                
                                echo "<td style='text-align: center;'>" . htmlspecialchars($apartment['num_apa']) . "</td>";
                                echo "<td>" . htmlspecialchars($apartment['owner_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($apartment['owner_last_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($apartment['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($apartment['phone']) . "</td>";
                                echo "<td style='text-align: right;'>" . htmlspecialchars($apartment['cuota']) . "</td>";
                                echo "<td style='text-align: right;'>" . htmlspecialchars($apartment['deuda']) . "</td>";
                                
                                //action buttons
                            //    echo "<td><a href='view_apa.php?id=" . intval($apartment['id']) . "&condo_id=" . intval($condo_id) . "' class='view-btn'> View </a> ";
                                
                                
                             echo "<td><a href='view_apa.php?id=" . intval($apartment['id']) . "&condo_id=" . intval($condo_id) . "' class='view-btn'> View </a></td>";

                                echo "<tr id='paymentTable_" . intval($apartment['id']) . "' style='display: none;'>";





                            }
                        } else {
                            echo "<tr><td colspan='8'>No apartments found for this condo.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No condo found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            
    </form>

    <button id="makePayment" class="view-btn" style="margin-top: 20px;">Add Group Charges</button>

        <div style="text-align: center; margin-top: 20px;">
        <form action="add_more_apa.php" method="get" style="display: inline;">
            <input type="hidden" name="condo_id" value="<?php echo $condo_id; ?>">
            <button type="submit" class="view-btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; margin-right: 10px; text-decoration: none; border-radius: 5px;">Add Apartment</button>
        </form>
    </div>
    <?php
echo "<tr id='paymentTable_" . intval($apartment['id']) . "' style='display: none;'>
  <td colspan='8'>
    <table>
      <thead>
        <tr>
          <th>Apartment Number</th>
          <th>Owner Name</th>
          <th>Payment Date</th>
          <th>Payment Concept</th>
          <th>Description</th>
          <th>Amount</th>
          <th>Payment Method</th>
        </tr>
      </thead>
      <tbody>
        <!-- Here is where you will populate the payment data for each apartment. -->
      </tbody>
    </table>
  </td>
</tr>";


?>
    
    
</div>
    <br>
<br>

    
<script>
   // payment info toggle
function togglePaymentTable(apartmentId) {
    var table = document.getElementById('paymentTable_' + apartmentId);
    if (table.style.display === "none") {
      table.style.display = "table-row";
    } else {
      table.style.display = "none";
    }
  }
    
    
    
    
    
    
 function confirmDelete(apartmentId) {
  if (confirm("Are you sure you want to delete this apartment?")) {
    window.location.href = "delete_apartment.php?id=" + apartmentId + "&condo_id=<?php echo $condo_id; ?>";
  }
}
    
    
    //search function

    function filterTable() {
    const search = document.getElementById("search");
    const searchText = search.value.toLowerCase();
    const table = document.getElementById("apartments");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
      const apartmentNumber = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase();
      const ownerName = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
      const ownerLastName = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();

      if (
        apartmentNumber.indexOf(searchText) > -1 ||
        ownerName.indexOf(searchText) > -1 ||
        ownerLastName.indexOf(searchText) > -1
      ) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  }
    
//pass apa ids
      document.addEventListener('DOMContentLoaded', function() {
  const apartmentIds = <?php echo $apartment_ids_json; ?>;
  const makePaymentButton = document.getElementById('makePayment');

  makePaymentButton.addEventListener('click', function() {
    // Create a URLSearchParams object to store the apartment IDs
    const urlParams = new URLSearchParams();
    urlParams.append('apartment_ids', JSON.stringify(apartmentIds));

    // Redirect to the 'payments.php' file with the apartment IDs
    window.location.href = 'payments.php?' + urlParams.toString();
  });
});  

   

    
</script>

  
</body>
</html>


<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
