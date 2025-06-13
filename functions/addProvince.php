<?php
include '_database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $province_name = mysqli_real_escape_string($conn, $_POST['province_name']);

    $sql = "INSERT INTO da7_province (province_name) VALUES ('$province_name')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Province added successfully!'); window.location.href='../pages/province.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>