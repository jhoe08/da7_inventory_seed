<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php


// initializing variables

$date_received          = "";
$category               = "";
$commodity              = "";
$variety                = "";
$year                   = "";
$batch                  = "";
$lot                    = "";
$bags                   = "";
$germination_test_date  = "";
$remarks                = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'da7_seeds');
if (mysqli_connect_error())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  echo "connect";



// Escape user input to prevent SQL injection
$date_received            = mysqli_real_escape_string($db, $_POST['date_received']);
$category                 = mysqli_real_escape_string($db, $_POST['category']); 
$commodity                = mysqli_real_escape_string($db, $_POST['commodity']);
$variety                  = mysqli_real_escape_string($db, $_POST['variety']);
$year                     = intval($_POST['year']);  // Convert to integer
$batch                    = mysqli_real_escape_string($db, $_POST['batch']);
$lot                      = mysqli_real_escape_string($db, $_POST['lot']);
$bags_received            = intval($_POST['bags']);  // Convert to integer
$germination_test_date    = mysqli_real_escape_string($db, $_POST['germination_test_date']);
$remarks                  = mysqli_real_escape_string($db, $_POST['remarks']);

// Prepare the INSERT query securely
$stmt = $db->prepare("INSERT INTO da7_product 
                      (category, commodity, variety, year, batch, lot, date_received, bags_received, remarks, germination_test_date)  
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind user input securely with correct data types
$stmt->bind_param("sssisssiss", $category, $commodity, $variety, $year, $batch, $lot, $date_received, $bags_received, $remarks, $germination_test_date);

// Execute the query and check for errors
if ($stmt->execute()) {
  echo "<script>alert('Product added successfully!'); window.location.href='../pages/stockin.php';</script>";
} else {
  echo "<script>alert('Something went wrong: " . $stmt->error . "');</script>";
}

// Close statement and database connection
$stmt->close();
$db->close();
  
}
?>