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

// Fetch condo data
$sql = "SELECT id, name, webpage FROM condos";
$result = mysqli_query($conn, $sql);


// count of apartments for each condo profile
$sql = "SELECT c.*, COUNT(a.id) as apartment_count FROM condos c LEFT JOIN apartments a ON c.id = a.condo_id GROUP BY c.id";
$result = mysqli_query($conn, $sql);

$sql = "SELECT *, (SELECT COUNT(*) FROM apartments WHERE condo_id = condos.id) AS apartment_count FROM condos";
$result = mysqli_query($conn, $sql);


//debts summary for each condo account:
$sql = "SELECT c.*, COUNT(a.id) as apartment_count, SUM(a.deuda) as total_debts FROM condos c LEFT JOIN apartments a ON c.id = a.condo_id GROUP BY c.id";
$result = mysqli_query($conn, $sql);
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
        max-width: 1000px;
        height: auto;
        background-color: #ffffff;
        color: #333;
        margin: 50px auto;
        box-shadow: 0 0 20px #000000;
        padding: 50px;
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

      .filter {
        display: flex;
        margin-bottom: 20px;
      }

      table {
        border-collapse: collapse;
        width: 100%;
      }

      th, td {
        text-align: center;
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

      .edit-btn {
        display: inline-block;
        margin-left: 0.5rem;
        padding: 0.25rem 0.5rem;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
      }

      .edit-btn:hover {
        background-color: #0056b3;
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

      .delete-btn {
        display: inline-block;
        margin-left: 0.5rem;
        padding: 0.25rem 0.5rem;
        background-color: #f06c64;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s;
      }

      .delete-btn:hover {
        background-color: #d94b3d;
      }
        
        button:disabled {
  background-color: grey;
  cursor: not-allowed;
}


.delete-btn:disabled {
  background-color: grey;
  cursor: not-allowed;
}


    </style>
  </head>

  <body>
    <div class="banner">
      <h2>Search and View Condo Accounts</h2>
    </div>

    <div class="form-box">
      <button class="return-btn" onclick="goToHome()">Return</button>
      <br>
      <br>


<form action="">
  <div class="filter">
    <label for="owner">Search:</label>
    <input type="text" id="owner" onkeyup="filterTable()" placeholder="Search by owner name...">
  </div>
  
  <table id="apartments">
    <thead>
      <tr>
        <th>Name</th>
        <th>Web Page</th>
        <th>Apartments</th>
        <th>Debts</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (mysqli_num_rows($result) > 0) {
        // Loop through the fetched data
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          // Display the 'name' column value
          echo "<td>" . $row['name'] . "</td>";
          // Display the 'webpage' column value as a link
          echo "<td><a href='" . $row['webpage'] . "' target='_blank'>" . $row['webpage'] . "</a></td>";
          // Display the count of apartments for this condo
          echo "<td>" . $row['apartment_count'] . "</td>";
          // Display the total debts for this condo
          echo "<td style='text-align: right;'>" . $row['total_debts'] . "</td>";
          // Display the 'Actions' column with 'View' and 'Edit' buttons
         echo "<td><a href='viewCondoApa.php?condo_id=" . $row['id'] . "' class='view-btn'>View</a> 
          <a href='CondoEdit.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a> 
          <button class='delete-btn' data-id='" . $row['id'] . "' " . ($row['apartment_count'] > 0 ? "disabled" : "") . ">Delete</button>
          </td>";
    echo "</tr>";
        }
      } else {
        // If no condos are found in the database
        echo "<tr><td colspan='5'>No condos found.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</form>

</div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function filterTable() {
    const searchInput = document.getElementById("owner");
    const filter = searchInput.value.toUpperCase();
    const table = document.getElementById("apartments");
    const rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
      const nameCell = rows[i].getElementsByTagName("td")[0];
      const webpageCell = rows[i].getElementsByTagName("td")[1];

      if (nameCell || webpageCell) {
        const nameText = nameCell.textContent || nameCell.innerText;
        const webpageText = webpageCell.textContent || webpageCell.innerText;

        // Check for partial matches instead of exact matches
        if (nameText.toUpperCase().includes(filter) || webpageText.toUpperCase().includes(filter)) {
          rows[i].style.display = "";
        } else {
          rows[i].style.display = "none";
        }
      }
    }
  }

  function goToHome() {
    window.location.href = 'Menu.html';
  }
</script>

<script>
  // Listen for the delete button click event
  $('.delete-btn').on('click', function() {
    // Get the condo ID from the data-id attribute
    const id = $(this).data('id');

    // Confirm the deletion process
    if (confirm('Are you sure you want to delete this condo?')) {
      // Send a POST request to the delete_condo.php file
      $.post('delete_condo.php', { id: id }, function(response) {
        // Display the response message
        alert(response);

        // Refresh the page
        location.reload();
      });
    }
  });
</script>

</body>
</html>

<?php
  mysqli_free_result($result);
  mysqli_close($conn);
?>
