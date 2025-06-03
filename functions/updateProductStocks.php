<?php
include '_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $province_id = $_POST['province_id'];
    $lgu_id = $_POST['lgu_id'];
    $assoc_id = $_POST['assoc_id'];
    $date_distributed = mysqli_real_escape_string($conn, $_POST['date_distributed']);
    $bags_distributed = intval($_POST['bags_distributed']);
    $remaining_bags = intval($_POST['remaining_bags']);

    // Insert distribution record
    $sql = "INSERT INTO da7_distribution (product_id, date_distributed, bags_distributed, remaining_bags, province_id, lgu_id, assoc_id) 
            VALUES ('$product_id', '$date_distributed', '$bags_distributed', '$remaining_bags', '$province_id', '$lgu_id', '$assoc_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Distribution record added successfully!'); window.location.href='../pages/stockout.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>