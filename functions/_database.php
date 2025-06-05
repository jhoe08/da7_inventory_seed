<?php
$prefix = "da7_";
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = $prefix . "seeds";  

// Establish the connection using mysqli_connect
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function getData($conn, $table, $id = null) {
    $sql = "SELECT * FROM " . $table;
    
    if ($id !== null) {
        $sql .= " WHERE id = ?";
    }

    $stmt = mysqli_prepare($conn, $sql);
    if ($id !== null) {
        mysqli_stmt_bind_param($stmt, "i", $id);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        return json_encode(["error" => mysqli_error($conn)]);
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return json_encode($data);
}

function getLGUName($data, $id) {
    foreach ($data as $lgu) {
        if ($lgu['lgu_id'] == $id) {
            return $lgu['lgu_name'];
        }
    }
    return "LGU not found";
}

function getProvinceName($data, $id) {
    foreach ($data as $province) {
        if ($province['province_id'] == $id) {
            return $province['province_name'];
        }
    }
    return "Province not found";
}

// Fetch data
$getLGUs = json_decode(getData($conn, $prefix . "lgu"), true);
$getProvinces = json_decode(getData($conn, $prefix . "province"), true);


// echo  var_dump($getLGUs);
?>