<?php
include '_database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lgu_name = mysqli_real_escape_string($conn, $_POST['lgu_name']);
    $province_id = $_POST['province_id'];

    $sql = "INSERT INTO da7_lgu (lgu_name, province_id) VALUES ('$lgu_name', '$province_id')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('LGU added successfully!'); window.location.href='../pages/settings.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>