<?php
include '_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $product_id = intval($_POST['product_id']);
    $province_id = intval($_POST['province_id']);
    $lgu_id = intval($_POST['lgu_id']);
    $assoc_id = intval($_POST['assoc_id']);
    $date_distributed = $_POST['date_distributed'];
    $bags_distributed = intval($_POST['bags_distributed']);
    $remaining_bags = intval($_POST['remaining_bags']);
    $purpose = trim($_POST['purpose']);
    $remarks = trim($_POST['remarks']);

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO da7_distribution 
            (product_id, date_distributed, bags_distributed, remaining_bags, province_id, lgu_id, assoc_id, purpose, remarks) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "isiiiiiss", $product_id, $date_distributed, $bags_distributed, $remaining_bags, $province_id, $lgu_id, $assoc_id, $purpose, $remarks);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Distribution record added successfully!'); window.location.href='../pages/stockout.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_stmt_error($stmt) . "');</script>";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Database error: Unable to prepare statement');</script>";
    }

    // Close connection
    mysqli_close($conn);
}
?>