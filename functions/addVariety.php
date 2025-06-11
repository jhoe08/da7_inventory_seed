<?php 
include '_database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $variety_name = $_POST["variety_name"];
    $description = $_POST["description"];
    $category_id = $_POST["category_id"];

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO da7_varieties (variety_name, category_id, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $variety_name, $category_id, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Variety added successfully!'); window.location.href='../pages/variety.php';</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
