<?php 
include '_database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST["category_name"];
    $description = $_POST["description"];
    $parent_id = $_POST["parent_id"] ? $_POST["parent_id"] : NULL;

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO da7_categories (category_name, parent_id, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $category_name, $parent_id, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Category added successfully!'); window.location.href='../pages/category.php';</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
