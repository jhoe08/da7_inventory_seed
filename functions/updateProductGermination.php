<?php
require '_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $test_date = $_POST['test_date'];

    // Debugging: Check if database connection is working
    if (!$conn) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Debugging: Prepare and check SQL query
    $updateQuery = "UPDATE da7_product SET germination_test_date = ? WHERE product_id = ?";
    $updateStmt = $conn->prepare($updateQuery);

    if (!$updateStmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind parameters and execute query
    $updateStmt->bind_param("si", $test_date, $product_id);

    if ($updateStmt->execute()) {
        $insertQuery = "INSERT INTO da7_germination_tests (product_id, date_started) 
                        VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertQuery);

        if (!$insertStmt) {
            die("Error inserting record: " . $conn->error);
        }
        
        $insertStmt->bind_param("is", $product_id, $test_date);
        $insertStmt->execute();

        echo "<script>alert('Germination test date was added successfully!'); window.location.href='../pages/records.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $updateStmt->close();
    $conn->close();
}
?>