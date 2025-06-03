<?php
include '_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assoc_name = mysqli_real_escape_string($conn, $_POST['assoc_name']);
    $province_id = $_POST['province_id'];
    $lgu_id = $_POST['lgu_id'];

    $sql = "INSERT INTO da7_association (assoc_name, province_id, lgu_id) VALUES ('$assoc_name', '$province_id', '$lgu_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Association added successfully!'); window.location.href='../pages/settings.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>