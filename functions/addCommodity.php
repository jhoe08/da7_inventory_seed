<?php 
include '_database.php'; // Include database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commodity_name = $_POST["commodity_name"];
    $description = $_POST["description"];
    $category_id = $_POST["category_id"];

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO da7_commodities (commodity_name, category_id, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $commodity_name, $category_id, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Commodity added successfully!'); window.location.href='../pages/commodity.php';</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
