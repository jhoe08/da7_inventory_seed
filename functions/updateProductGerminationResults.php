<?php
require '_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $test_date = $_POST['test_date'];
    $percentage = $_POST['percentage'];
    $test_results = $_POST['test_results'];

    // Debugging: Check if database connection is working
    if (!$conn) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Debugging: Prepare and check SQL query
    $updateQuery = "UPDATE da7_germination_tests 
                    SET percentage = ?, results = ? 
                    WHERE product_id = ? AND date_started = ?";

    $updateStmt = $conn->prepare($updateQuery);

    if (!$updateStmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind parameters and execute query
    $updateStmt->bind_param("dsis", $percentage, $test_results, $product_id, $test_date);

    if ($updateStmt->execute()) {
        echo "<script>alert('Germination Test Results was updated successfully!'); window.location.href='../pages/records.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $updateStmt->close();
    $conn->close();
}
?>