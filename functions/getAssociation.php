<?php
include '_database.php';

if (isset($_GET['assoc_id'])) {
    $assoc_id = mysqli_real_escape_string($conn, $_GET['assoc_id']);
    $sql = "SELECT province_id, lgu_id, assoc_name FROM da7_association WHERE assoc_id = '$assoc_id'";
    $result = mysqli_query($conn, $sql);

    $associations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $associations[] = $row;
    }

    echo json_encode($associations);
}

mysqli_close($conn);
?>